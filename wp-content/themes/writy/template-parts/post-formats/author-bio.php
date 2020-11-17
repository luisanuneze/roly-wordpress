<div class="writy_author">
    <?php echo  get_avatar(get_the_author_meta('ID')); ?>

    <div class="writy_author__content">
        <h4 class="writy_author__name">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
        </h4>

        <p>
            <?php the_author_meta('description'); ?>
        </p>
    </div>
</div>