<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_args = jetblack_get_section_args( 'testimonial' );
$jetblack_loop = new WP_Query( $jetblack_args );

if ( $jetblack_loop->have_posts() ) :

	$jetblack_carousel = jetblack_gtm( 'jetblack_testimonial_enable_slider' );
	?>
	<div class="testimonial-content-wrapper swiper-carousel-enabled">
		<div class="swiper-wrapper">
		<?php

		while ( $jetblack_loop->have_posts() ) :
			$jetblack_loop->the_post();
			?>
			<div class="testimonial-item swiper-slide">
				<div class="testimonial-wrapper clear-fix">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="testimonial-thumb image-hover-zoom">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'jetblack-portfolio', array( 'class' => 'pull-left' ) ); ?>
						</a>
					</div>
					<?php endif; ?>
					<div class="testimonial-summary">
						<div class="clinet-info">
							<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
						</div>
						<!-- .clinet-info -->

						<?php jetblack_display_content( 'testimonial' ); ?>
					</div>
				</div><!-- .testimonial-wrapper -->
			</div><!-- .testimonial-item -->
		<?php
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->

		<div class="swiper-pagination"></div>
	</div><!-- .testimonial-content-wrapper -->
<?php
endif;

wp_reset_postdata();
