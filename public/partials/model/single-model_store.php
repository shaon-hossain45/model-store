<?php
/**
 * The template for displaying all single model posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'model_store_before_main_content' );

        $is_pass_protected = post_password_required();

        if ( have_posts() && ! $is_pass_protected ) {
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                //ms_get_template( 'content', 'single-model' );
                $template_part_path = plugin_dir_path( dirname(__FILE__ ) ) . '/includes/template-parts/content/content-single-model.php';
                // Check if the template file exists
                if (file_exists($template_part_path)) {
                    include($template_part_path);
                }
            endwhile; // End of the loop.
        } elseif( $is_pass_protected ) {
            echo get_the_password_form();
        } else {
            $template_part_path = plugin_dir_path( dirname(__FILE__ ) ) . '/includes/template-parts/content/content-none.php';
            // Check if the template file exists
            if (file_exists($template_part_path)) {
                include($template_part_path);
            }
        }

    /**
        * woocommerce_after_main_content hook.
        *
        * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
        */
    do_action( 'model_store_after_main_content' );

get_footer();
