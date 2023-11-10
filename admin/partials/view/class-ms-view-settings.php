<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Model_Store
 * @subpackage Model_Store/admin/partials/cpt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'MS_View_Settings', false ) ) {
	return;
}

/**
 * MS_Cpt_Base class.
 */
class MS_View_Settings {

	/**
	 * CPT init.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'submenu_page_settings' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
	}

	/**
	 * Submenu page settings.
	 *
	 * @since 1.0.0
	 */
	public static function submenu_page_settings() {
		add_submenu_page(
			'edit.php?post_type=model_store',
			'Settings',
			'Settings',
			'manage_options',
			'model-store-settings',
			array( __CLASS__, 'render_settings_callback' )
		);
	}

	/**
	 * Render settings callback.
	 *
	 * @since 1.0.0
	 */
	public static function render_settings_callback() {
		// MS tool options.
		$ms_number = get_option( 'ms_number' );
		if ( $ms_number === false ) {
			$ms_number = 3;
		}
		$ms_related_number = get_option( 'ms_related_number' );
		if ( $ms_related_number === false ) {
			$ms_related_number = 4;
		}
		$ms_button = get_option( 'ms_button' );
		if ( $ms_button === false ) {
			$ms_button = 1;
		}
		$ms_button_title = get_option( 'ms_button_title' );
		if ( $ms_button_title === false ) {
			$ms_button_title = 'View All Model Store';
		}
		$ms_button_url = get_option( 'ms_button_url' );
		if ( $ms_button_url === false ) {
			$ms_button_url = home_url( '/model-store/' );
		}

		// MS modal options.
		$ms_alignment = get_option( 'ms_alignment' );
		if ( $ms_alignment === false ) {
			$ms_alignment = 2;
		}
		$ms_collect_template = get_option( 'ms_collect_template' );
		if ( $ms_collect_template === false ) {
			$ms_collect_template = 1;
		}
		$ms_template = get_option( 'ms_template' );
		if ( $ms_template === false ) {
			$ms_template = 1;
		}
		$ms_like_feature = get_option( 'ms_like_feature' );
		if ( $ms_like_feature === false ) {
			$ms_like_feature = 1;
		}
		$ms_collect_feature = get_option( 'ms_collect_feature' );
		if ( $ms_collect_feature === false ) {
			$ms_collect_feature = 1;
		}
		$ms_quickview = get_option( 'ms_quickview' );
		if ( $ms_quickview === false ) {
			$ms_quickview = 1;
		}
		$ms_tooltip = get_option( 'ms_tooltip' );
		if ( $ms_tooltip === false ) {
			$ms_tooltip = 1;
		}

		// MS slider options.
		$ms_breakpoint = get_option( 'ms_breakpoint' );
		if ( $ms_breakpoint === false ) {
			$ms_breakpoint = 1;
		}
		$ms_breakpoint_phone = get_option( 'ms_breakpoint_phone' );
		if ( $ms_breakpoint_phone === false ) {
			$ms_breakpoint_phone = 1;
		}
		$ms_breakpoint_tablet = get_option( 'ms_breakpoint_tablet' );
		if ( $ms_breakpoint_tablet === false ) {
			$ms_breakpoint_tablet = 2;
		}
		$ms_breakpoint_desktop = get_option( 'ms_breakpoint_desktop' );
		if ( $ms_breakpoint_desktop === false ) {
			$ms_breakpoint_desktop = 3;
		}
		$ms_breakpoint_largescreen = get_option( 'ms_breakpoint_largescreen' );
		if ( $ms_breakpoint_largescreen === false ) {
			$ms_breakpoint_largescreen = 4;
		}
		$ms_slider_number = get_option( 'ms_slider_number' );
		if ( $ms_slider_number === false ) {
			$ms_slider_number = 3;
		}
		$ms_slider_speed = get_option( 'ms_slider_speed' );
		if ( $ms_slider_speed === false ) {
			$ms_slider_speed = 1500;
		}
		$ms_navigation = get_option( 'ms_navigation' );
		if ( $ms_navigation === false ) {
			$ms_navigation = 1;
		}
		$ms_pagination = get_option( 'ms_pagination' );
		if ( $ms_pagination === false ) {
			$ms_pagination = 0;
		}
		$ms_autoplay = get_option( 'ms_autoplay' );
		if ( $ms_autoplay === false ) {
			$ms_autoplay = 0;
		}
		$ms_slider_autoplay_delay = get_option( 'ms_slider_autoplay_delay' );
		if ( $ms_slider_autoplay_delay === false ) {
			$ms_slider_autoplay_delay = 1500;
		}
		$ms_slider_loop = get_option( 'ms_slider_loop' );
		if ( $ms_slider_loop === false ) {
			$ms_slider_loop = 0;
		}
		$ms_space_between = get_option( 'ms_space_between' );
		if ( $ms_space_between === false ) {
			$ms_space_between = 15;
		}
		$ms_slider_center = get_option( 'ms_slider_center' );
		if ( $ms_slider_center === false ) {
			$ms_slider_center = 0;
		}
		$ms_slider_effect = get_option( 'ms_slider_effect' );
		if ( $ms_slider_effect === false ) {
			$ms_slider_effect = 0;
		}
		$ms_3d_switch = get_option( 'ms_3d_switch' );
		if ( $ms_3d_switch === false ) {
			$ms_3d_switch = 0;
		}

		// Check if the settings have been saved and display a success notice
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) {
			add_settings_error( 'ms_settings_messages', 'settings_saved', __( 'Settings saved.', 'model-store' ), 'updated' );
		}

