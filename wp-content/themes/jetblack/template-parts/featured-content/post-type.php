<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_args = jetblack_get_section_args( 'featured_content' );

$jetblack_loop = new WP_Query( $jetblack_args );

if ( $jetblack_loop->have_posts() ) :
	?>
	<div class="featured-content-block-list">
		<div class="row">
			<?php
			while ( $jetblack_loop->have_posts() ) :
				$jetblack_loop->the_post();
				?>
				<div class="latest-posts-item ff-grid-4">
					<div class="latest-posts-wrapper inner-block-shadow">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="latest-posts-thumb">
							<a class="image-hover-zoom" href="<?php the_permalink(); ?>" >
								<?php the_post_thumbnail(); ?>
							</a>
						</div><!-- latest-posts-thumb  -->
						<?php endif; ?>

						<div class="latest-posts-text-content-wrapper">
							<div class="latest-posts-text-content">
								<?php the_title( '<h3 class="latest-posts-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
								<?php jetblack_featured_content_meta();  ?>

								<?php jetblack_display_content( 'featured_content' ); ?>
							</div><!-- .latest-posts-text-content -->
						</div><!-- .latest-posts-text-content-wrapper -->
					</div><!-- .latest-posts-wrapper -->
				</div><!-- .latest-posts-item -->
			<?php endwhile; ?>
		</div><!-- .row -->
	</div><!-- .featured-content-block-list -->
<?php
endif;

wp_reset_postdata();
