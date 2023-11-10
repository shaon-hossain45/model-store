<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'MS_Public_Frontend_Scripts' ) ) {

	/**
	 * Frontend scripts class.
	 */
	class MS_Public_Frontend_Scripts {

		/**
		 * Contains an array of script handles registered by WC.
		 *
		 * @var array
		 */
		private static $scripts = array();

		/**
		 * Contains an array of script handles registered by WC.
		 *
		 * @var array
		 */
		private static $styles = array();

		/**
		 * Contains an array of script handles localized by WC.
		 *
		 * @var array
		 */
		//private static $wp_localize_scripts = array();

		/**
		 * Hook in methods.
		 */
		public static function init() {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
			//add_action( 'wp_print_scripts', array( __CLASS__, 'localize_printed_scripts' ), 5 );
			//add_action( 'wp_print_footer_scripts', array( __CLASS__, 'localize_printed_scripts' ), 5 );
		}

		/**
		 * Return asset URL.
		 *
		 * @param string $path Assets path.
		 * @return string
		 */
		private static function get_asset_url( $path ) {
			return plugins_url( $path, MS_PLUGIN_FILE );
		}

		/**
		 * Get styles for the frontend.
		 *
		 * @return array
		 */
		// public static function get_styles() {
		// 	$version = MS_Constants::get_constant( 'WC_VERSION' );

		// 	/**
		// 	 * Filter list of WooCommerce styles to enqueue.
		// 	 *
		// 	 * @since 2.1.0
		// 	 * @param array List of default WooCommerce styles.
		// 	 * @return array List of styles to enqueue.
		// 	 */
		// 	$styles = apply_filters(
		// 		'woocommerce_enqueue_styles',
		// 		array(
		// 			'woocommerce-layout'      => array(
		// 				'src'     => self::get_asset_url( 'assets/css/woocommerce-layout.css' ),
		// 				'deps'    => '',
		// 				'version' => $version,
		// 				'media'   => 'all',
		// 				'has_rtl' => true,
		// 			),
		// 			'woocommerce-blocktheme'  => wc_current_theme_is_fse_theme() ? array(
		// 				'src'     => self::get_asset_url( 'assets/css/woocommerce-blocktheme.css' ),
		// 				'deps'    => '',
		// 				'version' => $version,
		// 				'media'   => 'all',
		// 				'has_rtl' => true,
		// 			) : false,
		// 		)
		// 	);
		// 	return is_array( $styles ) ? array_filter( $styles ) : array();
		// }

		
		/**
		 * Register a script for use.
		 *
		 * @uses   wp_register_script()
		 * @param  string   $handle    Name of the script. Should be unique.
		 * @param  string   $path      Full URL of the script, or path of the script relative to the WordPress root directory.
		 * @param  string[] $deps      An array of registered script handles this script depends on.
		 * @param  string   $version   String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
		 * @param  boolean  $in_footer Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
		 */
		private static function register_script( $handle, $path, $deps = array( 'jquery' ), $version = MS_VERSION, $in_footer = true ) {
			self::$scripts[] = $handle;
			wp_register_script( $handle, $path, $deps, $version, $in_footer );
		}

		/**
		 * Register and enqueue a script for use.
		 *
		 * @uses   wp_enqueue_script()
		 * @param  string   $handle    Name of the script. Should be unique.
		 * @param  string   $path      Full URL of the script, or path of the script relative to the WordPress root directory.
		 * @param  string[] $deps      An array of registered script handles this script depends on.
		 * @param  string   $version   String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
		 * @param  boolean  $in_footer Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
		 */
		private static function enqueue_script( $handle, $path = '', $deps = array( 'jquery' ), $version = MS_VERSION, $in_footer = true ) {
			if ( ! in_array( $handle, self::$scripts, true ) && $path ) {
				self::register_script( $handle, $path, $deps, $version, $in_footer );
			}
			wp_enqueue_script( $handle );
		}

		/**
		 * Register a style for use.
		 *
		 * @uses   wp_register_style()
		 * @param  string   $handle  Name of the stylesheet. Should be unique.
		 * @param  string   $path    Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
		 * @param  string[] $deps    An array of registered stylesheet handles this stylesheet depends on.
		 * @param  string   $version String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
		 * @param  string   $media   The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
		 * @param  boolean  $has_rtl If has RTL version to load too.
		 */
		private static function register_style( $handle, $path, $deps = array(), $version = WC_VERSION, $media = 'all', $has_rtl = false ) {
			self::$styles[] = $handle;
			wp_register_style( $handle, $path, $deps, $version, $media );

			if ( $has_rtl ) {
				wp_style_add_data( $handle, 'rtl', 'replace' );
			}
		}

		/**
		 * Register and enqueue a styles for use.
		 *
		 * @uses   wp_enqueue_style()
		 * @param  string   $handle  Name of the stylesheet. Should be unique.
		 * @param  string   $path    Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
		 * @param  string[] $deps    An array of registered stylesheet handles this stylesheet depends on.
		 * @param  string   $version String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
		 * @param  string   $media   The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
		 * @param  boolean  $has_rtl If has RTL version to load too.
		 */
		private static function enqueue_style( $handle, $path = '', $deps = array(), $version = WC_VERSION, $media = 'all', $has_rtl = false ) {
			if ( ! in_array( $handle, self::$styles, true ) && $path ) {
				self::register_style( $handle, $path, $deps, $version, $media, $has_rtl );
			}
			wp_enqueue_style( $handle );
		}

		/**
		 * Register all WC scripts.
		 */
		private static function register_scripts() {
			$suffix  = MS_Constants::is_true( 'SCRIPT_DEBUG' ) ? '' : '.min';
			$version = MS_Constants::get_constant( 'MS_VERSION' );

			$register_scripts = array(
				'jQuery'                 => array(
					'src'     => self::get_asset_url( 'public/js/vendor/jquery-3.7.1.min' . $suffix . '.js' ),
					'deps'    => array(''),
					'version' => '3.7.1',
				),
				'ms-swiper-bundle'                 => array(
					'src'     => self::get_asset_url( 'public/js/vendor/swiper-bundle.min' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => '10.3.1',
				),
				'ms-swiper-slider'                 => array(
					'src'     => self::get_asset_url( 'public/js/ms-public-swiper-slider' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => '10.3.1',
				),
				'ms-search'                 => array(
					'src'     => self::get_asset_url( 'public/js/ms-public-search' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => $version,
				),
				'ms-action'                 => array(
					'src'     => self::get_asset_url( 'public/js/ms-public-search-action' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => $version,
				),
			);
			foreach ( $register_scripts as $name => $props ) {
				self::register_script( $name, $props['src'], $props['deps'], $props['version'] );
			}
		}

		/**
		 * Register all WC styles.
		 */
		private static function register_styles() {
			$version = MS_Constants::get_constant( 'MS_VERSION' );

			$register_styles = array(
				'ms-font-awesome'                  => array(
					'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
					'deps'    => array(),
					'version' => '6.4.2',
					'has_rtl' => false,
				),
				'ms-swiper-bundle'                  => array(
					'src'     => self::get_asset_url( 'public/css/vendor/swiper-bundle.min.css' ),
					'deps'    => array(),
					'version' => '10.3.1',
					'has_rtl' => false,
				),
				'ms-single'                  => array(
					'src'     => self::get_asset_url( 'public/css/ms-public-single-model.css' ),
					'deps'    => array(),
					'version' => $version,
					'has_rtl' => false,
				),
				'ms-store'                  => array(
					'src'     => self::get_asset_url( 'public/css/ms-public-store.css' ),
					'deps'    => array(),
					'version' => $version,
					'has_rtl' => false,
				),
			);
			foreach ( $register_styles as $name => $props ) {
				self::register_style( $name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl'] );
			}
		}

		/**
		 * Register/queue frontend scripts.
		 */
		public static function load_scripts($hook) {
			global $post;

			// if ( ! did_action( 'before_woocommerce_init' ) ) {
			// 	return;
			// }

			self::register_scripts();
			self::register_styles();

			self::enqueue_script( 'jQuery' );

			if ( is_singular() && has_shortcode( get_post()->post_content, 'model_slider' ) ) {
				self::enqueue_script( 'ms-swiper-bundle' );
				self::enqueue_script( 'ms-swiper-slider' );
			}

			if ( is_singular( 'model_store' ) ) {
				self::enqueue_script( 'ms-swiper-slider' );
			}

			if ( is_singular() && has_shortcode( get_post()->post_content, 'model_search' ) ) {
				self::enqueue_script( 'ms-search' );
				self::enqueue_script( 'ms-action' );
			}

			
			self::enqueue_style( 'ms-font-awesome' );

			if ( is_singular() && has_shortcode( get_post()->post_content, 'model_slider' ) ) {
				self::enqueue_style( 'ms-swiper-bundle' );
			}

			if ( is_singular( 'model_store' ) ) {
				self::enqueue_style( 'ms-swiper-bundle' );
			}

			self::enqueue_style( 'ms-single' );
			self::enqueue_style( 'ms-store' );
		}

		/**
		 * Localize a WC script once.
		 *
		 * @since 2.3.0 this needs less wp_script_is() calls due to https://core.trac.wordpress.org/ticket/28404 being added in WP 4.0.
		 * @param string $handle Script handle the data will be attached to.
		 */
		// private static function localize_script( $handle ) {
		// 	if ( ! in_array( $handle, self::$wp_localize_scripts, true ) && wp_script_is( $handle ) ) {
		// 		$data = self::get_script_data( $handle );

		// 		if ( ! $data ) {
		// 			return;
		// 		}

		// 		$name                        = str_replace( '-', '_', $handle ) . '_params';
		// 		self::$wp_localize_scripts[] = $handle;
		// 		wp_localize_script( $handle, $name, apply_filters( $name, $data ) );
		// 	}
		// }

		/**
		 * Return data for script handles.
		 *
		 * @param  string $handle Script handle the data will be attached to.
		 * @return array|bool
		 */
		// private static function get_script_data( $handle ) {
		// 	global $wp;

		// 	switch ( $handle ) {
		// 		case 'woocommerce':
		// 			$params = array(
		// 				'ajax_url'    => WC()->ajax_url(),
		// 				'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		// 			);
		// 			break;
		// 		case 'wc-geolocation':
		// 			$params = array(
		// 				'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		// 				'home_url'    => remove_query_arg( 'lang', home_url() ), // FIX for WPML compatibility.
		// 			);
		// 			break;
		// 		case 'wc-cart':
		// 			$params = array(
		// 				'ajax_url'                     => WC()->ajax_url(),
		// 				'wc_ajax_url'                  => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		// 				'update_shipping_method_nonce' => wp_create_nonce( 'update-shipping-method' ),
		// 				'apply_coupon_nonce'           => wp_create_nonce( 'apply-coupon' ),
		// 				'remove_coupon_nonce'          => wp_create_nonce( 'remove-coupon' ),
		// 			);
		// 			break;
		// 		case 'wc-cart-fragments':
		// 			$params = array(
		// 				'ajax_url'        => WC()->ajax_url(),
		// 				'wc_ajax_url'     => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		// 				'cart_hash_key'   => apply_filters( 'woocommerce_cart_hash_key', 'wc_cart_hash_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
		// 				'fragment_name'   => apply_filters( 'woocommerce_cart_fragment_name', 'wc_fragments_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
		// 				'request_timeout' => 5000,
		// 			);
		// 			break;
		// 		case 'wc-add-to-cart':
		// 			$params = array(
		// 				'ajax_url'                => WC()->ajax_url(),
		// 				'wc_ajax_url'             => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		// 				'i18n_view_cart'          => esc_attr__( 'View cart', 'woocommerce' ),
		// 				'cart_url'                => apply_filters( 'woocommerce_add_to_cart_redirect', wc_get_cart_url(), null ),
		// 				'is_cart'                 => is_cart(),
		// 				'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' ),
		// 			);
		// 			break;
		// 		case 'wc-password-strength-meter':
		// 			$params = array(
		// 				'min_password_strength' => apply_filters( 'woocommerce_min_password_strength', 3 ),
		// 				'stop_checkout'         => apply_filters( 'woocommerce_enforce_password_strength_meter_on_checkout', false ),
		// 				'i18n_password_error'   => esc_attr__( 'Please enter a stronger password.', 'woocommerce' ),
		// 				'i18n_password_hint'    => esc_attr( wp_get_password_hint() ),
		// 			);
		// 			break;
		// 		default:
		// 			$params = false;
		// 	}

		// 	$params = apply_filters_deprecated( $handle . '_params', array( $params ), '3.0.0', 'woocommerce_get_script_data' );

		// 	return apply_filters( 'woocommerce_get_script_data', $params, $handle );
		// }

		/**
		 * Localize scripts only when enqueued.
		 */
		// public static function localize_printed_scripts() {
		// 	foreach ( self::$scripts as $handle ) {
		// 		self::localize_script( $handle );
		// 	}
		// }
	}

	MS_Public_Frontend_Scripts::init();

}
