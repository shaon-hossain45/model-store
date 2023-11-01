<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/public/partials
 */

class Model_Store_Public_Display {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct() {

		$this->public_display_load_dependencies();
		$this->theme_support_includes();
		// Slider base
		if ( class_exists( 'modelBase' ) ) {
			$modelBase = new modelBase();
		}

		$this->dispatch_actions( $modelBase );

		// Slider base
		if ( class_exists( 'searchStore' ) ) {
			$searchStore = new searchStore();
		}
		if ( class_exists( 'loadmoreStore' ) ) {
			$loadmoreStore = new loadmoreStore();
		}

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Public_Popularity_Loader. Orchestrates the hooks of the plugin.
	 * - Public_Popularity_i18n. Defines internationalization functionality.
	 * - Public_Popularity_Admin. Defines all hooks for the admin area.
	 * - Public_Popularity_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function public_display_load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'model/model-base.php';
		require_once plugin_dir_path( __FILE__ ) . 'model/search-model.php';
		require_once plugin_dir_path( __FILE__ ) . 'model/loadmore-model.php';

		/**
		 * Class autoloader.
		 */
		//include_once WC_ABSPATH . 'includes/class-wc-autoloader.php';
	}

	/**
	 * Action dispatch
	 *
	 * @param  [type] $addressbook [description]
	 * @return [type]              [description]
	 */
	private function dispatch_actions( $data ) {
		// Register shortcode
		add_shortcode( 'model_store', array( $data, 'model_store_shortcode' ) );
		add_shortcode( 'model_search', array( $data, 'model_search_shortcode' ) );
		add_shortcode( 'model_slider', array( $data, 'model_slider_shortcode' ) );

		// single page template
		add_filter('single_template', array( $data, 'model_store_template') );
	}



	/**
	 * See if theme/s is activate or not.
	 *
	 * @since 3.3.0
	 * @param string|array $theme Theme name or array of theme names to check.
	 * @return boolean
	 */
	public function ms_is_active_theme( $theme ) {
		return is_array( $theme ) ? in_array( get_template(), $theme, true ) : get_template() === $theme;
	}

	/**
	 * Is the site using a default WP theme?
	 *
	 * @return boolean
	 */
	public function ms_is_wp_default_theme_active() {
		return $this->ms_is_active_theme(
			array(
				'twentytwentythree',
				'twentytwentytwo',
				'twentytwentyone',
				'twentytwenty',
				'twentynineteen',
				'twentyseventeen',
				'twentysixteen',
				'twentyfifteen',
				'twentyfourteen',
				'twentythirteen',
				'twentyeleven',
				'twentytwelve',
				'twentyten',
			)
		);
	}
	/**
	 * Include classes for theme support.
	 *
	 * @since 3.3.0
	 */
	public function theme_support_includes() {
		if ( $this->ms_is_wp_default_theme_active() ) {
			switch ( get_template() ) {
				case 'twentyten':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-ten.php';
					break;
				case 'twentyeleven':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-eleven.php';
					break;
				case 'twentytwelve':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-twelve.php';
					break;
				case 'twentythirteen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-thirteen.php';
					break;
				case 'twentyfourteen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-fourteen.php';
					break;
				case 'twentyfifteen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-fifteen.php';
					break;
				case 'twentysixteen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-sixteen.php';
					break;
				case 'twentyseventeen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-seventeen.php';
					break;
				case 'twentynineteen':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-nineteen.php';
					break;
				case 'twentytwenty':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-twenty.php';
					break;
				case 'twentytwentyone':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-twenty-one.php';
					break;
				case 'twentytwentytwo':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-twenty-two.php';
					break;
				case 'twentytwentythree':
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-twenty-twenty-three.php';
					break;
				default:
					include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-default.php';
					break;
			}
		}else{
			include_once plugin_dir_path(__FILE__) . 'includes/theme-support/class-wc-default.php';
		}
	}

}



/**
 * Autoloader class.
 */
class MS_Autoloader {

	/**
	 * Path to the includes directory.
	 *
	 * @var string
	 */
	private $include_path = '';

	/**
	 * The Constructor.
	 */
	public function __construct() {
		if ( function_exists( '__autoload' ) ) {
			spl_autoload_register( '__autoload' );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( plugin_dir_path( WC_PLUGIN_FILE ) ) . '/includes/';
	}

	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class Class name.
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		return 'class-' . str_replace( '_', '-', $class ) . '.php';
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path File path.
	 * @return bool Successful or not.
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once $path;
			return true;
		}
		return false;
	}

	/**
	 * Auto-load WC classes on demand to reduce memory consumption.
	 *
	 * @param string $class Class name.
	 */
	
	public function autoload( $class ) {
		$class = strtolower( $class );

		if ( 0 !== strpos( $class, 'wc_' ) ) {
			return;
		}

		$file = $this->get_file_name_from_class( $class );
		$path = '';

		if ( 0 === strpos( $class, 'wc_addons_gateway_' ) ) {
			$path = $this->include_path . 'gateways/' . substr( str_replace( '_', '-', $class ), 18 ) . '/';
		} elseif ( 0 === strpos( $class, 'wc_gateway_' ) ) {
			$path = $this->include_path . 'gateways/' . substr( str_replace( '_', '-', $class ), 11 ) . '/';
		} elseif ( 0 === strpos( $class, 'wc_shipping_' ) ) {
			$path = $this->include_path . 'shipping/' . substr( str_replace( '_', '-', $class ), 12 ) . '/';
		} elseif ( 0 === strpos( $class, 'wc_shortcode_' ) ) {
			$path = $this->include_path . 'shortcodes/';
		} elseif ( 0 === strpos( $class, 'wc_meta_box' ) ) {
			$path = $this->include_path . 'admin/meta-boxes/';
		} elseif ( 0 === strpos( $class, 'wc_admin' ) ) {
			$path = $this->include_path . 'admin/';
		} elseif ( 0 === strpos( $class, 'wc_payment_token_' ) ) {
			$path = $this->include_path . 'payment-tokens/';
		} elseif ( 0 === strpos( $class, 'wc_log_handler_' ) ) {
			$path = $this->include_path . 'log-handlers/';
		} elseif ( 0 === strpos( $class, 'wc_integration' ) ) {
			$path = $this->include_path . 'integrations/' . substr( str_replace( '_', '-', $class ), 15 ) . '/';
		} elseif ( 0 === strpos( $class, 'wc_notes_' ) ) {
			$path = $this->include_path . 'admin/notes/';
		}

		if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
			$this->load_file( $this->include_path . $file );
		}
	}
}

//new MS_Autoloader();