<?php namespace RichJenks\WPMarketoPro;

// Admin menu and submenus
add_action( 'admin_menu', function () {
	$admin = new Admin;
	$admin->add_menus();
} );

// Save options
add_action( 'admin_post_marketo_pro_save_options', function () {
	$admin = new Admin;
	$admin->save_options( $_POST );
} );

// Flash messages for setting changes
add_action( 'admin_notices', function () {
	$screen = get_current_screen();
	if ( $screen->parent_base === 'marketo-pro' && $_GET['updated'] === 'true' ) {
		echo sprintf( '<div class="%s"><p>%s</p></div>', 'updated', 'Settings saved.' );
	}
} );

add_shortcode( 'marketo', function ( $atts, $content = null ) {
	$shortcode = new FormShortcode( $atts, $content = null );
	// return $shortcode->output();
} );