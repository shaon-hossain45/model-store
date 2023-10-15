<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Model_Store
 * @subpackage Model_Store/includes
 * @author     Shaon Hossain <shaonhossain615@gmail.com>
 */
class Model_Store {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Model_Store_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MODEL_STORE_VERSION' ) ) {
			$this->version = MODEL_STORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'model-store';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		// plugin row action
		add_filter('plugin_action_links', array( $this, 'add_custom_row_actions' ), 10, 4);


	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Model_Store_Loader. Orchestrates the hooks of the plugin.
	 * - Model_Store_i18n. Defines internationalization functionality.
	 * - Model_Store_Admin. Defines all hooks for the admin area.
	 * - Model_Store_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-model-store-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-model-store-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-model-store-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-model-store-public.php';

		$this->loader = new Model_Store_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Model_Store_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Model_Store_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Model_Store_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Model_Store_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Model_Store_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	
	// Plugin row actions
	public function add_custom_row_actions($actions, $plugin_file, $plugin_data, $context) {
		if ( is_plugin_active($plugin_file) && basename( dirname(plugin_dir_path( __FILE__ )) ) . '/model-store.php' === $plugin_file ) {
			// Add your custom row actions for active plugins
			$settings_page_url = admin_url('edit.php?post_type=model_store&page=model-store-settings');
			$support_url = "https://www.modelstore.com/support/";

			$actions['settings'] = '<a href="' . esc_url($settings_page_url) . '">Settings</a>';
			$actions['support'] = '<a href="' . esc_url($support_url) . '">Support</a>';
		}
		return $actions;
	}


/**
 * Get template part (for templates like the shop-loop).
 *
 * WC_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
// function ms_get_template_part( $slug, $name = '' ) {
// 	$cache_key = sanitize_key( implode( '-', array( 'template-part', $slug, $name, Constants::get_constant( 'WC_VERSION' ) ) ) );
// 	$template  = (string) wp_cache_get( $cache_key, 'woocommerce' );

// 	if ( ! $template ) {
// 		if ( $name ) {
// 			$template = WC_TEMPLATE_DEBUG_MODE ? '' : locate_template(
// 				array(
// 					"{$slug}-{$name}.php",
// 					WC()->template_path() . "{$slug}-{$name}.php",
// 				)
// 			);

// 			if ( ! $template ) {
// 				$fallback = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
// 				$template = file_exists( $fallback ) ? $fallback : '';
// 			}
// 		}

// 		if ( ! $template ) {
// 			// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php.
// 			$template = WC_TEMPLATE_DEBUG_MODE ? '' : locate_template(
// 				array(
// 					"{$slug}.php",
// 					WC()->template_path() . "{$slug}.php",
// 				)
// 			);
// 		}

// 		// Don't cache the absolute path so that it can be shared between web servers with different paths.
// 		$cache_path = wc_tokenize_path( $template, wc_get_path_define_tokens() );

// 		wc_set_template_cache( $cache_key, $cache_path );
// 	} else {
// 		// Make sure that the absolute path to the template is resolved.
// 		$template = wc_untokenize_path( $template, wc_get_path_define_tokens() );
// 	}

// 	// Allow 3rd party plugins to filter template file from their plugin.
// 	$template = apply_filters( 'wc_get_template_part', $template, $slug, $name );

// 	if ( $template ) {
// 		load_template( $template, false );
// 	}
// }












	/**
	 * Init the package loader.
	 *
	 * @since 3.7.0
	 */
	// public static function init() {
	// 	add_action( 'plugins_loaded', array( __CLASS__, 'on_init' ) );
	// }

	/**
	 * Callback for WordPress init hook.
	 */
	// public static function on_init() {
	// 	self::load_packages();
	// }

	/**
	 * Checks a package exists by looking for it's directory.
	 *
	 * @param string $package Package name.
	 * @return boolean
	 */
	// public static function package_exists( $package ) {
	// 	return file_exists( dirname( __DIR__ ) . '/packages/' . $package );
	// }

	/**
	 * Loads packages after plugins_loaded hook.
	 *
	 * Each package should include an init file which loads the package so it can be used by core.
	 */
	// protected static function load_packages() {
	// 	// Initialize WooCommerce Admin.
	// 	\Automattic\WooCommerce\Admin\Composer\Package::init();

	// 	foreach ( self::$packages as $package_name => $package_class ) {
	// 		if ( ! self::package_exists( $package_name ) ) {
	// 			self::missing_package( $package_name );
	// 			continue;
	// 		}
	// 		call_user_func( array( $package_class, 'init' ) );
	// 	}
	// }

	// if ( ! function_exists( 'woocommerce_output_auth_header' ) ) {

	// 	/**
	// 	 * Output the Auth header.
	// 	 */
	// 	function woocommerce_output_auth_header() {
	// 		wc_get_template( 'auth/header.php' );
	// 	}
	// }
	
	// if ( ! function_exists( 'woocommerce_output_auth_footer' ) ) {
	
	// 	/**
	// 	 * Output the Auth footer.
	// 	 */
	// 	function woocommerce_output_auth_footer() {
	// 		wc_get_template( 'auth/footer.php' );
	// 	}
	// }


}

// Plugin get template
function ms_get_template( $slug, $name = '' ) {
	$templates = array();

	if ($name) {
		$templates[] = "template-parts/{$slug}-{$name}.php";
	}

	$templates[] = "template-parts/{$slug}.php";

	$template = locate_template($templates, false, false);

	if ($template) {
		load_template($template, false);
	}

}