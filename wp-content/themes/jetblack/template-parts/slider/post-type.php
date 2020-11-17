<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_slider_args = jetblack_get_section_args( 'slider' );

$jetblack_loop = new WP_Query( $jetblack_slider_args );

while ( $jetblack_loop->have_posts() ) :
	$jetblack_loop->the_post();

	$text_align  = jetblack_gtm( 'jetblack_slider_text_align_' . $jetblack_loop->current_post );
	?>
	<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="swiper-slide type-post caption-animate text-alignleft <?php echo has_post_thumbnail() ? 'has-post-thumbnail' : ''; ?>">
		<div class="slider-image-wrapper">
			<div class="slider-content-image featured-image">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'jetblack-slider' );
			} else {
				echo '<img class="wp-post-image no-thumb" src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'images/no-thumb-1920x900.jpg">';
			}
			?>
		</div><!-- .featured-image -->
		</div><!-- .slider-image-wrapper -->

		<div class="slider-content-wrapper">
			<div class="container">
				<?php the_title( '<h2 class="slider-title">', '</h2><!-- .slider-title -->' ); ?>

				<div class="slider-content clear-fix">
					<?php the_excerpt(); ?>
				</div><!-- .entry-content -->
			</div><!-- .entry-container -->
		</div><!-- .slider-content-wrapper -->
	</article><!-- .hentry -->
<?php
endwhile;

wp_reset_postdata();
