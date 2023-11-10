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

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Model_Store
 * @subpackage Model_Store/admin
 * @author     Shaon Hossain <shaonhossain615@gmail.com>
 */
class MS_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param  string $plugin_name The name of this plugin.
	 * @param  string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->admin_load_dependencies();
		$this->backend_includes();

		// Autoloader init.
		MS_View_Base::init();
		MS_View_Settings::init();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Model_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Model_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/model-store-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Model_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Model_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/model-store-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Include required frontend files.
	 */
	public function backend_includes() {
		include_once MS_ABSPATH . 'admin/class-ms-admin-backend-scripts.php';
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function admin_load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/partials/class-ms-admin-autoloader.php';
	}

	/**
	 * This function is provided for Plugin row extra actions.
	 *
	 * @param array  $actions Plugin row actions.
	 * @param string $plugin_file Plugin file.
	 * @return array
	 * @since 1.0.0
	 */
	public function plugin_row_actions( $actions, $plugin_file ) {

		if ( is_plugin_active( $plugin_file ) && basename( dirname( plugin_dir_path( __FILE__ ) ) ) . '/model-store.php' === $plugin_file ) {
			$settings_page_url = admin_url( 'edit.php?post_type=model_store&page=model-store-settings' );
			$support_url       = 'https://www.modelstore.com/support/';

			// Plugin row actions for active plugins.
			$actions['settings'] = '<a href="' . esc_url( $settings_page_url ) . '">' . esc_html__( 'Settings', 'model-store' ) . '</a>';
			$actions['support']  = '<a href="' . esc_url( $support_url ) . '">' . esc_html__( 'Support', 'model-store' ) . '</a>';
			$actions['premium']  = '<a href="' . admin_url( 'admin.php?page=mslevel-woosw&tab=premium' ) . '" style="color: #c9356e; font-weight: 700;">' . esc_html__( 'Premium Version', 'model-store' ) . '</a>';
		}
		return $actions;
	}
}
