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

// Shortcode for form embed and lightbox
add_shortcode( 'marketo', function ( $atts, $content = null ) {
	$shortcode = new Form( $atts, $content );
	return $shortcode->output();
} );

// Form widget
add_action( 'widgets_init', function(){
	register_widget( 'RichJenks\WPMarketoPro\Widget' );
});

// Scripts & Styles
add_action( 'wp_enqueue_scripts', function () {

	// Marketo Forms
	$url = 'https://app-' . get_option('marketo_pro_marketo_id') . '.marketo.com/js/forms2/js/forms2.min.js';
	wp_register_script( 'marketopro-forms2', $url, [], '2.0.0', true );

	// Individual form
	wp_register_script( 'marketopro-form', plugins_url( 'assets/form.js', __DIR__ ), ['jquery'], '1.0.0', true );

	// Munchkin
	if ( !is_admin() ) {
		wp_register_script( 'marketopro-munchkin', plugins_url( 'assets/munchkin.js', __DIR__ ), [], '1.0.0', true );
		wp_localize_script( 'marketopro-munchkin', 'MarketoProMunchkin', [ 'munchkinId' => get_option('marketo_pro_munchkin_id') ] );
		wp_enqueue_script( 'marketopro-munchkin' );
	}

} );