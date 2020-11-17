<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_enable_wwd = jetblack_gtm( 'jetblack_wwd_visibility' );

if ( ! jetblack_display_section( $jetblack_enable_wwd ) ) {
	return;
}

$jetblack_top_subtitle = jetblack_gtm( 'jetblack_wwd_section_top_subtitle' );
$jetblack_title        = jetblack_gtm( 'jetblack_wwd_section_title' );
$jetblack_subtitle     = jetblack_gtm( 'jetblack_wwd_section_subtitle' );
?>

<div id="wwd-section" class="section style-one">
	<div class="section-wwd wwd-layout-1">
		<div class="container">
			<?php if ( $jetblack_top_subtitle || $jetblack_title || $jetblack_subtitle ) : ?>
			<div class="section-title-wrap">
				<?php if ( $jetblack_top_subtitle ) : ?>
				<p class="section-top-subtitle"><?php echo esc_html( $jetblack_top_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $jetblack_title ) : ?>
				<h2 class="section-title"><?php echo esc_html( $jetblack_title ); ?></h2>
				<?php endif; ?>

				<span class="divider"></span>
				<?php if ( $jetblack_subtitle ) : ?>
				<p class="section-subtitle"><?php echo esc_html( $jetblack_subtitle ); ?></p>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
