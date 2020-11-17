<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$portfolio_args = jetblack_get_section_args( 'portfolio' );

$jetblack_loop = new WP_Query( $portfolio_args );

if ( $jetblack_loop->have_posts() ) :
	?>
	<div class="portfolio-main-wrapper">
		<div>
		<?php

		while ( $jetblack_loop->have_posts() ) :
			$jetblack_loop->the_post();
			?>
			<div class="portfolio-item ff-grid-4">
				<div class="item-inner-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="portfolio-thumb-wrap">
						<?php the_post_thumbnail( 'jetblack-portfolio', array( 'class' => 'jetblack-portfolio' ) ); ?>
					</div>
					<?php endif; ?>

					<div class="portfolio-content">
						<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>
					</div><!-- .portfolio-content -->
				</div><!-- .item-inner-wrapper -->
			</div><!-- .portfolio-item -->
		<?php
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->
	</div><!-- .portfolio-main-wrapper -->
<?php
endif;

wp_reset_postdata();
