<?php namespace RichJenks\WPMarketoPro;

/**
 * Plugin name: Marketo Pro
 * Description: The ultimate plugin for integrating Marketo with WordPress
 * Version: 1.0.0
 * Author: Rich Jenks
 * Author URI: https://richjenks.com
 * Plugin URI: https://bitbucket.org/richjenks/wp-marketo-pro
 */

// Bootstrap readonly mode
global $marketo_pro_readonly;
$marketo_pro_readonly = ( file_exists(__DIR__ . '/config.php' ) ) ? true : false;

// Don't do anything until `plugins_loaded` so other devs can use this plugin's actions and filters
add_action( 'plugins_loaded', function () {
	require 'vendor/autoload.php';
	require 'plugin/Hooks.php';
} );

// If readonly mode, save settings
register_activation_hook( __FILE__, function () {
	global $marketo_pro_readonly;

	if ( $marketo_pro_readonly ) {
		$config = require 'config.php';

		update_option( 'marketo_pro_client_id',     $config['client_id'] );
		update_option( 'marketo_pro_client_secret', $config['client_secret'] );
		update_option( 'marketo_pro_munchkin_id',   $config['munchkin_id'] );
		update_option( 'marketo_pro_marketo_id',    $config['marketo_id'] );
	}
} );