<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/admin/partials/cpt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'MS_View_Base', false ) ) {
	return;
}

/**
 * MS_Cpt_Base class.
 */
class MS_View_Base {

	/**
	 * CPT init.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_type' ) );
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_ms_file_meta_box' ) );
		add_action( 'save_post', array( __CLASS__, 'save_ms_file_meta_box' ) );
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_ms_gallery_meta_box' ) );
		add_action( 'save_post', array( __CLASS__, 'save_ms_gallery_meta_box' ) );
	}

	/**
	 * Register post type.
	 *
	 * @since 1.0.0
	 */
	public static function register_post_type() {

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

		$args = array(
			'label'               => __( 'Model Store', 'model-store' ),
			'description'         => __( 'Post Type Description', 'model-store' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields' ),
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
			'rewrite'             => array( 'slug' => 'model' ),
		);
		register_post_type( 'model_store', $args );
	}

	/**
	 * Register taxonomies.
	 *
	 * @since 1.0.0
	 */
	public static function register_taxonomies() {

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

	/**
	 * Meta box file upload.
	 *
	 * @since 1.0.0
	 */
	public static function add_ms_file_meta_box() {
		add_meta_box(
			'ms_file_upload',
			__( 'Model File', 'model-store' ),
			array( __CLASS__, 'render_ms_file_meta_box' ),
			'model_store',
			'side',
			'default'
		);
	}

	/**
	 * Render file upload.
	 *
	 * @param WP_Post $post Current post object.
	 * @since 1.0.0
	 */
	public static function render_ms_file_meta_box( $post ) {
		// Retrieve the existing file URL, if any.
		$file_urls = get_post_meta( $post->ID, '_ms_file_upload', true );

		// Output the file upload field.
		echo '<ul id="ms_file_upload_list">';
		if ( $file_urls ) {
			foreach ( $file_urls as $index => $file_url ) {
				echo '<li><input type="text" name="ms_file_upload_field[]" value="' . esc_attr( $file_url ) . '" readonly /><button class="remove-file-button" data-index="' . $index . '">Remove</button></li>';
			}
		}
		echo '</ul>';
		echo '<p class="add_model_files hide-if-no-js">
			<a href="http://localhost/wordpress/wp-admin/media-upload.php?post_id=' . $post->ID . '&amp;TB_iframe=1" class="filebox">Set model file</a>
		</p>';
	}

	/**
	 * Save file upload.
	 *
	 * @param int $post_id Post ID.
	 * @since 1.0.0
	 */
	public static function save_ms_file_meta_box( $post_id ) {
		if ( isset( $_POST['ms_file_upload_field'] ) ) {
			$file_urls = array_map( 'esc_url', $_POST['ms_file_upload_field'] );
			update_post_meta( $post_id, '_ms_file_upload', $file_urls );
		}
	}

	/**
	 * Meta box gallery images.
	 *
	 * @since 1.0.0
	 */
	public static function add_ms_gallery_meta_box() {
		add_meta_box(
			'ms_gallery_images',
			__( 'Model Gallery', 'model-store' ),
			array( __CLASS__, 'render_ms_gallery_meta_box' ),
			'model_store',
			'side',
			'default'
		);
	}

	/**
	 * Render gallery.
	 *
	 * @param WP_Post $post Current post object.
	 * @since 1.0.0
	 */
	public static function render_ms_gallery_meta_box( $post ) {
		// Display the gallery images here.
		$gallery_images       = get_post_meta( $post->ID, '_ms_gallery_images', true );
		$gallery_images_value = ! empty( $gallery_images ) ? implode( ',', $gallery_images ) : '';
		$update_meta          = false;
		$updated_gallery_ids  = array();

		// Output the current images in the gallery
		echo '<div id="ms_images_container">
			<ul class="ms_images ui-sortable">';
		if ( ! empty( $gallery_images ) ) {
			foreach ( $gallery_images as $image_id ) {
				$attachment = wp_get_attachment_image( $image_id, 'thumbnail' );
				// if attachment is empty skip.
				if ( empty( $attachment ) ) {
					$update_meta = true;
					continue;
				}
				echo '<li class="image" data-attachment_id="' . esc_attr( $image_id ) . '">' . $attachment . '<ul class="actions"><li><a href="#" class="delete" data-title="' . esc_attr( 'Delete image' ) . '">' . esc_html( 'Delete' ) . '</a></li></ul></li>';
				// rebuild ids to be saved.
				$updated_gallery_ids[] = $image_id;
			}
			// need to update product meta to set new gallery ids
			if ( $update_meta ) {
				update_post_meta( $post->ID, '_ms_gallery_images', implode( ',', $updated_gallery_ids ) );
			}
		}
		echo '</ul></div>';
		echo '<input type="hidden" id="ms_gallery_images" name="ms_gallery_images" value="' . esc_attr( implode( ',', $updated_gallery_ids ) ) . '" />';
		// Add an "Add Images" button
		echo '<p class="add_model_images hide-if-no-js">
				<a href="#" data-choose="' . esc_attr( 'Add images to model gallery' ) . '" data-update="' . esc_attr( 'Add to gallery' ) . '" data-delete="' . esc_attr( 'Delete image' ) . '" data-text="' . esc_attr( 'Delete' ) . '">' . esc_html( 'Add model gallery images' ) . '</a>
			</p>';
	}

	/**
	 * Save gallery.
	 *
	 * @param int $post_id Post ID.
	 * @since 1.0.0
	 */
	public static function save_ms_gallery_meta_box( $post_id ) {
		if ( isset( $_POST['ms_gallery_images'] ) ) {
			$image_ids = explode( ',', $_POST['ms_gallery_images'] );
			$image_ids = array_map( 'intval', $image_ids );
			update_post_meta( $post_id, '_ms_gallery_images', $image_ids );
		}
	}
}
