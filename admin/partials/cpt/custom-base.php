<?php

/**
 * Provide a admin area view for the plugin
 *
 * @link       https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/admin/partials
 */

if ( ! class_exists( 'CptBaseSetup' ) ) {
	class CptBaseSetup {

		/**
		 * Initialize the class and set its properties.
		 *
		 * @since    1.0.0
		 * @param      string $plugin_name	The name of this plugin.
		 * @param      string $version	The version of this plugin.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'custom_post_type' ), 0 );
			
			// hook into the init action and call create_book_taxonomies when it fires
			add_action( 'init', array( $this, 'wpdocs_create_book_taxonomies' ), 0 );
		}

		// Register Custom Post Type
		function custom_post_type() {

			$labels = array(
				'name'                  => _x( 'Model Stores', 'Post Type General Name', 'model-store' ),
				'singular_name'         => _x( 'Model Store', 'Post Type Singular Name', 'model-store' ),
				'menu_name'             => __( 'Model Stores', 'model-store' ),
				'name_admin_bar'        => __( 'Model Store', 'model-store' ),
				'archives'              => __( 'Model Archives', 'model-store' ),
				'attributes'            => __( 'Model Attributes', 'model-store' ),
				'parent_item_colon'     => __( 'Parent Model:', 'model-store' ),
				'all_items'             => __( 'All Models', 'model-store' ),
				'add_new_item'          => __( 'Add New Model', 'model-store' ),
				'add_new'               => __( 'Add New', 'model-store' ),
				'new_item'              => __( 'New Model', 'model-store' ),
				'edit_item'             => __( 'Edit Model', 'model-store' ),
				'update_item'           => __( 'Update Model', 'model-store' ),
				'view_item'             => __( 'View Model', 'model-store' ),
				'view_items'            => __( 'View Models', 'model-store' ),
				'search_items'          => __( 'Search Model', 'model-store' ),
				'not_found'             => __( 'Not found', 'model-store' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'model-store' ),
				'featured_image'        => __( 'Model Image', 'model-store' ),
				'set_featured_image'    => __( 'Set model image', 'model-store' ),
				'remove_featured_image' => __( 'Remove model image', 'model-store' ),
				'use_featured_image'    => __( 'Use as model image', 'model-store' ),
				'insert_into_item'      => __( 'Insert into Model', 'model-store' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Model', 'model-store' ),
				'items_list'            => __( 'Models list', 'model-store' ),
				'items_list_navigation' => __( 'Models list navigation', 'model-store' ),
				'filter_items_list'     => __( 'Filter Models list', 'model-store' ),
			);
			$args   = array(
				'label'               => __( 'Model Store', 'model-store' ),
				'description'         => __( 'Post Type Description', 'model-store' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-welcome-widgets-menus',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				'rewrite'             => array('slug' => 'model'),
			);
			register_post_type( 'model_store', $args );

		}

		// Create two taxonomies, categories and tags for the post type "model_store"
		function wpdocs_create_book_taxonomies() {
			// Add new taxonomy, make it hierarchical (like categories)
			$labels = array(
				'name'              => _x( 'Model Categories', 'taxonomy general name', 'model-store' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name', 'model-store' ),
				'search_items'      => __( 'Search Model Categories', 'model-store' ),
				'all_items'         => __( 'All Model Categories', 'model-store' ),
				'parent_item'       => __( 'Parent Category', 'model-store' ),
				'parent_item_colon' => __( 'Parent Category:', 'model-store' ),
				'edit_item'         => __( 'Edit Category', 'model-store' ),
				'update_item'       => __( 'Update Category', 'model-store' ),
				'add_new_item'      => __( 'Add New Category', 'model-store' ),
				'new_item_name'     => __( 'New Category Name', 'model-store' ),
				'menu_name'         => __( 'Categories', 'model-store' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'model-category' ),
			);

			register_taxonomy( 'model_cat', array( 'model_store' ), $args );

			unset( $args );
			unset( $labels );

			// Add new taxonomy, NOT hierarchical (like tags)
			$labels = array(
				'name'                       => _x( 'Model Tags', 'taxonomy general name', 'model-store' ),
				'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'model-store' ),
				'search_items'               => __( 'Search Tags', 'model-store' ),
				'popular_items'              => __( 'Popular Tags', 'model-store' ),
				'all_items'                  => __( 'All Tags', 'model-store' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit Tag', 'model-store' ),
				'update_item'                => __( 'Update Tag', 'model-store' ),
				'add_new_item'               => __( 'Add New Tag', 'model-store' ),
				'new_item_name'              => __( 'New Tag Name', 'model-store' ),
				'separate_items_with_commas' => __( 'Separate tags with commas', 'model-store' ),
				'add_or_remove_items'        => __( 'Add or remove tags', 'model-store' ),
				'choose_from_most_used'      => __( 'Choose from the most used tags', 'model-store' ),
				'not_found'                  => __( 'No tags found.', 'model-store' ),
				'menu_name'                  => __( 'Tags', 'model-store' ),
			);

			$args = array(
				'hierarchical'          => false,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'model-tag' ),
			);

			register_taxonomy( 'model_tag', 'model_store', $args );
		}

	}
}
