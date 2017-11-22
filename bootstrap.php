<?php
/**
 * Collapsible Content WordPress Plugin
 *
 * @package     CRGEnterprises\CollapsibleContent
 * @author      RayZ0rG
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Collapsible Content WordPress Plugin
 * Plugin URI:  https://github.com/KnowTheCode/UpDevTools
 * Description: Collapsible Content is a plugin for WordPress that hides and shows content.
 * Version:     1.0.0
 * Author:      RayZ0rG
 * Author URI:  https://KnowTheCode.io
 * Text Domain: Collapsible_Content
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace CRGEnterprises\CollapsibleContent;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Yo, what are you looking at?' );
}

define( 'COLLAPSIBLE_CONTENT_PLUGIN', __FILE__ );
define( 'COLLAPSIBLE_CONTENT_DIR', plugin_dir_path( __FILE__ ) );

$plugin_url = plugin_dir_url( __FILE__ );
if ( is_ssl() ) {
	$plugin_url = str_replace( 'http://', 'https://', $plugin_url);
}

define( 'COLLAPSIBLE_CONTENT_URL', $plugin_url );
define( 'COLLAPSIBLE_CONTENT_TEXT_DOMAIN', 'collapsible_content' );

include( __DIR__ . '/src/plugin.php' );

/**
 * Setup the plugin's constants.
 *
 * @since 1.0.3
 *
 * @return void
 */

 /*
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	define( 'UPDEVTOOLS_URL', $plugin_url );
	define( 'UPDEVTOOLS_DIR', plugin_dir_path( __FILE__ ) );
}
*/
/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */

/*
function launch() {
	init_constants();

	require_once( __DIR__ . '/assets/vendor/autoload.php' );
}

launch();
*/
