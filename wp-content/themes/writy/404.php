<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @subpackage writy
 * @since writy 1.0
 */

get_header();
?>

<!-- Start Blog -->
<div class="blog_area writy_section_padding_bottom writy_section_padding_top writy_error_page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="writy_blog_parent text-center">

                    <div class="writy_single_blog">

                        <div class="writy_blog_content">
                            <h3 class="title-line">
                                <?php _e('Oops! That page cannot be found', 'writy'); ?>
                            </h3>
                            <p>
                                <?php _e('It looks like nothing was found at this location. Maybe try a search?', 'writy'); ?>
                            </p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area -->





<?php
get_footer();
