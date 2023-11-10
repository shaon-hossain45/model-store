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

if ( ! class_exists( 'MS_Admin_Backend_Scripts' ) ) {

	/**
	 * Frontend scripts class.
	 */
	class MS_Admin_Backend_Scripts {

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
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
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
				'ms-settings'                 => array(
					'src'     => self::get_asset_url( 'admin/js/ms-admin-settings' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => $version,
				),
				'ms-upload'                 => array(
					'src'     => self::get_asset_url( 'admin/js/ms-admin-upload' . $suffix . '.js' ),
					'deps'    => array( 'jquery' ),
					'version' => $version,
				),
				'ms-gallery'                 => array(
					'src'     => self::get_asset_url( 'admin/js/ms-admin-gallery' . $suffix . '.js' ),
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
					'version' => '6.4.2-ms.'.$version,
					'has_rtl' => false,
				),
				'ms-settings'                  => array(
					'src'     => self::get_asset_url( 'admin/css/ms-admin-settings.css' ),
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

			if ( $hook === 'model_store_page_model-store-settings' ) {
				self::enqueue_script( 'ms-settings' );
			}

			if ($hook == 'post-new.php' || $hook == 'post.php') {
				if ('model_store' === $post->post_type) {
					wp_enqueue_media();
					self::enqueue_script( 'ms-upload' );
					self::enqueue_script( 'ms-gallery' );
				}
			}

			if ($hook === 'model_store_page_model-store-settings') {
				self::enqueue_style( 'ms-font-awesome' );
				self::enqueue_style( 'ms-settings' );
			}
		}
	}

	MS_Admin_Backend_Scripts::init();

}
