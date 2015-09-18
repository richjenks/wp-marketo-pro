<?php namespace RichJenks\WPMarketoPro;

// Admin menu and submenus
add_action( 'admin_menu', function () {
	$admin = new Admin;
	$admin->add_menus();
} );

// Save options
add_action( 'admin_post_marketo_pro_save_options', function () {
	$admin = new Admin;
} );