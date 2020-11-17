<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_enable_slider = jetblack_gtm( 'jetblack_slider_visibility' );

if ( ! jetblack_display_section( $jetblack_enable_slider ) ) {
	return;
}

?>
<div id="slider-section" class="section overlay-enabled no-padding style-one">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->

	<div class="swiper-pagination"></div>

	<div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div><!-- .main-slider -->
