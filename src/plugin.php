<?php
/**
 * Plugin Handler
 *
 * @package       CRGEnterprises\CollapsibleContent
 * @since         1.0.0
 * @author        RayZ0rG
 * @link          https://aliensoft.io
 * @license       GNU-2.0+
 *
 */

namespace CRGEnterprises\CollapsibleContent;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );

function enqueue_assets(){
  wp_enqueue_style( 'dashicons' );

  wp_enqueue_script(
    'collapsible-content-plugin-script',
    COLLAPSIBLE_CONTENT_URL . 'assets/dist/js/jquery.plugin.js',
    array('jquery'),
    '1.0.0',
    true
  );
/*
  $script_parameters = array(
    'showIcon' => 'dashicons dashicons-arrow-down-alt2',
    'hideIcon' => 'dashicons dashicons-arrow-up-alt2',
  );

  wp_localize_script( 'collapsible-content-plugin-script', 'scriptParameters', $script_parameters );
*/
}

function autoload() {
  $files = array(
      'shortcode/shortcodes.php',
      'faq/module.php',
  );

  foreach ( $files as $file ) {
    include( __DIR__ . '/' . $file );
  }
}

autoload();
