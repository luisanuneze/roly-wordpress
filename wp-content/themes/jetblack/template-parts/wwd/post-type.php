<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_wwd_args = jetblack_get_section_args( 'wwd' );

$jetblack_loop = new WP_Query( $jetblack_wwd_args );

if ( $jetblack_loop->have_posts() ) :
	?>
	<div class="wwd-block-list">
		<div class="row">
		<?php

		while ( $jetblack_loop->have_posts() ) :
			$jetblack_loop->the_post();
			
			$count = absint( $jetblack_loop->current_post );
			
			$icon  = jetblack_gtm( 'jetblack_wwd_custom_icon_' . $count );
			?>
			<div class="wwd-block-item post-type ff-grid-4">
				<div class="wwd-block-inner inner-block-shadow">
					<?php if ( $icon ) : ?>
					<a class="wwd-fonts-icon" href="<?php the_permalink(); ?>" >
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					</a>
					<?php endif; ?>

					<div class="wwd-block-inner-content">
						<?php the_title( '<h3 class="wwd-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

						<div class="wwd-block-item-excerpt">
							<?php the_excerpt(); ?>
						</div><!-- .wwd-block-item-excerpt -->
					</div><!-- .wwd-block-inner-content -->
				</div><!-- .wwd-block-inner -->
			</div><!-- .wwd-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .row -->
	</div><!-- .wwd-block-list -->
<?php
endif;

wp_reset_postdata();
