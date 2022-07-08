<?php

// add_action( 'wp_enqueue_scripts', 'kadence_wadiweb_child_styles' );
// function kadence_wadiweb_child_styles() {
//     wp_enqueue_style( 'child-style', get_stylesheet_uri(),
//         array( 'parenthandle' ), 
//         wp_get_theme()->get('Version') // this only works if you have Version in the style header
//     );
// }

/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' ); // Remove the // from the beginning of this line if you want the child theme style.css file to load on the front end of your site.

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