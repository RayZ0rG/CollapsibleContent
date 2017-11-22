<?php
/**
 * FAQ Module Handler
 *
 * @package       CRGEnterprises\Module\FAQ\Shortcode
 * @since         1.0.0
 * @author        RayZ0rG
 * @link          https://aliensoft.io
 * @license       GNU-2.0+
 *
 */

 namespace CRGEnterprises\Module\FAQ\Shortcode;

 add_shortcode( 'faq', __NAMESPACE__ . '\process_the_shortcode' );

 /**
  * Process the
  *
  * @since 1.0.0
  *
  * @param array|string $user_defined_attributes User defined attributes for this shortcode instance
  * @param string|null $content Content between the opening and closing shortcode elements
  * @param string $shortcode_name Name of the shortcode
  *
  * @return String
  */
 function process_the_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
   $config = get_shortcode_configuration();
   	$attributes = shortcode_atts(
   		$config['defaults'],
   		$user_defined_attributes,
   		$shortcode_name
   	);

  $attributes['post_id'] = (int) $attributes['post_id'];

  if ( ($attributes['post_id'] < 1) && ( ! $attributes['topic'] ) ) {
      return '';
  }

  $attributes['show_icon'] = esc_attr( $attributes['show_icon'] );

 	// Call the view file, capture it into the output buffer, and then return it.
 	ob_start();
  if ( $attributes['post_id'] > 0 ) {
    render_single_faq( $attributes, $config );
  } else {
    render_topic_faqs( $attributes, $config );
  }
 	return ob_get_clean();
 }

 function render_single_faq( array $attributes, array $config ) {
    $faq = get_post( $attributes['post_id'] );

    if ( ! $faq ) {
      return render_none_found_message( $attributes );
    }

    $post_title     = $faq->post_title;
    $hidden_content = do_shortcode( $faq->post_content );

    include( $config['views']['container_single'] );
 }

 function render_topic_faqs( array $attributes, array $config ) {
    $config_args = array(
          'posts_per_page'  => (int) $attributes['number_of_faqs'],
          'nopaging'        => true,
          'post_type'       => 'faq',
          'tax_query'       => array(
              array(
                  'taxonomy'  => 'topic',
                  'field'     => 'slug',
                  'terms'     => $attributes['topic'],
              ),
          ),
          'order'           => 'ASC',
          'orderby'         => 'menu_order',
    );

    $query = new \WP_Query( $config_args );

    if ( ! $query -> have_posts() ) {
        return render_none_found_message( $attributes, false );
    }

    include( $config['views']['container_topic'] );

    // Reset Post Data
    wp_reset_postdata();
 }

 function loop_and_render_faqs_by_topic( $query, array $attributes, array $config ) {
     //die('yep it worked');
     while ( $query -> have_posts() ) {
         $query -> the_post();

         $post_title     = get_the_title();
         $hidden_content = do_shortcode( get_the_content() );

         include( $config['views']['faq'] );
     }

 }

 function render_none_found_message( array $attributes, $is_single_faq = true ) {

   if ( ! $attributes['show_none_found_message'] ) {
      return;
   }

   $message = $is_single_faq
      ? $attributes['none_found_single']
      : $attributes['none_found_by_topic'];

   echo "<p>{$message}</p>";
 }

 /**
  * Get the runtime configuration parameters for the specified shortcode.
  *
  * @since 1.0.0
  *
  * @param string $shortcode_name Name of the shortcode
  *
  * @return array
  */
 function get_shortcode_configuration() {

   return array(
     'views'         => array(
          'container_single'  => __DIR__ . '/views/container-single.php',
          'container_topic'   => __DIR__ . '/views/container-topic.php',
          'faq'               => __DIR__ . '/views/faq.php',
      ),
     'defaults'         => array(
       'show_icon'      => 'dashicons dashicons-arrow-down-alt2',
       'hide_icon'      => 'dashicons dashicons-arrow-up-alt2',
       'post_id'        => 0,
       'topic'          => '',
       'number_of_faqs' => -1,
       'show_none_found_message' => 1,
       'none_found_by_topic' => __( 'Sorry, no FAQs were found for that topic', FAQ_MODULE_TEXT_DOMAIN),
       'none_found_single' => __( 'Sorry, no FAQ was found', FAQ_MODULE_TEXT_DOMAIN),
      ),

   );
 }