<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-8 offset-sm-2 ">
            <div class="writy_section_title text-center">
                <h2>
                    <?php the_title(); ?>
                </h2>
                <span>
                    <i class="ff-Alegreya"> <?php the_author(); ?>/ <?php echo get_the_date(); ?></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="writy_about_image">
                <?php the_post_thumbnail('writy_blog_page_image'); ?>
            </div>
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <div class="writy_quote_content">
                        <?php
                         the_content();
                         wp_link_pages(
                            array(
                                'before' => '<div class="page-links writy_page_links">' . __( 'Pages:', 'writy' ),
                                'after'  => '</div>',
                            )
                        );
                         ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="writy_post_tags">
                                    <span>
                                        <h4>
                                            <?php _e('Post Tags', 'writy') ?>
                                        </h4>
                                    </span>
                                    <?php the_tags('', '', ''); ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!is_singular('attachment')) : ?>
                            <?php get_template_part('template-parts/post-formats/author', 'bio'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>