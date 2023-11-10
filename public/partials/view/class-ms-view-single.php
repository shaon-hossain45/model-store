<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/public/partials/view
 */

if ( class_exists( 'MS_View_Card', false ) ) {
	return;
}

// Custom post type single page0
	public function model_store_template( $single_template ) {
		global $post;

		if ( $post->post_type == 'model_store' ) {
			$template_path = plugin_dir_path( __FILE__ ) . 'single-model_store.php';

			// Check if the template file exists
			if ( file_exists( $template_path ) ) {
				return $template_path;
			} else {
				// Fallback to the default template if the custom template doesn't exist
				return $single_template;
			}
		}

		return $single_template;
	}