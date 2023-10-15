<?php
/**
 * Twenty Twelve support.
 *
 * @class   WC_Twenty_Twelve
 * @since   3.3.0
 * @package WooCommerce\Classes
 */

/**
 * WC_Twenty_Twelve class.
 */
class MS_Twenty_Twelve {

	/**
	 * Theme init.
	 */
	public static function init() {
		// Remove default wrappers.
		//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
		//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

		// Add custom wrappers.
		add_action( 'model_store_before_main_content', array( 'MS_Twenty_Twelve', 'output_content_wrapper' ) );
		add_action( 'model_store_after_main_content', array( 'MS_Twenty_Twelve', 'output_content_wrapper_end' ) );

		// Declare theme support for features.
		// add_theme_support( 'wc-product-gallery-zoom' );
		// add_theme_support( 'wc-product-gallery-lightbox' );
		// add_theme_support( 'wc-product-gallery-slider' );
		// add_theme_support(
		// 	'woocommerce',
		// 	array(
		// 		'thumbnail_image_width' => 200,
		// 		'single_image_width'    => 300,
		// 	)
		// );
	}

	/**
	 * Open wrappers.
	 */
	public static function output_content_wrapper() {
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
	}

	/**
	 * Close wrappers.
	 */
	public static function output_content_wrapper_end() {
		echo '</div></div>';
	}
}

MS_Twenty_Twelve::init();
