<?php
/**
 * FAQ Module Handler
 *
 * @package       CRGEnterprises\Module\FAQ
 * @since         1.0.0
 * @author        RayZ0rG
 * @link          https://aliensoft.io
 * @license       GNU-2.0+
 *
 */

namespace CRGEnterprises\Module\FAQ;

//Change this constant to match the plugin constant
define( 'FAQ_MODULE_TEXT_DOMAIN', COLLAPSIBLE_CONTENT_TEXT_DOMAIN );

/**
* Autoload the Plugin.
*
* @since 1.0.0
*
* @return void
*/
function autoload() {
  $files = array(
      'custom/post-type.php',
      'custom/taxonomy.php',
      'shortcode/shortcode.php',
      'template/helpers.php',
  );

  foreach ( $files as $file ) {
    include( __DIR__ . '/' . $file );
  }
}

autoload();

register_activation_hook( COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\activate_the_plugin' );

/**
* Activate the Plugin.
*
* @since 1.0.0
*
* @return void
*/
function activate_the_plugin() {
	// register CPT
  Custom\register_custom_faq_post_type();
	// register taxonomy
  Custom\register_custom_topic_taxonomy();

	flush_rewrite_rules();
}

register_deactivation_hook( COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\deactivate_the_plugin' );

/**
* Plugin is being deactivated. Clean up after ourselves...Silly.
*
* @since 1.0.0
*
* @return void
*/
function deactivate_the_plugin() {
  delete_option( 'rewrite_rules' );
}

register_uninstall_hook( COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\uninstall_the_plugin' );

/**
* Plugin is being uninstalled. Clean up after ourselves...Silly.
*
* @since 1.0.0
*
* @return void
*/
function uninstall_the_plugin() {
  delete_option( 'rewrite_rules' );
}