		echo '<div class="wrap">
			<div class="px30 pt50">
				<h1>Model Store Settings</h1>';

				// Display any settings error messages.
				settings_errors( 'ms_settings_messages' );
			echo '</div>';
			echo '<div class="template__wrapper background__greyBg px30 py50">
				<div class="eael-container">
					<div class="eael-main__tab mb45">
						<ul class="ls-none tab__menu" id="tabMenu">
							<li class="tab__list active"><a class="tab__item" href="#general"><i class="fa-solid fa-gear"></i>General</a></li>
							<li class="tab__list"><a class="tab__item" href="#elements"><i class="fa-solid fa-screwdriver-wrench"></i>Elements</a></li>
							<li class="tab__list"><a class="tab__item" href="#tool"><i class="fa-solid fa-screwdriver-wrench"></i>Tool</a></li>
							<li class="tab__list"><a class="tab__item" href="#modal"><i class="fa-solid fa-screwdriver-wrench"></i>Modal</a></li>
							<li class="tab__list"><a class="tab__item" href="#slider"><i class="fa-solid fa-screwdriver-wrench"></i>Slider</a></li>
						</ul>
					</div>
					<div class="eael-admin-setting-tabs">
						<div id="general" class="eael-admin-setting-tab active">0</div>
						<div id="elements" class="eael-admin-setting-tab">00</div>
						<div id="tool" class="eael-admin-setting-tab">
							<h3>Tool options</h3>
							<form method="post" action="options.php">';
								settings_fields( 'ms_settings_tool_group' );
								// Start settings field parts with table.
								echo '<table class="form-table" role="presentation">
									<tbody>
										<tr>
											<th scope="row"><label for="ms_number">Model Store Number</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Model Store Number</span></legend>
													<select id="ms_number" name="ms_number">
														<option value="1" ' . selected( $ms_number, 1, false ) . '>1</option>
														<option value="2" ' . selected( $ms_number, 2, false ) . '>2</option>
														<option value="3" ' . selected( $ms_number, 3, false ) . '>3</option>
														<option value="4" ' . selected( $ms_number, 4, false ) . '>4</option>
														<option value="5" ' . selected( $ms_number, 5, false ) . '>5</option>
													</select>
												<fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_related_number">Model Related Number</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Model Related Number</span></legend>
													<select id="ms_related_number" name="ms_related_number">
														<option value="3" ' . selected( $ms_related_number, 3, false ) . '>3</option>
														<option value="4" ' . selected( $ms_related_number, 4, false ) . '>4</option>
														<option value="5" ' . selected( $ms_related_number, 5, false ) . '>5</option>
													</select>
												<fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_button">Store Button</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Button</span></legend>
													<label for="ms_button"><input type="checkbox" id="ms_button" name="ms_button" data-onload="' . esc_js( 'storeTitle' ) . ',' . esc_js( 'storeUrl' ) . '" onchange="fieldVisibility(event, \'' . esc_js( 'storeTitle' ) . '\', \'' . esc_js( 'storeUrl' ) . '\')" value="1" ' . checked( $ms_button, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr data-hidden="storeTitle" style="display: none;">
											<th scope="row"><label for="ms_button_title">Title:</label></th>
											<td><input type="text" id="ms_button_title" name="ms_button_title" value="' . esc_attr( $ms_button_title ) . '" placeholder="Model Store" class="regular-text" /></td>
										</tr>
										<tr data-hidden="storeUrl" style="display: none;">
											<th scope="row"><label for="ms_button_url">Location:</label></th>
											<td><input type="url" id="ms_button_url" name="ms_button_url" value="' . esc_attr( $ms_button_url ) . '" placeholder="https://example.com/model-store/" class="regular-text" /></td>
										</tr>
									</tbody>
								</table>';
								// End settings field parts with table.
								submit_button( 'Save Settings' );
							echo '</form>
						</div>
						<div id="modal" class="eael-admin-setting-tab">
							<h3>Modal options</h3>
							<form method="post" action="options.php">';
								settings_fields( 'ms_settings_modal_group' );
								// Start settings field parts with table.
								echo '<table class="form-table" role="presentation">
									<tbody>
										<tr>
											<th scope="row"><label>Modal Position</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Modal Position</span></legend>
													<div class="model-alignment">
														<div class="model-part">
															<input type="radio" id="ms_alignment1" name="ms_alignment" value="1" ' . checked( $ms_alignment, 1, false ) . '>
															<label for="ms_alignment1">Left</label>
														</div>
														<div class="model-part">
															<input type="radio" id="ms_alignment2" name="ms_alignment" value="2" ' . checked( $ms_alignment, 2, false ) . '>
															<label for="ms_alignment2">Center</label>
														</div>
														<div class="model-part">
															<input type="radio" id="ms_alignment3" name="ms_alignment" value="3" ' . checked( $ms_alignment, 3, false ) . '>
															<label for="ms_alignment3">Right</label>
														</div>
													</div>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_template">Model Template</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Model Template</span></legend>
													<select id="ms_template" name="ms_template">
														<option value="1" ' . selected( $ms_template, 1, false ) . '>Template 1</option>
														<option value="2" ' . selected( $ms_template, 2, false ) . '>Template 2</option>
														<option value="3" ' . selected( $ms_template, 3, false ) . '>Template 3</option>
													</select>
												<fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_like_feature">Like Button</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Like Button</span></legend>
													<label for="ms_like_feature"><input type="checkbox" id="ms_like_feature" name="ms_like_feature" value="1" ' . checked( $ms_like_feature, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_collect_feature">Collect Button</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Collect Button</span></legend>
													<label for="ms_collect_feature"><input type="checkbox" id="ms_collect_feature" name="ms_collect_feature" data-onload="' . esc_js( 'storeCollection' ) . '" onchange="fieldVisibility(event, \'' . esc_js( 'storeCollection' ) . '\')" value="1" ' . checked( $ms_collect_feature, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr data-hidden="storeCollection" style="display: none;">
											<th scope="row"><label for="ms_collect_template">Model Collection</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Model Collection</span></legend>
													<select id="ms_collect_template" name="ms_collect_template">
														<option value="1" ' . selected( $ms_collect_template, 1, false ) . '>Basic</option>
														<option value="2" ' . selected( $ms_collect_template, 2, false ) . '>Modal</option>
													</select>
												<fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_quickview">Quick View</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Quick View</span></legend>
													<label for="ms_quickview"><input type="checkbox" id="ms_quickview" name="ms_quickview" value="1" ' . checked( $ms_quickview, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_tooltip">Tooltip</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Tooltip</span></legend>
													<label for="ms_tooltip"><input type="checkbox" id="ms_tooltip" name="ms_tooltip" value="1" ' . checked( $ms_tooltip, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
									</tbody>
								</table>';
								// End settings field parts with table.
								submit_button( 'Save Settings' );
							echo '</form>
						</div>
						<div id="slider" class="eael-admin-setting-tab">
							<h3>Slider options</h3>
							<form method="post" action="options.php">';
								settings_fields( 'ms_settings_slider_group' );
								// Start settings field parts with table.
								echo '<table class="form-table" role="presentation">
									<tbody>
										<tr>
											<th scope="row"><label for="ms_breakpoint">Slider Breakpoint</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Breakpoint</span></legend>
													<label for="ms_breakpoint"><input type="checkbox" id="ms_breakpoint" name="ms_breakpoint" data-onload="' . esc_js( 'storeBreakpoint' ) . '" onchange="fieldVisibility(event, \'' . esc_js( 'storeBreakpoint' ) . '\')" value="1" ' . checked( $ms_breakpoint, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr data-hidden="storeBreakpoint" style="display: none;">
											<th scope="row"></th>
											<td>
												<div class="model-alignment">
													<div class="breakpoint-part">
														<label for="ms_breakpoint_phone">Phone</label>
														<br />
														<select id="ms_breakpoint_phone" name="ms_breakpoint_phone">
															<option value="1" ' . selected( $ms_breakpoint_phone, 1, false ) . '>1</option>
															<option value="2" ' . selected( $ms_breakpoint_phone, 2, false ) . '>2</option>
															<option value="3" ' . selected( $ms_breakpoint_phone, 3, false ) . '>3</option>
															<option value="4" ' . selected( $ms_breakpoint_phone, 4, false ) . '>4</option>
															<option value="5" ' . selected( $ms_breakpoint_phone, 5, false ) . '>5</option>
														</select>
													</div>
													<div class="breakpoint-part">
														<label for="ms_breakpoint_tablet">Tablet</label>
														<br />
														<select id="ms_breakpoint_tablet" name="ms_breakpoint_tablet">
															<option value="1" ' . selected( $ms_breakpoint_tablet, 1, false ) . '>1</option>
															<option value="2" ' . selected( $ms_breakpoint_tablet, 2, false ) . '>2</option>
															<option value="3" ' . selected( $ms_breakpoint_tablet, 3, false ) . '>3</option>
															<option value="4" ' . selected( $ms_breakpoint_tablet, 4, false ) . '>4</option>
															<option value="5" ' . selected( $ms_breakpoint_tablet, 5, false ) . '>5</option>
														</select>
													</div>
													<div class="breakpoint-part">
														<label for="ms_breakpoint_desktop">Desktop</label>
														<br />
														<select id="ms_breakpoint_desktop" name="ms_breakpoint_desktop">
															<option value="1" ' . selected( $ms_breakpoint_desktop, 1, false ) . '>1</option>
															<option value="2" ' . selected( $ms_breakpoint_desktop, 2, false ) . '>2</option>
															<option value="3" ' . selected( $ms_breakpoint_desktop, 3, false ) . '>3</option>
															<option value="4" ' . selected( $ms_breakpoint_desktop, 4, false ) . '>4</option>
															<option value="5" ' . selected( $ms_breakpoint_desktop, 5, false ) . '>5</option>
														</select>
													</div>
													<div class="breakpoint-part">
														<label for="ms_breakpoint_largescreen">Large Screen</label>
														<br />
														<select id="ms_breakpoint_largescreen" name="ms_breakpoint_largescreen">
															<option value="1" ' . selected( $ms_breakpoint_largescreen, 1, false ) . '>1</option>
															<option value="2" ' . selected( $ms_breakpoint_largescreen, 2, false ) . '>2</option>
															<option value="3" ' . selected( $ms_breakpoint_largescreen, 3, false ) . '>3</option>
															<option value="4" ' . selected( $ms_breakpoint_largescreen, 4, false ) . '>4</option>
															<option value="5" ' . selected( $ms_breakpoint_largescreen, 5, false ) . '>5</option>
														</select>
													</div>
												</div>
											</td>
										</tr>
										<tr data-preview="storeBreakpoint" style="display: none;">
											<th scope="row"><label for="ms_slider_number">Slider Number</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Number</span></legend>
													<select id="ms_slider_number" name="ms_slider_number">
														<option value="1" ' . selected( $ms_slider_number, 1, false ) . '>1</option>
														<option value="2" ' . selected( $ms_slider_number, 2, false ) . '>2</option>
														<option value="3" ' . selected( $ms_slider_number, 3, false ) . '>3</option>
														<option value="4" ' . selected( $ms_slider_number, 4, false ) . '>4</option>
														<option value="5" ' . selected( $ms_slider_number, 5, false ) . '>5</option>
													</select>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_slider_speed">Slider Speed:</label></th>
											<td><input type="number" id="ms_slider_speed" name="ms_slider_speed" value="' . esc_attr( $ms_slider_speed ) . '" placeholder="1500" class="regular-text" /></td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_navigation">Slider Navigation</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Navigation</span></legend>
													<label for="ms_navigation"><input type="checkbox" id="ms_navigation" name="ms_navigation" value="1" ' . checked( $ms_navigation, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_pagination">Slider Pagination</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Pagination</span></legend>
													<label for="ms_pagination"><input type="checkbox" id="ms_pagination" name="ms_pagination" value="1" ' . checked( $ms_pagination, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_autoplay">Slider Autoplay</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Autoplay</span></legend>
													<label for="ms_autoplay"><input type="checkbox" id="ms_autoplay" name="ms_autoplay" data-onload="' . esc_js( 'autoplayDelay' ) . '" onchange="fieldVisibility(event, \'' . esc_js( 'autoplayDelay' ) . '\')" value="1" ' . checked( $ms_autoplay, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr data-hidden="autoplayDelay" style="display: none;">
											<th scope="row"><label for="ms_slider_autoplay_delay">Slider Autoplay Delay:</label></th>
											<td><input type="number" id="ms_slider_autoplay_delay" name="ms_slider_autoplay_delay" value="' . esc_attr( $ms_slider_autoplay_delay ) . '" placeholder="1500" class="regular-text" /></td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_slider_loop">Slider Loop</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Loop</span></legend>
													<label for="ms_slider_loop"><input type="checkbox" id="ms_slider_loop" name="ms_slider_loop" value="1" ' . checked( $ms_slider_loop, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_space_between">Slider Spacing:</label></th>
											<td><input type="number" id="ms_space_between" name="ms_space_between" value="' . esc_attr( $ms_space_between ) . '" placeholder="10" class="regular-text" /></td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_slider_center">Slider Center</label></th>
											<td>
												<fieldset>
														<legend class="screen-reader-text"><span>Slider Center</span></legend>
														<label for="ms_slider_center"><input type="checkbox" id="ms_slider_center" name="ms_slider_center" value="1" ' . checked( $ms_slider_center, 1, false ) . ' />Enable Feature</label>
												</fieldset>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="ms_slider_effect">Slider Effect</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>Slider Effect</span></legend>
													<select id="ms_slider_effect" name="ms_slider_effect" data-onload="' . esc_js( 'effect' ) . '" onchange="fieldVisibilitySelect(event,  \'' . esc_js( 'effect' ) . '\')">
														<option value="0" ' . selected( $ms_slider_effect, 0, false ) . '>Slider</option>
														<option value="1" ' . selected( $ms_slider_effect, 1, false ) . '>Coverflow</option>
													</select>
												</fieldset>
											</td>
										</tr>
										<tr data-select="effect" data-value="1" style="display: none;">
											<th scope="row"><label for="ms_3d_switch">3D Slider</label></th>
											<td>
												<fieldset>
													<legend class="screen-reader-text"><span>3D Slider</span></legend>
													<div class="model-switchbox">
														<div class="model-switchpart">
															<input type="checkbox" id="ms_3d_switch" name="ms_3d_switch" value="1" ' . checked( $ms_3d_switch, 1, false ) . '>
															<label for="ms_3d_switch">
																<span class="switch-on">On</span>
																<span class="switch-off">Off</span>
																<span class="switch-ball"></span>
															</label>
														</div>
														<span>Enable Feature</span>
													</div>
												</fieldset>
											</td>
										</tr>
									</tbody>
								</table>';
								// End settings field parts with table.
								submit_button( 'Save Settings' );
							echo '</form>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}

