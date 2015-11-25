<?php namespace RichJenks\WPMarketoPro;

/**
 * Manages admin interfaces
 */
class Admin {

	/**
	 * Called by admin menu hook
	 */
	public function add_menus() {
		$capability = apply_filters( 'marketo_pro_capability', 'manage_options' );
		add_options_page( 'Marketo Pro', 'Marketo Pro', $capability, 'marketo-pro', [ $this, 'admin' ] );
	}

	/**
	 * Bootstraps the admin page, called by `add_menu_page`
	 */
	public function admin() {
		global $marketo_pro_readonly;

		$data['readonly']      = $marketo_pro_readonly;
		$data['client_id']     = get_option('marketo_pro_client_id');
		$data['client_secret'] = get_option('marketo_pro_client_secret');
		$data['munchkin_id']   = get_option('marketo_pro_munchkin_id');
		$data['marketo_id']    = get_option('marketo_pro_marketo_id');
		$data['query_strings'] = get_option('marketo_pro_query_strings');

		require 'AdminView.php';
	}

	/**
	 * Escapes and stores options if not in readonly mode
	 *
	 * @param array $post $_POST data
	 */
	public function save_options( $post ) {
		global $marketo_pro_readonly;

		if ( !$marketo_pro_readonly ) {
			$options['client_id']     = $post['client_id'];
			$options['client_secret'] = $post['client_secret'];
			$options['munchkin_id']   = $post['munchkin_id'];
			$options['marketo_id']    = $post['marketo_id'];
			$options['query_strings'] = $post['query_strings'];

			foreach ($options as $key => $value) $options[ $key ] = preg_replace( '/[^\w-|:]/', '', $value );

			update_option( 'marketo_pro_client_id',     $options['client_id'] );
			update_option( 'marketo_pro_client_secret', $options['client_secret'] );
			update_option( 'marketo_pro_munchkin_id',   $options['munchkin_id'] );
			update_option( 'marketo_pro_marketo_id',    $options['marketo_id'] );
			update_option( 'marketo_pro_query_strings', $options['query_strings'] );
		}

		wp_redirect( 'admin.php?page=marketo-pro&updated=true' );
	}

}