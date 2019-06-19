<?php
/*
Plugin Name: Standard | Custom posts
Description: All custom posts
Plugin URI: http://www.anonymous.paris
Author: anonymous
Author URI: http://www.anonymous.paris/
Version: 0.1
*/

/*
 * CUSTOM POST
 */

function custom_post_type() {
	// Movie
	$labels = array(
		'name'                => _x( 'Movie', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Movies', 'text_domain' ),
		'name_admin_bar'      => __( 'Movie', 'text_domain' ),
		'parent_item_colon'   => __( 'Movie parent', 'text_domain' ),
		'all_items'           => __( 'All movies', 'text_domain' ),
		'add_new_item'        => __( 'Add a new movie', 'text_domain' ),
		'add_new'             => __( 'Add a movie', 'text_domain' ),
		'new_item'            => __( 'New movie', 'text_domain' ),
		'edit_item'           => __( 'Edit movie', 'text_domain' ),
		'update_item'         => __( 'Update movie', 'text_domain' ),
		'view_item'           => __( 'View movie', 'text_domain' ),
		'search_items'        => __( 'Search movie', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in trash', 'text_domain' ),
	);

	$args = array(
		'label'               => __( 'movie', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'revisions'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-video-alt3',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'query_var'           => true,
	);
	register_post_type( 'movie', $args );


	// Director
	$labels = array(
		'name'                => _x( 'Director', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Director', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Directors', 'text_domain' ),
		'name_admin_bar'      => __( 'Director', 'text_domain' ),
		'parent_item_colon'   => __( 'Director parent', 'text_domain' ),
		'all_items'           => __( 'All directors', 'text_domain' ),
		'add_new_item'        => __( 'Add a new director', 'text_domain' ),
		'add_new'             => __( 'Add a director', 'text_domain' ),
		'new_item'            => __( 'New director', 'text_domain' ),
		'edit_item'           => __( 'Edit director', 'text_domain' ),
		'update_item'         => __( 'Update director', 'text_domain' ),
		'view_item'           => __( 'View director', 'text_domain' ),
		'search_items'        => __( 'Search director', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in trash', 'text_domain' ),
	);

	$args = array(
		'label'               => __( 'director', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array('title', 'revisions'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-video-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'query_var'           => true,
	);
	register_post_type( 'director', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );
add_theme_support('post-thumbnails', array('ambiances', 'companies'));


/*
 * TAXONOMY
 */

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All categories', 'text_domain' ),
		'parent_item'                => __( 'Category parent', 'text_domain' ),
		'parent_item_colon'          => __( 'Category parent:', 'text_domain' ),
		'new_item_name'              => __( 'New category', 'text_domain' ),
		'add_new_item'               => __( 'Add a category', 'text_domain' ),
		'edit_item'                  => __( 'Edit a category', 'text_domain' ),
		'update_item'                => __( 'Update category', 'text_domain' ),
		'view_item'                  => __( 'See category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove category', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular categories', 'text_domain' ),
		'search_items'               => __( 'Search categories', 'text_domain' ),
		'not_found'                  => __( 'Not found', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'movie_category', array( 'movie' ), $args );
	register_taxonomy( 'director_category', array( 'director' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );


/*
 * REMOVE MENU
 */

function remove_menus(){

	remove_menu_page( 'index.php' );                  // Dashboard
	remove_menu_page( 'edit.php' );                      // Posts
	// remove_menu_page( 'upload.php' );                 // Media
	// remove_menu_page( 'edit.php?post_type=page' );    // Pages
	remove_menu_page( 'edit-comments.php' );             // Comments
	// remove_menu_page( 'themes.php' );                 // Appearance
	// remove_menu_page( 'plugins.php' );                // Plugins
	// remove_menu_page( 'users.php' );                  // Users
	// remove_menu_page( 'tools.php' );                  // Tools
	// remove_menu_page( 'options-general.php' );        // Settings

}
add_action( 'admin_menu', 'remove_menus' );


/*
 * REMOVE FIELDS PAGES
 */

function remove_fields() {

	remove_post_type_support('page', 'editor'); // Editor

}

add_action( 'admin_menu' , 'remove_fields' );