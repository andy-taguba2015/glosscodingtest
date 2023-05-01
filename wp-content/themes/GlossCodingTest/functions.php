<?php
/**
 * Font Awesome CDN Setup Webfont
 * 
 * This will load Font Awesome from the Font Awesome Free or Pro CDN.
 */

if (! function_exists('fa_custom_setup_cdn_webfont') ) {
  function fa_custom_setup_cdn_webfont($cdn_url = '', $integrity = null) {
    $matches = [];
    $match_result = preg_match('|/([^/]+?)\.css$|', $cdn_url, $matches);
    $resource_handle_uniqueness = ($match_result === 1) ? $matches[1] : md5($cdn_url);
    $resource_handle = "font-awesome-cdn-webfont-$resource_handle_uniqueness";

    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $cdn_url, $resource_handle ) {
          wp_enqueue_style( $resource_handle, $cdn_url, [], null );
        }
      );
    }

    if($integrity) {
      add_filter(
        'style_loader_tag',
        function( $html, $handle ) use ( $resource_handle, $integrity ) {
          if ( in_array( $handle, [ $resource_handle ], true ) ) {
            return preg_replace(
              '/\/>$/',
              'integrity="' . $integrity .
              '" crossorigin="anonymous" />',
              $html,
              1
            );
          } else {
            return $html;
          }
        },
        10,
        2
      );
    }
  }
}

fa_custom_setup_cdn_webfont(
  'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
  'sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm'
);

function gloss_styles() {
//  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.css', array(),   );    
    wp_enqueue_style('style', get_stylesheet_uri() , array(), '1.0');

}

add_action('wp_enqueue_scripts', 'gloss_styles');

// Setup Theme

function glosscodingtest_setup() {
    
    // Create and Register the Menus
    register_nav_menus( array(
        'main_menu' => esc_html__('Main Menu', 'glosscodingtest')
    ));
    
    // Featured Image

add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'glosscodingtest_setup');

// Register Custom Post Type
function glosscodingtest_members() {

	$labels = array(
		'name'                  => _x( 'members', 'Post Type General Name', 'glosscodingtest' ),
		'singular_name'         => _x( 'member', 'Post Type Singular Name', 'glosscodingtest' ),
		'menu_name'             => __( 'Members', 'glosscodingtest' ),
		'name_admin_bar'        => __( 'Members', 'glosscodingtest' ),
		'archives'              => __( 'Our Members Archives', 'glosscodingtest' ),
		'attributes'            => __( 'Our Members Attributes', 'glosscodingtest' ),
		'parent_item_colon'     => __( 'Parent:', 'glosscodingtest' ),
		'all_items'             => __( 'All Members', 'glosscodingtest' ),
		'add_new_item'          => __( 'Add New Member', 'glosscodingtest' ),
		'add_new'               => __( 'Add New Member', 'glosscodingtest' ),
		'new_item'              => __( 'New Member', 'glosscodingtest' ),
		'edit_item'             => __( 'Edit Member', 'glosscodingtest' ),
		'update_item'           => __( 'Update Member', 'glosscodingtest' ),
		'view_item'             => __( 'View Member', 'glosscodingtest' ),
		'view_items'            => __( 'View Members', 'glosscodingtest' ),
		'search_items'          => __( 'Search Member', 'glosscodingtest' ),
		'not_found'             => __( 'Not found', 'glosscodingtest' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'glosscodingtest' ),
		'featured_image'        => __( 'Featured Image', 'glosscodingtest' ),
		'set_featured_image'    => __( 'Set featured image', 'glosscodingtest' ),
		'remove_featured_image' => __( 'Remove featured image', 'glosscodingtest' ),
		'use_featured_image'    => __( 'Use as featured image', 'glosscodingtest' ),
		'insert_into_item'      => __( 'Insert into Member', 'glosscodingtest' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Member', 'glosscodingtest' ),
		'items_list'            => __( 'Members list', 'glosscodingtest' ),
		'items_list_navigation' => __( 'Members list navigation', 'glosscodingtest' ),
		'filter_items_list'     => __( 'Filter Members list', 'glosscodingtest' ),
	);
	$args = array(
		'label'                 => __( 'member', 'glosscodingtest' ),
		'description'           => __( 'gloss members', 'glosscodingtest' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'glosscodingtest', $args );

}
add_action( 'init', 'glosscodingtest_members', 0 );


// Shortcode that displays the members list
// Use the shortcode: [glossmembers]

function glosscodingtest_members_shortcode() {
    
    $args = array(
        'posts_per_page' => 10,
        'post_type' => 'glosscodingtest',
        'orderby' => 'name',
        'order' => 'ASC'
    );
    $members = new WP_Query($args);
    while($members ->have_posts()): $members->the_post(); ?>
       <div class="memberscontent">
           <?php the_post_thumbnail(); ?>
            <h3><?php the_title(); ?></h3>
            <p><?php the_field('position'); ?></p>
       </div>
    <?php
    endwhile; wp_reset_postdata();
}

add_shortcode('glossmembers', 'glosscodingtest_members_shortcode');
    
