<?php namespace RichJenks\WPMarketoPro;

class Admin {

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
	 * Top-level page content
	 */
	public function render() { require 'AdminView.php'; }

}