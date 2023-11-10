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

if ( class_exists( 'MS_View_Search', false ) ) {
	return;
}

/**
 * MS_View_Card class
 */
class MS_View_Search {

	/**
	 * CPT init.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		// Register shortcode.
		add_shortcode( 'model_search', array( __CLASS__, 'ms_search_shortcode' ) );
	}

	/**
	 * Shortcode public
	 *
	 * @return void
	 */
	public static function ms_search_shortcode() {
		// Store Button
		$model_store_button_feature = get_option( 'model_store_button_feature' );
		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $model_store_button_feature === false ) {
			$model_store_button_feature = 1; // Set it to 1 (checked) by default
		}

		$saved_title = get_option( 'model_store_title' );
		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $saved_title === false ) {
			$saved_title = 'View All Model Store'; // Set it to 1 (checked) by default
		}
		$get_store_location_url = get_option( 'model_store_url' );
		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $get_store_location_url === false ) {
			$get_store_location_url = home_url( '/' ); // Set it to 1 (checked) by default
		}

		$saved_alignment = get_option( 'model_store_alignment' );
		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $saved_alignment === false ) {
			$saved_alignment = 2; // Set it to 2 (checked) by default
		}

		$output = '';

		$output .= '<div class="dashboard-main">
			<div class="dashboard-searchbar">
				<form id="searchForm" class="searchBar-pGWTK" action="' . esc_url( home_url( '/' ) ) . '" method="POST">
					<div class="searchIcon-MYkVc">
						<input id="search-input" name="model_search" type="text" placeholder="Search Model">
						<span id="close" style="display: none;"><i class="fa-solid fa-xmark"></i></span>
					</div>
					<button type="submit" name="search">Search</button>
				</form>
			</div>';
		if ( $model_store_button_feature == 1 ) {
			$output .= '<a href="' . $get_store_location_url . '" class="store-btn">' . $saved_title . '</a>';
		}
		$output .= '</div>';

		$output .= '<div class="model-modal ' . ( ( $saved_alignment == 1 ) ? 'left' : ( ( $saved_alignment == 3 ) ? 'right' : 'center' ) ) . '"><div class="modal-content"><div class="preloader-container d-none"><span class="preloader"></span></div><span class="close">&times;</span><div class="search-results"></div></div></div>';

		// Output needs to be return
		return $output;
	}
}
