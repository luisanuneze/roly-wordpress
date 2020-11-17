<?php
/**
 * The template for displaying featured content
 *
 * @package Abletone
 */
?>

<?php
$enable_content = get_theme_mod( 'abletone_featured_content_option', 'disabled' );

if ( ! abletone_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$abletone_title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'abletone' ) );
$sub_title = get_option( 'featured_content_content' );

$classes[] = 'layout-three';
$classes[] = 'featured-content';
$classes[] = 'section';

if( ! $abletone_title && !$sub_title ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( '' !== $abletone_title || $sub_title ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<?php if ( '' !== $abletone_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $abletone_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description-wrapper section-subtitle">
						<?php
						$sub_title = apply_filters( 'the_content', $sub_title );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
						?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php
			get_template_part( 'template-parts/featured-content/content-featured' );
			?>
		</div><!-- .section-content-wrap -->	
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
