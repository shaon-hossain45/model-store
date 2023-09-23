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
				<div class="preloader-container d-none"><span class="preloader"></span></div>
				<div class="owl-carousel">
				<ul class="splide__list">';
				
				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					// Title
					$title = get_the_title();

					// Image
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' is the image size

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

					$output .= '<li class="splide__slide featured-print is-visible is-next">
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
										<ul>
											<li><a href=""><i class="fa-solid fa-download"></i><span>5025</span></a></li>
											<li><a href=""><i class="fa-regular fa-heart"></i></a></li>
											<li><a href=""><i class="fa-solid fa-plus"></i><span>Collect</span></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>';

				endwhile;
				/* Restore original Post Data */
				wp_reset_postdata();
				$output .= '</ul>
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
			</div>
		</div>';

			// Output needs to be return
			return $output;
		}
	}
}
