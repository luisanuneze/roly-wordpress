<?php

if (is_sticky()) { 
    
    // Must be inside a loop.
    $banner_area = 'writy_banner_area';
    $banenr_content = 'writy_banner_content';
    if ( has_post_thumbnail() ) {
        $banenr_content = 'writy_banner_content';
        $banner_area = 'writy_banner_area';
    }
    else {
        $banenr_content = 'writy_banner_content writy_banner_no_transform';
        $banner_area = 'writy_banner_area has_no_thumbnail';;
    }
   
    ?>
    <div class="<?php echo esc_attr($banner_area );?>">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="writy_banner_inner">
                   <?php
                    if(has_post_thumbnail()){
                        the_post_thumbnail('writy_banner_image', ['class' => 'banner-image']);
                    }
                   
                   ?>
                       
                        <div class="<?php echo esc_attr($banenr_content);?>">
                            <div class="row no-gutters">
                                <div class="col-md-10 offset-md-1">
                                    <div class="writy_banner_content_inner text-center">
                                        <h1><?php the_title(); ?></h1>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="btn writy_btn writy_btn_sticky">
                                        <?php _e('Read More..','writy')?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

} else { ?>

    <!--  -->
    <div <?php post_class('writy_single_blog'); ?> id="post-<?php the_ID(); ?>">
        <div class="writy_blog_image">
            <?php the_post_thumbnail('large'); ?>
        </div>
        <div class="writy_blog_content">
            <h3 class="title-line">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <?php 
            the_excerpt();
            wp_link_pages(
                array(
                    'before' => '<div class="page-links writy_page_links">' . __( 'Pages:', 'writy' ),
                    'after'  => '</div>',
                )
            );
             ?>
            <a href="<?php the_permalink(); ?>" class="btn writy_btn writy_btn_borderd">
                <?php _e('Read More..','writy')?>
            </a>
        </div>
    </div>
    <!--  -->
<?php
}


?>