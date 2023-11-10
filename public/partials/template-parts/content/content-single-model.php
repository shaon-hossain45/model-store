<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="model-gallery-summary">
        <div class="model-gallery">
            <div class="splide_track" id="splide_track">
                <div class="splide_list">
                    <div class="splide-part">
                        <?php
                        // Check if the post has a featured image
                        if (has_post_thumbnail()) {
                            echo '<div class="featured-image">';
                            the_post_thumbnail('full');  // You can specify different image sizes (thumbnail, medium, large, full)
                            echo '</div>';
                        }else{
                            echo '<div class="featured-image">';
                            $image_url = MS_ABSPATH .'/public/images/model-store-placeholder.png'; // Set it to 1 (checked) by default
                            echo '<img width="600" height="600" src="'.$image_url.'" class="" alt="" decoding="async" title="t-shirt-with-logo-1.jpg" data-caption="" data-src="http://localhost/wordpress/wp-content/uploads/2023/09/t-shirt-with-logo-1.jpg" data-large_image="http://localhost/wordpress/wp-content/uploads/2023/09/t-shirt-with-logo-1.jpg" data-large_image_width="800" data-large_image_height="800">';
                            echo '</div>';
                        }
                        ?>
                        <img style="display: none;" width="600" height="600" src="http://localhost/wordpress/wp-content/uploads/2023/09/t-shirt-with-logo-1.jpg" class="" alt="" decoding="async" title="t-shirt-with-logo-1.jpg" data-caption="" data-src="http://localhost/wordpress/wp-content/uploads/2023/09/t-shirt-with-logo-1.jpg" data-large_image="http://localhost/wordpress/wp-content/uploads/2023/09/t-shirt-with-logo-1.jpg" data-large_image_width="800" data-large_image_height="800">
                    </div>
                </div>
            </div>
            <div class="model-thumbnail">
                <div class="swiper swiper-gallery">
                    <div class="swiper-wrapper">
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648557_acc7d241-cdac-4965-b8be-9956e7bfbb51/thumbs/cover/320x240/jpg/dscf6724-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648559_9ae51139-749d-4023-af21-65bd09d322cc/thumbs/cover/320x240/jpg/dscf6718-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648557_acc7d241-cdac-4965-b8be-9956e7bfbb51/thumbs/cover/320x240/jpg/dscf6724-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648559_9ae51139-749d-4023-af21-65bd09d322cc/thumbs/cover/320x240/jpg/dscf6718-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648557_acc7d241-cdac-4965-b8be-9956e7bfbb51/thumbs/cover/320x240/jpg/dscf6724-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648559_9ae51139-749d-4023-af21-65bd09d322cc/thumbs/cover/320x240/jpg/dscf6718-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648557_acc7d241-cdac-4965-b8be-9956e7bfbb51/thumbs/cover/320x240/jpg/dscf6724-2.webp"></div>
                        <div class="splide_lol swiper-slide"><img src="https://media.printables.com/media/prints/582465/images/4648559_9ae51139-749d-4023-af21-65bd09d322cc/thumbs/cover/320x240/jpg/dscf6718-2.webp"></div>
                    </div>
                    <div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
        <div class="model-summary">
            <div class="model-breadcrumb">
                <ul class="breadcrumb-list">
                    <li><a> 3D Models </a></li>
                    <li><a> Gadgets </a></li>
                    <li><a> Portable Devices </a></li>
                </ul>
            </div>
            <div class="model-header d-flex align-items-start mb-2">
                <h1 class="model-name mb-0">Magsafe charger stand for iPhone</h1>
            </div>
            
<div class="reviews-rating">
    <div class="revauto">
        <span class="rating rate-9"></span>
        <span class="ratings-count">21 reviews</span>
    </div>
