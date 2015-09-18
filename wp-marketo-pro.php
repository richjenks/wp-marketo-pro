<?php namespace RichJenks\WPMarketoPro;

/**
 * Plugin name: Marketo Pro
 * Description: The ultimate plugin for integrating Marketo with WordPress
 * Version: 0.0.0
 * Author: Rich Jenks
 * Author URI: https://richjenks.com
 * Plugin URI: https://bitbucket.org/richjenks/wp-marketo-pro
 */

// Don't do anything until `plugins_loaded` so other devs can use this plugin's actions and filters
add_action( 'plugins_loaded', function () {
	require 'vendor/autoload.php';
	require 'plugin/hooks.php';
} );