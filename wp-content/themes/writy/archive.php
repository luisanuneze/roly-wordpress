<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @subpackage writy
 * @since writy 1.0
 */

get_header();
?>
<?php if (have_posts()) : ?>

    <header class="writy_page_header ">
        <h1 class=" text-center">
        <?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
        </h1>
    </header><!-- .page-header -->
    <div class="blog_area writy_section_padding_bottom writy_section_padding_top" id="site-content">
        <div class="container">

            <div class="row">
                <div class="col">
                    <div class="writy_blog_parent">
                        <?php
                        // Start the Loop.
                        while (have_posts()) :
                            the_post();

                            /*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
                            get_template_part('template-parts/post-formats/post', get_post_type());

                        endwhile;
                        ?>
                        <div class="row">
                            <div class="col">
                                <div class="writy_pagination_contaier">
                                    <?php writy_the_posts_pagination(); ?>
                                </div>
                            </div>
                        </div>
                    <?php


                else :

                    get_template_part('template-parts/post-formats/post', 'none');

                endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    get_footer();