</div>

            <div class="user-info">
                <a class="user-card" href="#">
                    <div class="user-point">
                        <div class="user-avatar">
                            <img src="https://media.printables.com/media/auth/avatars/4c/thumbs/cover/40x40/jpg/4c705aa1-c2b2-4fdc-970a-b0dfc0b9e881.webp" alt="">
                            <span class="badge">11</span>
                        </div>
                    </div>
                    <div class="name-and-handle">
                        <div class="name">Thomas</div>
                        <div class="handle">@Thomas_50404</div>
                    </div>
                </a>
            </div>
            <div class="summary">Stand made for the Magsafe charger and iPhone, both portrait and landscape, easy to print. Compatible with Standby mode.</div>
            <div class="model-download">
                <a class="download-btn" href="#" id="activateItem2"><span class="btn-text text-uppercase ml-1"><i class="fa-solid fa-download"></i></span>Download</a>
            </div>


            <div class="interaction-panel">
                <div class="button-row">
                    <button class="btn"><i class="fas fa-heart"></i><span> Like </span></button>
                    <button class="btn"><i class="fas fa-bookmark"></i><span> Bookmark </span></button>
                    <button class="btn"><i class="fa fa-share"></i><span> Share </span></button>
                </div>
            </div>

        </div>
    </div>
    <div class="tabs-container mt-2">
        <div class="container-xl">
            <ul id="tabs" class="nav nav-tabs nav-fill tabs-wrap-count">
                <li class="nav-item">Details</li>
                <li class="nav-item">Files<span>4</span></li>
                <li class="nav-item">Makes & Comments<span>204</span></li>
                <li class="nav-item">Collections<span>4000</span></li>
            </ul>
        </div>
    </div>
    <main role="main" class="tab-content">
        <div class="tab-pane" id="tab-content-1"><?php the_content(); ?></div>
        <div class="tab-pane" id="tab-content-2">
        
            <h2 _ngcontent-prusa-front-app-c232="" class="flex-grow-1">Model files</h2>
            <div class="folder-item" onclick="openItem(this)">
                <div class="folder-header">
                    <div class="folder-icon"><i class="fas fa-heart"></i></div>
                    <div class="folder-name">All in one </div>
                    <div class="folder-size"><span>1</span> file</div>
                </div>
                <div class="download-wrapper">
                    <?php
                    // Retrieve the file URLs saved in post meta
                    $file_url = "https://files.printables.com/media/prints/582465/stls/4813096_b505197e-9cad-4856-bfb9-966cc81ca084_bcc16cc4-5735-4cf0-80c3-f20ee6b06932/all-in-one-print-in-place-v2.stl?_gl=1*kci4wu*_ga*NjIwNTMwMTczLjE2OTUzNjIxMTg.*_ga_3HK7B7RT5V*MTY5NzI2MjQxNS42Mi4wLjE2OTcyNjI0MTUuNjAuMC4w";

                    if ($file_url) {
                        echo '<div class="download-content">
                            <div class="folder-content">
                                <div class="file-icon"><i _ngcontent-prusa-front-app-c132="" class="fas fa-heart"></i></div><div class="file-name">' . esc_url($file_url) . '</div>
                                <div class="file-size"><a class="btn-download" href="' . esc_url($file_url) . '" download><i class="fas fa-download"></i><span class="filesize">3&nbsp;MB</span></a></div>
                            </div>
                        </div>';
                    }; ?>
                </div>
            </div>

            <div class="folder-item" onclick="openItem(this)">
                <div class="folder-header">
                    <div class="folder-icon"><i class="fas fa-heart"></i></div>
                    <div class="folder-name">Split version </div>
                    <div class="folder-size"><span>3</span> files</div>
                </div>
                <div class="download-wrapper">
                    <?php
                    // Retrieve the file URLs saved in post meta
                    $file_urls = get_post_meta(get_the_ID(), '_model_store_file_upload_meta_key', true);

                    if ($file_urls) {
                        foreach ($file_urls as $file_url) {
                            echo '<div class="download-content">
                                <div class="folder-content">
                                    <div class="file-icon"><i _ngcontent-prusa-front-app-c132="" class="fas fa-heart"></i></div><div class="file-name">' . esc_url($file_url) . '</div>
                                    <div class="file-size"><a class="btn-download" href="' . esc_url($file_url) . '" download><i class="fas fa-download"></i><span class="filesize">3&nbsp;MB</span></a></div>
                                </div>
                            </div>';
                        }
                    }; ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-content-3">
        <?php
        //comments_template( '/comments.php', true );
                // If comments are open or there is at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            ?>
        </div>
        <div class="tab-pane" id="tab-content-4">Content for Item 4</div>
    </main>
    <div class="model-extra">
        <h2 class="section-header">Model origin</h2>
        <p>The author marked this model as their own original creation.</p>
    </div>
    <div class="model-extra">
        <h2 class="section-header">License <i _ngcontent-prusa-front-app-c256="" class="fa fa-copyright"></i></h2>
    
        <a rel="license" target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
            <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png">
        </a>
        <br>
        This work is licensed under a 
        <br>
        <a rel="license" target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons (4.0 International License)<br><h6>Attribution—Noncommercial—Share Alike</h6></a>
        <hr>
        <div><span style="color:#cb2c2c; font-weight:bold;">✖ </span> | Sharing without ATTRIBUTION </div>
        <div><span style="color:#5daf0b; font-weight:bold;">✔ </span> | Remix Culture allowed  </div>
        <div><span style="color:#cb2c2c; font-weight:bold;">✖ </span> | Commercial Use  </div>
        <div><span style="color:#cb2c2c; font-weight:bold;">✖ </span> | Free Cultural Works  </div>
        <div><span style="color:#cb2c2c; font-weight:bold;">✖ </span> | Meets Open Definition  </div>
    </div>
    <div class="model-extra">
        <h2 class="section-header">Highlighted models from creator</h2>
        <?php
			// Extra Buttons
			$saved_like_feature = get_option('model_store_like_feature');
			$saved_collect_feature = get_option('model_store_collect_feature');
			$saved_related_number = get_option('model_related_number');

			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_like_feature === false) {
				$saved_like_feature = 1; // Set it to 1 (checked) by default
			}
			
			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_collect_feature === false) {
				$saved_collect_feature = 1; // Set it to 1 (checked) by default
			}

			// Set a default value for modal_store_enable_feature if it's not set yet
			if ($saved_related_number === false) {
				$saved_related_number = 4; // Set it to 4 (checked) by default
			}

			$output = '';

			$args = array(
				'post_type'   => 'model_store',
				'post_status' => 'publish',
                'posts_per_page' => $saved_related_number, // Number of related posts to display
                // 'post__not_in' => array(get_the_ID()), // Exclude the current post
				'order'       => 'DESC',
				'orderby'     => 'ID',
			);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				$output .= '<div class="model-container">
				<div class="model-wrapper model-'.$saved_related_number.'">
				<div class="splide__list">';
				
				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					// Title
					$title = get_the_title();

					// Image
					$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' is the image size
					// Set a default value for modal_store_enable_feature if it's not set yet
					if ($image_url == '') {
						$image_url = MS_ABSPATH .'/public/images/model-store-placeholder.png'; // Set it to 1 (checked) by default
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
											// if($file_url){
											// 	$output .= '<li><a href="' . esc_url($file_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											// }else{
											// 	$output .= '<li><a href="' . esc_url($image_url) . '" download><i class="fa-solid fa-download"></i><span>5025</span></a></li>';
											// }
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
			echo $output;
		
        ?>
    </div>
</div><!-- #post-<?php the_ID(); ?> -->
