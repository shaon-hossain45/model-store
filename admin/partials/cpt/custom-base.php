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

			add_action('admin_menu', array( $this, 'add_submenu_page_for_custom_post_type') );
			// register wordpress default setting fileds
			add_action('admin_init', array( $this, 'register_model_store_settings') );
			
			// meta box for file upload
			add_action('add_meta_boxes', array( $this, 'add_model_store_meta_box') );

			add_action('save_post', array( $this, 'save_model_store_meta_data') );

			add_action('add_meta_boxes', array( $this, 'add_gallery_meta_box') );
			add_action('save_post', array( $this, 'save_gallery_meta_box_data') );

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
				// 'rewrite'             => array('slug' => 'model'),
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

		// Model store submenu page like settings
		function add_submenu_page_for_custom_post_type() {
			add_submenu_page(
				'edit.php?post_type=model_store', // Parent slug (custom post type)
				'Settings', // Page title
				'Settings', // Menu title
				'manage_options', // Capability
				'model-store-settings', // Menu slug
				array( $this, 'render_model_store_settings_callback' ) // Callback function to render the page
			);
		}
		
		// Render callback of settings page
		function render_model_store_settings_callback() {
			// Retrieve any saved settings data
			$model_store_button_feature = get_option('model_store_button_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($model_store_button_feature === false) {
				$model_store_button_feature = 1; // Set it to 1 (checked) by default
			}

			$saved_title = get_option('model_store_title');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_title === false) {
				$saved_title = "View All Model Store"; // Set it to 1 (checked) by default
			}
			$saved_url = get_option('model_store_url');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_url === false) {
				$saved_url = home_url("/"); // Set it to 1 (checked) by default
			}

			// Extra Buttons
			$saved_like_feature = get_option('model_store_like_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_like_feature === false) {
				$saved_like_feature = 1; // Set it to 1 (checked) by default
			}
			$saved_collect_feature = get_option('model_store_collect_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_collect_feature === false) {
				$saved_collect_feature = 1; // Set it to 1 (checked) by default
			}

			$saved_alignment = get_option('model_store_alignment');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_alignment === false) {
				$saved_alignment = 2; // Set it to 2 (checked) by default
			}

			$saved_select_number = get_option('model_store_number');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_number === false) {
				$saved_select_number = 3; // Set it to 3 (checked) by default
			}

			$saved_related_number = get_option('model_related_number');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_related_number === false) {
				$saved_related_number = 4; // Set it to 4 (checked) by default
			}

			// Slider Options
			
			$saved_slider_speed = get_option('model_store_slider_speed');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_slider_speed === false) {
				$saved_slider_speed = 1500; // Set it to 1500 by default
			}

			$saved_navigation_feature = get_option('model_store_navigation_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_navigation_feature === false) {
				$saved_navigation_feature = 1; // Set it to 1 (checked) by default
			}
			
			$saved_pagination_feature = get_option('model_store_pagination_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_pagination_feature === false) {
				$saved_pagination_feature = 0; // Set it to 1 (checked) by default
			}

			$saved_autoplay_feature = get_option('model_store_autoplay_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_autoplay_feature === false) {
				$saved_autoplay_feature = 0; // Set it to 1 (checked) by default
			}

			$saved_slider_autoplay_delay = get_option('model_store_slider_autoplay_delay');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_slider_autoplay_delay === false) {
				$saved_slider_autoplay_delay = 1500; // Set it to 1500 by default
			}

			$saved_loop_feature = get_option('model_store_loop_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_loop_feature === false) {
				$saved_loop_feature = 0; // Set it to 1 (checked) by default
			}

			$saved_select_slider_number = get_option('model_store_slider_number');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_slider_number === false) {
				$saved_select_slider_number = 3; // Set it to 3 (checked) by default
			}

			$saved_breakpoint_feature = get_option('model_store_breakpoint_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_breakpoint_feature === false) {
				$saved_breakpoint_feature = 1; // Set it to 1 (checked) by default
			}

			$saved_select_breakpoint_phone = get_option('model_store_breakpoint_phone');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_phone === false) {
				$saved_select_breakpoint_phone = 1; // Set it to 1 (checked) by default
			}

			$saved_select_breakpoint_tablet = get_option('model_store_breakpoint_tablet');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_tablet === false) {
				$saved_select_breakpoint_tablet = 2; // Set it to 2 (checked) by default
			}

			$saved_select_breakpoint_desktop = get_option('model_store_breakpoint_desktop');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_desktop === false) {
				$saved_select_breakpoint_desktop = 3; // Set it to 3 (checked) by default
			}

			$saved_select_breakpoint_largescreen = get_option('model_store_breakpoint_largescreen');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_largescreen === false) {
				$saved_select_breakpoint_largescreen = 4; // Set it to 4 (checked) by default
			}

			$saved_3d_switch_button = get_option('model_store_3d_switch_button');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_3d_switch_button === false) {
				$saved_3d_switch_button = 0; // Set it to 0 (checked) by default
			}

			$saved_space_between = get_option('model_store_space_between');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_space_between === false) {
				$saved_space_between = 15; // Set it to 15 (checked) by default
			}

			$saved_slider_center = get_option('model_store_slider_center');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_slider_center === false) {
				$saved_slider_center = 0; // Set it to 0 (checked) by default
			}

			$saved_select_slider_effect = get_option('model_store_slider_effect');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_slider_effect === false) {
				$saved_select_slider_effect = 0; // Set it to 0 (checked) by default
			}



			
			// Check if the settings have been saved and display a success notice
			if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
				add_settings_error('model_store_settings_messages', 'settings_saved', __('Settings saved.', 'model-store'), 'updated');
			}

			echo '<div class="wrap">';
			echo '<h1>Model Store Settings</h1>';

			// Display any settings error messages
			settings_errors('model_store_settings_messages');

			echo '<form method="post" action="options.php">';
			settings_fields('model_store_settings_group');
			// Start settings field parts with table
			echo '<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><label for="model_store_number">Model Store Number</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Model Store Number</span></legend>
								<select id="model_store_number" name="model_store_number">
									<option value="0" ' . selected( $saved_select_number, 0, false ) . '>Select an option</option>
									<option value="1" ' . selected( $saved_select_number, 1, false ) . '>1</option>
									<option value="2" ' . selected( $saved_select_number, 2, false ) . '>2</option>
									<option value="3" ' . selected( $saved_select_number, 3, false ) . '>3</option>
									<option value="4" ' . selected( $saved_select_number, 4, false ) . '>4</option>
									<option value="5" ' . selected( $saved_select_number, 5, false ) . '>5</option>
								</select>
							<fieldset>
						</td>
					</tr>
					<tr><th scope="row"><hr></th><td><hr></td></tr>
					<tr>
						<th scope="row"><label for="model_related_number">Model Related Number</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Model Related Number</span></legend>
								<select id="model_related_number" name="model_related_number">
									<option value="0" ' . selected( $saved_related_number, 0, false ) . '>Select an option</option>
									<option value="3" ' . selected( $saved_related_number, 3, false ) . '>3</option>
									<option value="4" ' . selected( $saved_related_number, 4, false ) . '>4</option>
									<option value="5" ' . selected( $saved_related_number, 5, false ) . '>5</option>
								</select>
							<fieldset>
						</td>
					</tr>
					<tr><th scope="row"><hr></th><td><hr></td></tr>
					<tr>
						<th scope="row"><label>Modal Position</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Modal Position</span></legend>
								<div class="model-alignment">
									<div class="model-part">
										<input type="radio" id="model_store_alignment1" name="model_store_alignment" value="1" ' . checked($saved_alignment, 1, false) . '>
										<label for="model_store_alignment1">Left</label>
									</div>
    								<div class="model-part">
										<input type="radio" id="model_store_alignment2" name="model_store_alignment" value="2" ' . checked($saved_alignment, 2, false) . '>
										<label for="model_store_alignment2">Center</label>
									</div>
									<div class="model-part">
										<input type="radio" id="model_store_alignment3" name="model_store_alignment" value="3" ' . checked($saved_alignment, 3, false) . '>
										<label for="model_store_alignment3">Right</label>
									</div>
								</div>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_like_feature">Like Button</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Like Button</span></legend>
								<label for="model_store_like_feature"><input type="checkbox" id="model_store_like_feature" name="model_store_like_feature" value="1" ' . checked($saved_like_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_collect_feature">Collect Button</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Collect Button</span></legend>
								<label for="model_store_collect_feature"><input type="checkbox" id="model_store_collect_feature" name="model_store_collect_feature" value="1" ' . checked($saved_collect_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr><th scope="row"><hr></th><td><hr></td></tr>
					<tr>
						<th scope="row"><label for="model_store_button_feature">Button</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Button</span></legend>
								<label for="model_store_button_feature"><input type="checkbox" id="model_store_button_feature" name="model_store_button_feature" data-onload="' . esc_js('storeTitle') . ',' . esc_js('storeUrl') .'" onchange="fieldVisibility(event, \'' . esc_js('storeTitle') . '\', \'' . esc_js('storeUrl') . '\')" value="1" ' . checked($model_store_button_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr data-hidden="storeTitle" style="display: none;">
						<th scope="row"><label for="model_store_title">Title:</label></th>
						<td><input type="text" id="model_store_title" name="model_store_title" value="' . esc_attr($saved_title) . '" class="regular-text" /><br /><p class="description">Enter the Title for your model store name.</p></td>
					</tr>
					<tr data-hidden="storeUrl" style="display: none;">
						<th scope="row"><label for="model_store_url">Location:</label></th>
						<td><input type="url" id="model_store_url" name="model_store_url" value="' . esc_attr($saved_url) . '" class="regular-text code" /><br /><p class="description">Enter the URL for your model store link.</p></td>
					</tr>
					<tr><th scope="row"><hr></th><td><hr></td></tr>
					<tr>
						<th scope="row"><label for="model_store_breakpoint_feature">Slider Breakpoint</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Breakpoint</span></legend>
								<label for="model_store_breakpoint_feature"><input type="checkbox" id="model_store_breakpoint_feature" name="model_store_breakpoint_feature" data-onload="' . esc_js('storeBreakpoint') .'" onchange="fieldVisibility(event, \'' . esc_js('storeBreakpoint') . '\')" value="1" ' . checked($saved_breakpoint_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr data-hidden="storeBreakpoint" style="display: none;">
						<th scope="row"></th>
						<td>
							<div class="model-alignment">
								<div class="breakpoint-part">
									<label for="model_store_breakpoint_phone">Phone</label>
									<br />
									<select id="model_store_breakpoint_phone" name="model_store_breakpoint_phone">
										<option value="0" ' . selected( $saved_select_breakpoint_phone, 0, false ) . '>Select an option</option>
										<option value="1" ' . selected( $saved_select_breakpoint_phone, 1, false ) . '>1</option>
										<option value="2" ' . selected( $saved_select_breakpoint_phone, 2, false ) . '>2</option>
										<option value="3" ' . selected( $saved_select_breakpoint_phone, 3, false ) . '>3</option>
										<option value="4" ' . selected( $saved_select_breakpoint_phone, 4, false ) . '>4</option>
										<option value="5" ' . selected( $saved_select_breakpoint_phone, 5, false ) . '>5</option>
									</select>
								</div>
								<div class="breakpoint-part">
									<label for="model_store_breakpoint_tablet">Tablet</label>
									<br />
									<select id="model_store_breakpoint_tablet" name="model_store_breakpoint_tablet">
										<option value="0" ' . selected( $saved_select_breakpoint_tablet, 0, false ) . '>Select an option</option>
										<option value="1" ' . selected( $saved_select_breakpoint_tablet, 1, false ) . '>1</option>
										<option value="2" ' . selected( $saved_select_breakpoint_tablet, 2, false ) . '>2</option>
										<option value="3" ' . selected( $saved_select_breakpoint_tablet, 3, false ) . '>3</option>
										<option value="4" ' . selected( $saved_select_breakpoint_tablet, 4, false ) . '>4</option>
										<option value="5" ' . selected( $saved_select_breakpoint_tablet, 5, false ) . '>5</option>
									</select>
								</div>
								<div class="breakpoint-part">
									<label for="model_store_breakpoint_desktop">Desktop</label>
									<br />
									<select id="model_store_breakpoint_desktop" name="model_store_breakpoint_desktop">
										<option value="0" ' . selected( $saved_select_breakpoint_desktop, 0, false ) . '>Select an option</option>
										<option value="1" ' . selected( $saved_select_breakpoint_desktop, 1, false ) . '>1</option>
										<option value="2" ' . selected( $saved_select_breakpoint_desktop, 2, false ) . '>2</option>
										<option value="3" ' . selected( $saved_select_breakpoint_desktop, 3, false ) . '>3</option>
										<option value="4" ' . selected( $saved_select_breakpoint_desktop, 4, false ) . '>4</option>
										<option value="5" ' . selected( $saved_select_breakpoint_desktop, 5, false ) . '>5</option>
									</select>
								</div>
								<div class="breakpoint-part">
									<label for="model_store_breakpoint_largescreen">Large Screen</label>
									<br />
									<select id="model_store_breakpoint_largescreen" name="model_store_breakpoint_largescreen">
										<option value="0" ' . selected( $saved_select_breakpoint_largescreen, 0, false ) . '>Select an option</option>
										<option value="1" ' . selected( $saved_select_breakpoint_largescreen, 1, false ) . '>1</option>
										<option value="2" ' . selected( $saved_select_breakpoint_largescreen, 2, false ) . '>2</option>
										<option value="3" ' . selected( $saved_select_breakpoint_largescreen, 3, false ) . '>3</option>
										<option value="4" ' . selected( $saved_select_breakpoint_largescreen, 4, false ) . '>4</option>
										<option value="5" ' . selected( $saved_select_breakpoint_largescreen, 5, false ) . '>5</option>
									</select>
								</div>
							</div>
						</td>
					</tr>
					<tr data-preview="storeBreakpoint" style="display: none;">
						<th scope="row"><label for="model_store_slider_number">Slider Number</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Number</span></legend>
								<select id="model_store_slider_number" name="model_store_slider_number">
									<option value="0" ' . selected( $saved_select_slider_number, 0, false ) . '>Select an option</option>
									<option value="1" ' . selected( $saved_select_slider_number, 1, false ) . '>1</option>
									<option value="2" ' . selected( $saved_select_slider_number, 2, false ) . '>2</option>
									<option value="3" ' . selected( $saved_select_slider_number, 3, false ) . '>3</option>
									<option value="4" ' . selected( $saved_select_slider_number, 4, false ) . '>4</option>
									<option value="5" ' . selected( $saved_select_slider_number, 5, false ) . '>5</option>
								</select>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_slider_speed">Slider Speed:</label></th>
						<td><input type="number" id="model_store_slider_speed" name="model_store_slider_speed" value="' . esc_attr($saved_slider_speed) . '" class="regular-text" /><br /><p class="description">Enter the slider speed.</p></td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_navigation_feature">Slider Navigation</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Navigation</span></legend>
								<label for="model_store_navigation_feature"><input type="checkbox" id="model_store_navigation_feature" name="model_store_navigation_feature" value="1" ' . checked($saved_navigation_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_pagination_feature">Slider Pagination</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Pagination</span></legend>
								<label for="model_store_pagination_feature"><input type="checkbox" id="model_store_pagination_feature" name="model_store_pagination_feature" value="1" ' . checked($saved_pagination_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_autoplay_feature">Slider Autoplay</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Autoplay</span></legend>
								<label for="model_store_autoplay_feature"><input type="checkbox" id="model_store_autoplay_feature" name="model_store_autoplay_feature" data-onload="' . esc_js('autoplayDelay') .'" onchange="fieldVisibility(event, \'' . esc_js('autoplayDelay') . '\')" value="1" ' . checked($saved_autoplay_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr data-hidden="autoplayDelay" style="display: none;">
						<th scope="row"><label for="model_store_slider_autoplay_delay">Slider Autoplay Delay:</label></th>
						<td><input type="number" id="model_store_slider_autoplay_delay" name="model_store_slider_autoplay_delay" value="' . esc_attr($saved_slider_autoplay_delay) . '" class="regular-text" /><br /><p class="description">Enter the slider autoplay delay.</p></td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_loop_feature">Slider Loop</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Loop</span></legend>
								<label for="model_store_loop_feature"><input type="checkbox" id="model_store_loop_feature" name="model_store_loop_feature" value="1" ' . checked($saved_loop_feature, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_space_between">Slider Spacing:</label></th>
						<td><input type="number" id="model_store_space_between" name="model_store_space_between" value="' . esc_attr($saved_space_between) . '" class="regular-text" /><br /><p class="description">Enter spacing between of slide item.</p></td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_slider_center">Slider Center</label></th>
						<td>
							<fieldset>
									<legend class="screen-reader-text"><span>Slider Center</span></legend>
									<label for="model_store_slider_center"><input type="checkbox" id="model_store_slider_center" name="model_store_slider_center" value="1" ' . checked($saved_slider_center, 1, false) . ' />Enable Feature</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="model_store_slider_effect">Slider Effect</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>Slider Effect</span></legend>
								<select id="model_store_slider_effect" name="model_store_slider_effect" data-onload="' . esc_js('effect') .'" onchange="fieldVisibilitySelect(event,  \'' . esc_js('effect') . '\')">
									<option value="0" ' . selected( $saved_select_slider_effect, 0, false ) . '>Select an option</option>
									<option value="1" ' . selected( $saved_select_slider_effect, 1, false ) . '>Coverflow Effect</option>
								</select>
							</fieldset>
						</td>
					</tr>
					<tr data-select="effect" data-value="1" style="display: none;">
						<th scope="row"><label for="model_store_3d_switch_button">3D Slider</label></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span>3D Slider</span></legend>
								<div class="model-switchbox">
									<div class="model-switchpart">
										<input type="checkbox" id="model_store_3d_switch_button" name="model_store_3d_switch_button" value="1" ' . checked($saved_3d_switch_button, 1, false) . '>
										<label for="model_store_3d_switch_button">
											<span class="switch-on">On</span>
											<span class="switch-off">Off</span>
											<span class="switch-ball"></span>
										</label>
									</div>
									<span>Enable Feature</span>
								</div>
							</fieldset>
						</td>
					</tr>
				</tbody>
			</table>';
			// End settings field parts with table
			submit_button('Save Settings');
			echo '</form>';
			echo '</div>';
		}

		function register_model_store_settings() {
			register_setting('model_store_settings_group', 'model_store_button_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_title', 'sanitize_text_field');
			register_setting('model_store_settings_group', 'model_store_url', 'esc_url_raw');
			// Extra Buttons
			register_setting('model_store_settings_group', 'model_store_like_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_collect_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_alignment', 'absint');
			register_setting('model_store_settings_group', 'model_store_number', 'absint');
			register_setting('model_store_settings_group', 'model_related_number', 'absint');
			// Slider Options
			register_setting('model_store_settings_group', 'model_store_slider_speed', 'absint');
			register_setting('model_store_settings_group', 'model_store_navigation_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_pagination_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_autoplay_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_slider_autoplay_delay', 'absint');
			register_setting('model_store_settings_group', 'model_store_loop_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_slider_number', 'absint');
			register_setting('model_store_settings_group', 'model_store_breakpoint_feature', 'absint');
			register_setting('model_store_settings_group', 'model_store_breakpoint_phone', 'absint');
			register_setting('model_store_settings_group', 'model_store_breakpoint_tablet', 'absint');
			register_setting('model_store_settings_group', 'model_store_breakpoint_desktop', 'absint');
			register_setting('model_store_settings_group', 'model_store_breakpoint_largescreen', 'absint');
			register_setting('model_store_settings_group', 'model_store_3d_switch_button', 'absint');
			register_setting('model_store_settings_group', 'model_store_space_between', 'absint');
			register_setting('model_store_settings_group', 'model_store_slider_center', 'absint');
			register_setting('model_store_settings_group', 'model_store_slider_effect', 'absint');
			
		}

		// Meta box file upload
		function add_model_store_meta_box() {
			add_meta_box(
				'model_store_file_upload_meta_box',
				__( 'Model File', 'model-store' ),
				array( $this, 'render_model_store_meta_box' ),
				'model_store',  // Use the custom post type slug
				'side',
				'default'
			);
		}

		function render_model_store_meta_box($post) {
			// Retrieve the existing file URL, if any
			$file_urls = get_post_meta($post->ID, '_model_store_file_upload_meta_key', true);
		
			// Output the file upload field
			// Output the file upload field
			echo '<ul id="model_store_file_upload_list">';
			if ($file_urls) {
				foreach ($file_urls as $index => $file_url) {
					echo '<li><input type="text" name="model_store_file_upload_field[]" value="' . esc_attr($file_url) . '" readonly /><button class="remove-file-button" data-index="' . $index . '">Remove</button></li>';
				}
			}
			echo '</ul>';
			echo '<button class="button" id="upload_model_store_file_button">Set model file</button>';
		}

		function save_model_store_meta_data($post_id) {
			if (isset($_POST['model_store_file_upload_field'])) {
				$file_urls = array_map('esc_url', $_POST['model_store_file_upload_field']);
        		update_post_meta($post_id, '_model_store_file_upload_meta_key', $file_urls);
			}
		}



		function add_gallery_meta_box() {
			add_meta_box(
				'model_gallery_images',
				__( 'Model Gallery', 'model-store' ),
				array( $this, 'display_gallery_meta_box' ),
				'model_store',
				'side',
				'default'
			);
		}
		
		
		function display_gallery_meta_box($post) {
			// Display the gallery images here
			$gallery_images = get_post_meta($post->ID, 'model_image_gallery', true);
			$gallery_images_value = !empty($gallery_images) ? implode(',', $gallery_images) : '';
			$update_meta = false;
			$updated_gallery_ids = array();

			// Output the current images in the gallery
			echo '<div id="model_images_container">
			<ul class="model_images ui-sortable">';
				if (!empty($gallery_images)) {
					foreach ($gallery_images as $image_id) {
						$attachment = wp_get_attachment_image( $image_id, 'thumbnail' );
						// if attachment is empty skip.
						if ( empty( $attachment ) ) {
							$update_meta = true;
							continue;
						}
						echo '<li class="image" data-attachment_id="'. esc_attr( $image_id ) .'">'. $attachment .'<ul class="actions"><li><a href="#" class="delete" data-title="'. esc_attr("Delete image") .'">'. esc_html("Delete") .'</a></li></ul></li>';
						// rebuild ids to be saved.
						$updated_gallery_ids[] = $image_id;
					}
					// need to update product meta to set new gallery ids
					if ( $update_meta ) {
						update_post_meta( $post->ID, 'model_image_gallery', implode( ',', $updated_gallery_ids ) );
					}
				}
			echo '</ul></div>';
			echo '<input type="hidden" id="model_image_gallery" name="model_image_gallery" value="'. esc_attr( implode( ',', $updated_gallery_ids ) ) .'" />';
			// Add an "Add Images" button
			echo '<p class="add_model_images hide-if-no-js">
				<a href="#" data-choose="'. esc_attr( "Add images to model gallery" ) .'" data-update="'. esc_attr( "Add to gallery" ) .'" data-delete="'. esc_attr( "Delete image" ) .'" data-text="'. esc_attr( "Delete" ) .'">'. esc_html( "Add model gallery images" ) .'</a>
			</p>';
		}

		function save_gallery_meta_box_data($post_id) {
			if (isset($_POST['model_image_gallery'])) {
				$image_ids = explode(',', $_POST['model_image_gallery']);
				$image_ids = array_map('intval', $image_ids);
				update_post_meta($post_id, 'model_image_gallery', $image_ids);
			}
		}

	}
}
