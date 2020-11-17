<?php 


get_header();

$writy_content_class = 'col-md-10 offset-md-1';
if(is_active_sidebar('sidebar-1')){
    $writy_content_class = 'col-lg-9 col-md-8';
}

?>
<div class="single_blog_post_area writy_section_padding_top writy_section_padding_bottom" id="site-content">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($writy_content_class);?>">
                <?php

                // Start the Loop.
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', get_post_type());
                ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <?php


                            if (is_singular('attachment')) {
                                // Parent post navigation.
                                the_post_navigation(
                                    array(
                                        /* translators: %s: Parent post link. */
                                        'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'writy'), '%title'),
                                    )
                                );
                            } elseif (is_singular('post')) {
                                // Previous/next post navigation.
                                the_post_navigation(
                                    array(
                                        'next_text' =>'<span class="screen-reader-text">' . __('Next post:', 'writy') . '</span> <br/>' .
                                            '<span class="post-title">%title</span>' .
                                            '<span class="meta-nav" aria-hidden="true">' . ' »' . '</span> ',
                                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . '« ' . '</span> ' .
                                            '<span class="screen-reader-text">' . __('Previous post:', 'writy') . '</span> <br/>' .
                                            '<span class="post-title">%title</span>',
                                    )
                                );
                            }

                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }

                            ?>
                        </div>
                    </div>


                <?php

                endwhile; // End the loop.
                ?>
            </div>
            <?php get_sidebar();?>
        </div>
    </div>

</div>
<?php get_footer(); ?>