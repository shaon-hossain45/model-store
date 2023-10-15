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
class Model_Store_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->admin_load_dependencies();
		if ( class_exists( 'Model_Store_Admin_Display' ) ) {
			new Model_Store_Admin_Display();
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
	private function admin_load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/model-store-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

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
		
		if ($hook === 'model_store_page_model-store-settings') {
			wp_enqueue_style('model-store-settings-css', plugin_dir_url( __FILE__ ) . 'css/model-settings.css', array(), null, 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

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
		
		if ($hook === 'model_store_page_model-store-settings') {
			wp_enqueue_script( 'model-store-settings-js', plugin_dir_url( __FILE__ ) . 'js/model-settings.js', array( 'jquery' ), null, true );
		}

		// Meta Box - Enqueue Scripts and Styles
		global $post;
		if ($hook == 'post-new.php' || $hook == 'post.php') {
			if ('model_store' === $post->post_type) {
				wp_enqueue_media();
				wp_enqueue_script('model-store-upload-script', plugin_dir_url( __FILE__ ) . 'js/model-file-upload.js', array('jquery'), null, true);
				
				// Include JavaScript to handle image uploads and updating the meta field
				wp_enqueue_script('gallery-meta-box-script', plugin_dir_url( __FILE__ ) . 'js/gallery-meta-box.js', array('jquery'), null, true);
			}
		}
	}

}
