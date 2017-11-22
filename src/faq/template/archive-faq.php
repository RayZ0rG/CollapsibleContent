<?php
/**
 * FAQ Archive Template
 *
 * @package       CRGEnterprises\Module\FAQ\Templates
 * @since         1.0.0
 * @author        RayZ0rG
 * @link          https://aliensoft.io
 * @license       GNU-2.0+
 *
 */


 namespace CRGEnterprises\Module\FAQ\Template;

 remove_action( 'genesis_loop', 'genesis_do_loop');
 add_action( 'genesis_loop', __NAMESPACE__ . '\do_faq_archive_loop' );

 /**
 * Do the FAQ archive loop and render out the HTML.
 *
 * @since 1.0.0
 *
 * @param string $archive_template Full qualified path to the archive template
 *
 * @return string
 */
 function do_faq_archive_loop() {

   $records = get_posts_grouped_by_term( 'faq', 'topic');

   if ( ! $records ) {
     echo '<p>Sorry there are no FAQs</p>';
   }

   foreach ( $records as $record ) {
     // load the view file
     include( __DIR__ . '/views/container.php' );
     //$hidden_content = do_shortcode( $hidden_content );
   }

 }

 function loop_and_render_faqs( array $faqs ){
   $attributes = array(
     'show_icon' => 'dashicons dashicons-arrow-down-alt2',
     'hide_icon' => 'dashicons dashicons-arrow-up-alt2'
   );

   foreach ( $faqs as $faq ) {
     // load the view file
     $hidden_content = do_shortcode( $faq['post_content'] );

     include( __DIR__ . '/views/faq.php' );
   }
 }

 genesis();
