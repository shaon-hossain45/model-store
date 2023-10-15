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