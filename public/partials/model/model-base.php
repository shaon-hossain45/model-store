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
 * @subpackage Model_Store/public/partials
 */

if ( ! class_exists( 'modelBase' ) ) {
	class modelBase {

		/**
		 * Shortcode public
		 *
		 * @return void
		 */
		public function model_store_shortcode() {

			// Extra Buttons
			$saved_like_feature = get_option('model_store_like_feature');
			$saved_collect_feature = get_option('model_store_collect_feature');
			$saved_model_number = get_option('model_store_number');

			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_like_feature === false) {
				$saved_like_feature = 1; // Set it to 1 (checked) by default
			}
			
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_collect_feature === false) {
				$saved_collect_feature = 1; // Set it to 1 (checked) by default
			}

			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_model_number === false) {
				$saved_model_number = 3; // Set it to 1 (checked) by default
			}

			$output = '';

			$args = array(
				'post_type'   => 'model_store',
				'post_status' => 'publish',
				'order'       => 'DESC',
				'orderby'     => 'ID',
			);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				$output .= '<div class="model-container">
				<div class="model-sidebar">left sidebar</div>
				<div class="model-content model-'.$saved_model_number.'">
				<div class="splide__list">';
				
				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					// Title
					$title = get_the_title();

					// Image
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' is the image size
					// Set a default value for modal_store_enable_feature if it's not set yet
					if ($image_url == '') {
						$image_url = plugin_dir_url( __DIR__ ) . '../images/model-store-placeholder.png'; // Set it to 1 (checked) by default
					}
					$file_url = get_post_meta(get_the_ID(), '_model_store_file_upload_meta_key', true);
					// Categories
					$categories = get_the_category();
					$category_links = array();

					// Categories
					$categories = get_the_terms(get_the_ID(), 'model_cat'); // Change 'category' to your actual taxonomy slug
					$category_links = array();
			
					if ($categories && !is_wp_error($categories)) {
						foreach ($categories as $category) {
							$category_links[] = '<a href="' . esc_url(get_term_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
						}
					}

					// Post URL
					$post_url = get_permalink();

					$output .= '<div class="splide_abc">
					<div class="print-parts">
						<div class="CollectThingWindow">
							<div class="zuO6g"><span class="XIw8C">Select a Collection</span><div class="CollectThingWindow__closeImageWrapper--G75pa"><img class="" src="https://cdn.thingiverse.com/site/assets/inline-icons/03882d0bbea83d99907b.svg" alt="CloseIcon" loading="lazy"></div></div>
							<div class="nps55"><span class="xDAib">or create a new one below:</span><select class="CollectThingWindow__selectWrapper--W2Z4U Select__select--OSD8o Select__arrowWhite--RlOcB"><option value="39665105">Things to Make</option><option value="-1">Create a new Collection</option></select></div>
							<div class="vXPEt"><button class="A1ysH">Save to Collection</button></div>
						</div>
						<div class="print-list-item">
							<div class="print-part1"><a href="' . esc_url($post_url) . '"><img loading="lazy" src="' . esc_url($image_url) . '" alt=""></a></div>
							<div class="print-part2">
								<div class="print-headline"><h3><a class="link" href="' . esc_url($post_url) . '">' . $title . '</a></h3></div>
								<div class="print-taxonomy">
									<div class="model-category">' . implode(' | ', $category_links) . '</div>
									<div class="print-extra">
										<ul>';
											if($file_url){
												$output .= '<li><a href="' . esc_url($file_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											}else{
												$output .= '<li><a href="' . esc_url($image_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											}
											if($saved_like_feature == 1){
												 // Display the modal
												$output .= '<li><a href=""><i class="fa-regular fa-heart"></i></a></li>';
											}
											if($saved_collect_feature == 1){
												$output .= '<li><a href=""><i class="fa-solid fa-plus"></i><span>Collect</span></a></li>';
											}
										$output .= '</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';

				endwhile;
				/* Restore original Post Data */
				wp_reset_postdata();
				$output .= '</div>
				</div>
				</div>';
			} else {
				// no posts found
				$output .= 'No posts found';
			}

			// Output needs to be return
			return $output;
		}

		/**
		 * Shortcode public
		 *
		 * @return void
		 */
		public function model_search_shortcode() {
			// Store Button
			$model_store_button_feature = get_option('model_store_button_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($model_store_button_feature === false) {
				$model_store_button_feature = 1; // Set it to 1 (checked) by default
			}

			$saved_title = get_option('model_store_title');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_title === false) {
				$saved_title = "View All Model Store"; // Set it to 1 (checked) by default
			}
			$get_store_location_url = get_option('model_store_url');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($get_store_location_url === false) {
				$get_store_location_url = home_url("/"); // Set it to 1 (checked) by default
			}
			
			$output = '';

			$output .= '<div class="dashboard-main">
			<div class="dashboard-searchbar">
				<form id="searchForm" class="searchBar-pGWTK" action="'.esc_url(home_url('/')).'" method="POST">
					<div class="searchIcon-MYkVc">
						<input id="search-input" name="model_search" type="text" placeholder="Search Model">
						<span id="close" style="display: none;"><i class="fa-solid fa-xmark"></i></span>
					</div>
					<button type="submit" name="search">Search</button>
				</form>
			</div>';
			if($model_store_button_feature == 1){
				$output .= '<a href="'.$get_store_location_url.'" class="store-btn">'.$saved_title.'</a>';
			}
			$output .= '</div>';

			$output .= '<div class="model-modal"><div class="modal-content"><div class="preloader-container d-none"><span class="preloader"></span></div><span class="close">&times;</span><div class="search-results"></div></div></div>';

			// Output needs to be return
			return $output;
		}

		/**
		 * Shortcode public
		 *
		 * @return void
		 */
		public function model_slider_shortcode() {

			// Extra Buttons
			$saved_like_feature = get_option('model_store_like_feature');
			$saved_collect_feature = get_option('model_store_collect_feature');

			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_like_feature === false) {
				$saved_like_feature = 1; // Set it to 1 (checked) by default
			}
			
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_collect_feature === false) {
				$saved_collect_feature = 1; // Set it to 1 (checked) by default
			}

			// Slider Options
			// Assuming 'slider_speed' is the metabox key
			$model_store_slider_speed = get_option('model_store_slider_speed');
			if ($model_store_slider_speed === false) {
				$model_store_slider_speed = 1500; // Set it to 1500 by default
			}

			$saved_navigation_feature = get_option('model_store_navigation_feature');
			if ($saved_navigation_feature === false) {
				$saved_navigation_feature = 1; // Set it to 1500 by default
			}

			$saved_pagination_feature = get_option('model_store_pagination_feature');
			if ($saved_pagination_feature === false) {
				$saved_pagination_feature = 0; // Set it to 1500 by default
			}

			$saved_autoplay_feature = get_option('model_store_autoplay_feature');
			if ($saved_autoplay_feature === false) {
				$saved_autoplay_feature = 0; // Set it to 1500 by default
			}

			$saved_slider_autoplay_delay = get_option('model_store_slider_autoplay_delay');
			if ($saved_slider_autoplay_delay === false) {
				$saved_slider_autoplay_delay = 1500; // Set it to 1500 by default
			}

			$saved_loop_feature = get_option('model_store_loop_feature');
			if ($saved_loop_feature === false) {
				$saved_loop_feature = 0; // Set it to 1500 by default
			}

			$saved_select_slider_number = get_option('model_store_slider_number');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_slider_number === false) {
				$saved_select_slider_number = 3; // Set it to 3 (checked) by default
			}

			$saved_breakpoint_feature = get_option('model_store_breakpoint_feature');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_breakpoint_feature === false) {
				$saved_breakpoint_feature = 1; // Set it to 1 (checked) by default
			}

			$saved_select_breakpoint_phone = get_option('model_store_breakpoint_phone');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_phone === false) {
				$saved_select_breakpoint_phone = 1; // Set it to 1 (checked) by default
			}

			$saved_select_breakpoint_tablet = get_option('model_store_breakpoint_tablet');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_tablet === false) {
				$saved_select_breakpoint_tablet = 2; // Set it to 2 (checked) by default
			}

			$saved_select_breakpoint_desktop = get_option('model_store_breakpoint_desktop');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_desktop === false) {
				$saved_select_breakpoint_desktop = 3; // Set it to 3 (checked) by default
			}

			$saved_select_breakpoint_largescreen = get_option('model_store_breakpoint_largescreen');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_breakpoint_largescreen === false) {
				$saved_select_breakpoint_largescreen = 4; // Set it to 4 (checked) by default
			}

			$saved_3d_switch_button = get_option('model_store_3d_switch_button');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_3d_switch_button === false) {
				$saved_3d_switch_button = 0; // Set it to 0 (checked) by default
			}

			$saved_space_between = get_option('model_store_space_between');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_space_between === false) {
				$saved_space_between = 15; // Set it to 15 (checked) by default
			}

			$saved_slider_center = get_option('model_store_slider_center');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_slider_center === false) {
				$saved_slider_center = 0; // Set it to 1 (checked) by default
			}
			
			$saved_select_slider_effect = get_option('model_store_slider_effect');
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_select_slider_effect === false) {
				$saved_select_slider_effect = 0; // Set it to 0 (checked) by default
			}
			


			$output = '';

			$args = array(
				'post_type'   => 'model_store',
				'post_status' => 'publish',
				'order'       => 'DESC',
				'orderby' => 'rand',
			);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				$output .= '<div class="model-container">
				<div class="model-content swiper" data-breakpoint="'.$saved_breakpoint_feature.'" data-breakphone="'.$saved_select_breakpoint_phone.'" data-breaktablet="'.$saved_select_breakpoint_tablet.'" data-breakdesktop="'.$saved_select_breakpoint_desktop.'" data-breaklargescreen="'.$saved_select_breakpoint_largescreen.'" data-perview="'.$saved_select_slider_number.'" data-speed="'.$model_store_slider_speed.'" data-navigation="'.$saved_navigation_feature.'" data-pagination="'.$saved_pagination_feature.'" data-autoplay="'.$saved_autoplay_feature.'" data-autoplay-delay="'.$saved_slider_autoplay_delay.'" data-loop="'.$saved_loop_feature.'" data-3d="'.$saved_3d_switch_button.'" data-spacebetween="'.$saved_space_between.'" data-center="'.$saved_slider_center.'" data-effect="'.$saved_select_slider_effect.'">
				<div class="swiper-wrapper">';
				
				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					// Title
					$title = get_the_title();

					// Image
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' is the image size
					// Set a default value for modal_store_enable_feature if it's not set yet
					if ($image_url == '') {
						$image_url = plugin_dir_url( __DIR__ ) . '../images/model-store-placeholder.png'; // Set it to 1 (checked) by default
					}
					$file_url = get_post_meta(get_the_ID(), '_model_store_file_upload_meta_key', true);
					// Categories
					$categories = get_the_category();
					$category_links = array();

					// Categories
					$categories = get_the_terms(get_the_ID(), 'model_cat'); // Change 'category' to your actual taxonomy slug
					$category_links = array();
			
					if ($categories && !is_wp_error($categories)) {
						foreach ($categories as $category) {
							$category_links[] = '<a href="' . esc_url(get_term_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
						}
					}

					// Post URL
					$post_url = get_permalink();

					$output .= '<div class="splide_xyz swiper-slide">
					<div class="print-parts">
						<div class="CollectThingWindow">
							<div class="zuO6g"><span class="XIw8C">Select a Collection</span><div class="CollectThingWindow__closeImageWrapper--G75pa"><img class="" src="https://cdn.thingiverse.com/site/assets/inline-icons/03882d0bbea83d99907b.svg" alt="CloseIcon" loading="lazy"></div></div>
							<div class="nps55"><span class="xDAib">or create a new one below:</span><select class="CollectThingWindow__selectWrapper--W2Z4U Select__select--OSD8o Select__arrowWhite--RlOcB"><option value="39665105">Things to Make</option><option value="-1">Create a new Collection</option></select></div>
							<div class="vXPEt"><button class="A1ysH">Save to Collection</button></div>
						</div>
						<div class="print-list-item">
							<div class="print-part1"><a href="' . esc_url($post_url) . '"><img loading="lazy" src="' . esc_url($image_url) . '" alt=""></a></div>
							<div class="print-part2">
								<div class="print-headline"><h3><a class="link" href="' . esc_url($post_url) . '">' . $title . '</a></h3></div>
								<div class="print-taxonomy">
									<div class="model-category">' . implode(' | ', $category_links) . '</div>
									<div class="print-extra">
										<ul>';
											if($file_url){
												$output .= '<li><a href="' . esc_url($file_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											}else{
												$output .= '<li><a href="' . esc_url($image_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											}
											if($saved_like_feature == 1){
												 // Display the modal
												$output .= '<li><a href=""><i class="fa-regular fa-heart"></i></a></li>';
											}
											if($saved_collect_feature == 1){
												$output .= '<li><a href=""><i class="fa-solid fa-plus"></i><span>Collect</span></a></li>';
											}
										$output .= '</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';

				endwhile;
				/* Restore original Post Data */
				wp_reset_postdata();
				$output .= '</div>';
				if($saved_pagination_feature == 1){
					$output .= '<div class="swiper-pagination"></div>';
				}
				if($saved_navigation_feature == 1){
					$output .= '<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>';
				}
				$output .= '</div>
				</div>';
			} else {
				// no posts found
				$output .= 'No posts found';
			}

			// Output needs to be return
			return $output;
		}

		// Custom post type single page
		// public function model_store_template($single_template) {
		// 	global $post;
		
		// 	if ($post->post_type == 'model_store') {
		// 		$single_template = plugin_dir_url( __FILE__ ) . 'single-model_store.php';
		// 	}
		
		// 	return $single_template;
		// }
	}
}
