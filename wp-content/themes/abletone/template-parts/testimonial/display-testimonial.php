<?php
/**
 * The template for displaying testimonial items
 *
 * @package Abletone
 */
?>

<?php
$enable = get_theme_mod( 'abletone_testimonial_option', 'disabled' );

if ( ! abletone_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'abletone' ),
);

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

$headline    = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'abletone' );
$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-content-section';

if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-section-heading';
}

$background = get_theme_mod( 'abletone_testimonial_bg_image' );
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $background ) : ?>
			<div class="main-thumbnail" style="background-image: url( <?php echo esc_url( $background ); ?> )">
			</div><!-- .post-thumbnail -->
			<div class="full-content-wrap">
		<?php
		else: ?>
		<div class="full-content-wrap full-width">
		<?php endif; ?>

			<?php if ( $headline || $subheadline ) : ?>
				<div class="section-heading-wrapper testimonial-content-section-headline">
				<?php if ( $headline ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $subheadline ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
			            $subheadline = apply_filters( 'the_content', $subheadline );
			            echo str_replace( ']]>', ']]&gt;', $subheadline );
		                ?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
				</div><!-- .section-heading-wrapper -->
			<?php endif; ?>

			<?php 
			
			$content_classes = 'section-content-wrapper testimonial-content-wrapper';

			$content_classes .= ' testimonial-slider owl-carousel';

			if ( get_theme_mod( 'abletone_testimonial_dots' ) ) {
				$content_classes .= ' owl-dots-enabled';
			} 
			?>

			<div class="<?php echo esc_attr( $content_classes ); ?>">
			<?php get_template_part( 'template-parts/testimonial/post-types-testimonial' ); ?>
			</div><!-- .section-content-wrapper -->
		</div><!-- .full-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
