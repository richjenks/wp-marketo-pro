<?php namespace RichJenks\WPMarketoPro;

class Admin {

	/**
	 * Called by admin menu hook
	 */
	public function add_menus() {

		// Allow others to define capability
		$capability = apply_filters( 'marketo_pro_capability', 'manage_options' );

		// Top-level page
		add_menu_page(
			'Marketo Pro',
			'Marketo Pro',
			$capability,
			'marketo-pro',
			[ $this, 'admin' ],
			plugins_url( 'wp-marketo-pro/assets/marketo.svg' ),
			100
		);

	}

	/**
	 * Bootstraps the admin page, called by `add_menu_page`
	 */
	public function admin() {
		$data['client_id']     = get_option('marketo_pro_client_id');
		$data['client_secret'] = get_option('marketo_pro_client_secret');
		$data['munchkin_id']   = get_option('marketo_pro_munchkin_id');
		$data['marketo_id']    = get_option('marketo_pro_marketo_id');

		require 'AdminView.php';
	}

	/**
	 * Escapes and stores options
	 *
	 * @param array $post $_POST data
	 */
	public function save_options( $post ) {
		$options['client_id']     = $post['client_id'];
		$options['client_secret'] = $post['client_secret'];
		$options['munchkin_id']   = $post['munchkin_id'];
		$options['marketo_id']    = $post['marketo_id'];

		foreach ($options as $key => $value) $options[ $key ] = preg_replace( '/[^\w-]/', '', $value );

		update_option( 'marketo_pro_client_id',     $options['client_id'] );
		update_option( 'marketo_pro_client_secret', $options['client_secret'] );
		update_option( 'marketo_pro_munchkin_id',   $options['munchkin_id'] );
		update_option( 'marketo_pro_marketo_id',    $options['marketo_id'] );

		wp_redirect( 'admin.php?page=marketo-pro&updated=true' );
	}

}