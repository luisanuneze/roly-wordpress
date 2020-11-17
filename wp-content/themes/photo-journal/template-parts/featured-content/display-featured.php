<?php
/**
 * The template for displaying featured content
 *
 * @package Photo_Journal
 */
?>

<?php
$enable_content = get_theme_mod( 'photo_journal_featured_content_option', 'disabled' );

if ( ! photo_journal_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$photo_journal_title = get_option( 'featured_content_title', esc_html__( 'Contents', 'photo-journal' ) );
$sub_title           = get_option( 'featured_content_content' );
?>

<div id="featured-content-section" class="section">
	<div class="wrapper">
		<?php if ( $photo_journal_title || $sub_title ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<?php if ( $photo_journal_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $photo_journal_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="taxonomy-description-wrapper section-subtitle">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .taxonomy-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<?php get_template_part( 'template-parts/featured-content/content', 'featured' ); ?>
		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
