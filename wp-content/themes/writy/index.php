<?php get_header(); ?>

<div class="blog_area writy_section_padding_bottom" id="site-content">
    <div class="container" data-find="_5">
        <div class="row" data-find="_4">
            <div class="col" data-find="_3">
                <div id="writy_blog_parent">
                    <?php
                    if (have_posts()) :

                        if (is_home() && !is_front_page()) :
                    ?>
                            <header>
                                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                            </header>
                        <?php
                        endif;

                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
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

<?php get_footer(); ?>