	/**
	 * Register settings.
	 * 
	 * @since 1.0.0
	 */
	public static function register_settings() {
		// MS tool options.
		register_setting( 'ms_settings_tool_group', 'ms_number', 'absint' );
		register_setting( 'ms_settings_tool_group', 'ms_related_number', 'absint' );
		register_setting( 'ms_settings_tool_group', 'ms_button', 'absint' );
		register_setting( 'ms_settings_tool_group', 'ms_button_title', 'sanitize_text_field' );
		register_setting( 'ms_settings_tool_group', 'ms_button_url', 'esc_url_raw' );

		// MS modal options.
		register_setting( 'ms_settings_modal_group', 'ms_like_feature', 'absint' );
		register_setting( 'ms_settings_modal_group', 'ms_collect_feature', 'absint' );
		register_setting( 'ms_settings_modal_group', 'ms_collect_template', 'absint' );
		register_setting( 'ms_settings_modal_group', 'ms_alignment', 'absint' );
		register_setting( 'ms_settings_modal_group', 'ms_template', 'absint' );

		// MS slider options.
		register_setting( 'ms_settings_slider_group', 'ms_slider_speed', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_navigation', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_pagination', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_autoplay', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_slider_autoplay_delay', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_slider_loop', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_slider_number', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_breakpoint', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_breakpoint_phone', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_breakpoint_tablet', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_breakpoint_desktop', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_breakpoint_largescreen', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_3d_switch', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_space_between', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_slider_center', 'absint' );
		register_setting( 'ms_settings_slider_group', 'ms_slider_effect', 'absint' );
	}
}
