<?php
/**
 * Taxonomy Module Handler
 *
 * @package       CRGEnterprises\Module\FAQ\Custom
 * @since         1.0.0
 * @author        RayZ0rG
 * @link          https://aliensoft.io
 * @license       GNU-2.0+
 *
 */

 namespace CRGEnterprises\Module\FAQ\Custom;

 add_action( 'init', __NAMESPACE__ . '\register_custom_topic_taxonomy' );
 
 /**
  * Register the custom post type.
  *
  * @since 1.0.0
  *
  * @return void
  */

 function register_custom_topic_taxonomy() {

 	 $args = array(
     'label' => __( 'Topics', FAQ_MODULE_TEXT_DOMAIN ),
 		 'labels'  => get_taxonomy_labels_config( 'Topic', 'Topics' ),
 		 'hierarhical' => true,
     'show_admin_column' => true,
 	  );

 	  register_taxonomy( 'topic', array( 'faq' ), $args );
}

  /**
 * Get the taxonomy labels configuration.
 *
 * @since 1.0.0
 *
 * @param string $singular_label post type label
 * @param string $plural_label plural post type label
 * @param string $menu_label Optional menu label if different from $plural_label
 *
 * @return array
 */

  function get_taxonomy_labels_config( $singular_label, $plural_label, $menu_label = '' ) {
    if ( ! $menu_label ){
      $menu_label = $plural_label;
    }

  	return array(
  		'name'                       => _x( $plural_label, 'taxonomy general name', FAQ_MODULE_TEXT_DOMAIN ),
  		'singular_name'              => _x( $singular_label, 'taxonomy singular name', FAQ_MODULE_TEXT_DOMAIN ),
      'search_items'               => __( 'Search ' . $plural_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'popular_items'              => __( 'Popular '. $plural_label, FAQ_MODULE_TEXT_DOMAIN ),
      'all_items'                  => __( 'All ' . $plural_label, FAQ_MODULE_TEXT_DOMAIN ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit ' . $singular_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'view_item'                  => __( 'View ' . $singular_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'update_item'                => __( 'Update ', $singular_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'add_new_item'               => __( 'Add New '. $singular_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'new_item_name'              => __( 'New '. $singular_label . ' Name', FAQ_MODULE_TEXT_DOMAIN ),
      'separate_items_with_commas' => __( 'Separate '. $plural_label . ' with commas', FAQ_MODULE_TEXT_DOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove '. $plural_label, FAQ_MODULE_TEXT_DOMAIN ),
      'choose_from_most_used'      => __( 'Choose from most used '. $plural_label, FAQ_MODULE_TEXT_DOMAIN ),
  		'not_found'                  => __( 'No ' . $plural_label . ' found.', FAQ_MODULE_TEXT_DOMAIN ),
  		'menu_name'                  => $menu_label,
  	);
  }
