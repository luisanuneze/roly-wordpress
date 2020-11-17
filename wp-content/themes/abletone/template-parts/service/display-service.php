<?php
/**
 * The template for displaying service content
 *
 * @package Abletone
 */
?>

<?php
$enable_content = get_theme_mod( 'abletone_service_option', 'disabled' );

if ( ! abletone_check_section( $enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$abletone_title    = get_option( 'ect_service_title', esc_html__( 'Services', 'abletone' ) );
$sub_title = get_option( 'ect_service_content' );

$classes[] = 'service-section';
$classes[] = 'section';

if ( ! $abletone_title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}

$background = get_theme_mod( 'abletone_service_bg_image' );

if ( $background ) {
	$classes[] = 'has-background-image';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' !== $abletone_title || $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $abletone_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $abletone_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
						$sub_title = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<?php

		$wrapper_classes[] = 'section-content-wrapper service-content-wrapper';
		$wrapper_classes[] = 'layout-four';
		?>

		<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">
			<?php
			get_template_part( 'template-parts/service/content-service' );
			?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
