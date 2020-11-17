<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_visibility = jetblack_gtm( 'jetblack_testimonial_visibility' );

if ( ! jetblack_display_section( $jetblack_visibility ) ) {
	return;
}

$image = jetblack_gtm( 'jetblack_testimonial_bg_image' );
?>
<div id="testimonial-section" class="overlay-enabled testimonial-section section dark-background carousel-enabled" <?php echo $image ? 'style="background-image: url( ' .esc_url( $image ) . ' )"' : ''; ?>>
	<div class="section-testimonial testimonial-layout-1">
		<div class="container">
			<?php jetblack_section_title( 'testimonial' ); ?>

			<div class="next-prev-wrap">
		   		<div class="swiper-button-prev"></div>
			    <div class="swiper-button-next"></div>
			</div>
		    
			<?php get_template_part( 'template-parts/testimonial/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-testimonial  -->
</div><!-- .section -->
