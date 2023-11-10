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
 * @subpackage Model_Store/public/partials/view
 */

if ( class_exists( 'MS_View_Store', false ) ) {
	return;
}

/**
 * MS_View_Store class
 */
class MS_View_Store {

	/**
	 * CPT init.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		// Register shortcode.
		add_shortcode( 'model_store', array( __CLASS__, 'ms_shortcode' ) );
	}

	/**
	 * Shortcode public
	 *
	 * @since 1.0.0
	 */
	public static function ms_shortcode() {

		// Extra Buttonsms_template
		$ms_like_feature     = get_option( 'ms_like_feature' );
		$ms_collect_feature  = get_option( 'ms_collect_feature' );
		$ms_collect_template = get_option( 'ms_collect_template' );
		$ms_number           = get_option( 'ms_number' );
		$ms_button_url       = get_option( 'ms_button_url' );

		$ms_template = get_option( 'ms_template' );

		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $ms_like_feature === false ) {
			$ms_like_feature = 1; // Set it to 1 (checked) by default
		}

		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $ms_collect_feature === false ) {
			$ms_collect_feature = 1; // Set it to 1 (checked) by default
		}

		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $ms_collect_template === false ) {
			$ms_collect_template = 1; // Set it to 0 (checked) by default
		}

		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $ms_number === false ) {
			$ms_number = 3; // Set it to 1 (checked) by default
		}
		// Set a default value for modal_store_enable_feature if it's not set yet
		if ( $ms_button_url === false ) {
			$ms_button_url = home_url( '/model-store/' ); // Set it to 1 (checked) by default
		}

		// Assuming you're on an archive page or similar where "model_store" custom post type is displayed
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // Get the current page

		$Nextpaged = $paged + 1;

		$output = '';

		$args = array(
			'post_type'      => 'model_store',
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'ID',
			'posts_per_page' => 3,
			'paged'          => $paged,
		);

		// Custom post type slug
		$post_type      = 'model_store';
		$posts_per_page = 3;

		global $wpdb;
		// SQL query to count the posts
		$pageQuery = $wpdb->prepare( "SELECT COUNT(ID) FROM {$wpdb->posts} WHERE post_type = %s AND post_status = 'publish'", $post_type );

		// Get the count
		$total_posts = $wpdb->get_var( $pageQuery );

		// Calculate the last page number
		$last_page = ceil( $total_posts / $posts_per_page );

		// The Query
		$the_query = new WP_Query( $args );

		$count = $the_query->post_count;

		// The Loop
		if ( $the_query->have_posts() ) {
			if ( ( $ms_collect_feature == 1 ) && ( $ms_collect_template == 2 ) ) {
				$output .= '<div class="modal fade show">
						<div role="document" class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content">
								<div>
									<div class="modal-header"><h2>Add to new collection</h2></div>
									
									<div class="modal-body">
										<form novalidate="" class="ng-pristine ng-invalid ng-touched">
											<div _ngcontent-prusa-front-app-c130="" class="form-group choose-name field-error">
												<label for="createCollectionName">Choose name</label>
												<input formcontrolname="name" type="text" id="createCollectionName" class="form-control ng-pristine ng-invalid ng-touched" placeholder="Name your new collection">
												<div _ngcontent-prusa-front-app-c129="" class="validation-error-message">This field is required</div>
											</div>
											<div _ngcontent-prusa-front-app-c130="" class="form-group mb-0">
												<label _ngcontent-prusa-front-app-c130="">Select visibility of this collection</label>
												<div class="radio-option">
													<custom-radio>
														<label _ngcontent-prusa-front-app-c127="" class="wrapper">
														<input _ngcontent-prusa-front-app-c130="" type="radio" id="collection-radio-1" class="ng-untouched ng-pristine ng-valid"><span _ngcontent-prusa-front-app-c127="" class="checkmark"></span></label>
													</custom-radio>
													<label _ngcontent-prusa-front-app-c130="" for="collection-radio-1 mb-0">Public</label>
													<p _ngcontent-prusa-front-app-c130="" class="option-description">anyone can browse it on your profile</p>
												</div>
												<div class="radio-option">
													<custom-radio>
														<label _ngcontent-prusa-front-app-c127="" class="wrapper"><input _ngcontent-prusa-front-app-c130="" type="radio" id="collection-radio-2" class="ng-untouched ng-pristine ng-valid"><span _ngcontent-prusa-front-app-c127="" class="checkmark"></span></label>
													</custom-radio>
													<label _ngcontent-prusa-front-app-c130="" for="collection-radio-2 mb-0">Private</label>
													<p _ngcontent-prusa-front-app-c130="" class="option-description mb-0">no one sees it</p>
												</div>

											</div>

											<div class="d-flex justify-content-center mt-5">
												<button _ngcontent-prusa-front-app-c130="" type="submit" class="btn btn-large btn-primary">Create (and add to) collection</button>
											</div>
											<div class="text-center mt-20px"><span class="cancel-anchor">Cancel and close</span></div>
										</form>
									</div>

								</div>
							</div>
						</div>
					</div>';
			}
			$output .= '<div class="model-container">
				<div class="model-sidebar">left sidebar</div>
				<div class="model-content model-' . $ms_number . ' styler-' . $ms_template . '">
				<div class="razzi-posts__found">
					<div class="razzi-posts__found-inner">Showing<span class="current-post"> ' . $count . ' </span> of <span class="found-post"> ' . $total_posts . ' </span> products</div>
				</div>
				<div class="splide__list shopmodel">';

			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				// Title
				$title = get_the_title();

				// Image
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); // 'full' is the image size
				// Set a default value for modal_store_enable_feature if it's not set yet
				if ( $image_url == '' ) {
					$image_url = MS_ABSPATH . '/public/images/model-store-placeholder.png'; // Set it to 1 (checked) by default
				}
				$file_url = get_post_meta( get_the_ID(), '_model_store_file_upload_meta_key', true );
				// Categories
				$categories     = get_the_category();
				$category_links = array();

				// Categories
				$categories     = get_the_terms( get_the_ID(), 'model_cat' ); // Change 'category' to your actual taxonomy slug
				$category_links = array();

				if ( $categories && ! is_wp_error( $categories ) ) {
					foreach ( $categories as $category ) {
						$category_links[] = '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
					}
				}

				// Post URL
				$post_url = get_permalink();

				$output .= '<div class="splide_abc">
					<div class="print-parts">';
				if ( ( $ms_collect_feature == 1 ) && ( $ms_collect_template == 1 ) ) {
					$output .= '<div class="CollectThingWindow">
							<div class="zuO6g"><span class="XIw8C">Select a Collection</span><div class="G75pa"><img class="" src="https://cdn.thingiverse.com/site/assets/inline-icons/03882d0bbea83d99907b.svg" alt="CloseIcon" loading="lazy"></div></div>
							<div class="nps55"><span class="xDAib">or create a new one below:</span><select class="W2Z4U Select__select--OSD8o Select__arrowWhite--RlOcB"><option value="39665105">Things to Make</option><option value="-1">Create a new Collection</option></select></div>
							<div class="vXPEt"><button class="A1ysH">Save to Collection</button></div>
						</div>';
				}
				$output .= '<div class="print-list-item">
							<div class="print-part1"><a href="' . esc_url( $post_url ) . '"><img loading="lazy" src="' . esc_url( $image_url ) . '" alt=""></a></div>
							<div class="print-part2">';
				if ( $ms_template == 3 ) {
					$output .= '<div class="print-taxonomy">
									<div class="model-category">' . implode( ' | ', $category_links ) . '</div>
									</div>';
				}
							$output .= '<div class="print-headline"><h3><a class="link" href="' . esc_url( $post_url ) . '">' . $title . '</a></h3></div>';
				if ( ( $ms_template == 1 ) || ( $ms_template == 2 ) ) {
					$output .= '<div class="print-taxonomy">
									<div class="model-category">' . implode( ' | ', $category_links ) . '</div>';
					$output .= '<div class="print-extra">
										<ul>';
							// if($file_url){
							// $output .= '<li><a href="' . esc_url($file_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
							// }else{
							// $output .= '<li><a href="' . esc_url($image_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
							// }
							$output .= '<li><a href="" data-toggle="tooltip" data-placement="left" data-text="Quick View"><i class="fa-regular fa-eye"></i></a></li>';
					if ( $ms_like_feature == 1 ) {
							// Display the modal
							$output .= '<li><a href="" data-toggle="tooltip" data-placement="left" data-text="Wishlist"><i class="fa-regular fa-heart"></i></a></li>';
					}
					if ( $ms_collect_feature == 1 ) {
									$output .= '<li><a href="" class="collect" data-toggle="tooltip" data-placement="left" data-text="Collect"><i class="fa-solid fa-plus"></i></a></li>';
					}
											$output .= '</ul>
									</div>
								</div>';
				}
						$output .= '</div>';
				if ( $ms_template == 3 ) {
					$output .= '<div class="print-extra">
									<ul>';
							// if($file_url){
							// $output .= '<li><a href="' . esc_url($file_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
							// }else{
							// $output .= '<li><a href="' . esc_url($image_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
							// }
							$output .= '<li><a href="" data-toggle="tooltip" data-placement="left" data-text="Quick View"><i class="fa-regular fa-eye"></i></a></li>';
					if ( $ms_like_feature == 1 ) {
						// Display the modal
						$output .= '<li><a href="" data-toggle="tooltip" data-placement="left" data-text="Quick View"><i class="fa-regular fa-heart"></i></a></li>';
					}
					if ( $ms_collect_feature == 1 ) {
						$output .= '<li><a href="" class="collect" data-toggle="tooltip" data-placement="left" data-text="Quick View"><i class="fa-solid fa-plus"></i></a></li>';
					}
						$output .= '</ul>
								</div>';
				}
					$output .= '</div>
					</div>
				</div>';

				endwhile;
			/* Restore original Post Data */
			wp_reset_postdata();
			$output .= '</div>';
			if ( $last_page > $paged ) {
				$output .= '<div class="razzi-posts__found">
				<div class="razzi-posts__found-inner">Showing<span class="current-post"> ' . $count . ' </span>of <span class="found-post"> ' . $total_posts . ' </span>products <span class="count-bar" style="width: 10.3896%;"></span></div>
				</div>
				<nav class="woocommerce-navigation next-posts-navigation ajax-navigation ajax-loadmore ">
					<div class="nav-previous-ajax">
						<a href="' . $ms_button_url . 'page/' . $Nextpaged . '/" id="loadmoreButton"><span class="button-text">Load More</span></a>
						<div class="razzi-gooey-loading">
							<div class="razzi-gooey">
								<div class="dots">
									<span></span>
									<span></span>
									<span></span>
								</div>
							</div>
						</div>
					</div>
				</nav>';
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
}
