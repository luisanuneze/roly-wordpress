<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JetBlack
 */

$jetblack_visibility = jetblack_gtm( 'jetblack_featured_content_visibility' );

if ( ! jetblack_display_section( $jetblack_visibility ) ) {
	return;
}

?>
<div id="featured-content-section" class="featured-content-section section style-one page">
	<div class="section-latest-posts">
		<div class="container">
			<?php jetblack_section_title( 'featured_content' ); ?>

		    <?php get_template_part( 'template-parts/featured-content/post-type' ); ?>

			<?php
			$jetblack_button_text   = jetblack_gtm( 'jetblack_featured_content_button_text' );
			$jetblack_button_link   = jetblack_gtm( 'jetblack_featured_content_button_link' );
			$jetblack_button_target = jetblack_gtm( 'jetblack_featured_content_button_target' ) ? '_blank' : '_self';

			if ( $jetblack_button_text ) : ?>
				<div class="more-wrapper clear-fix">
					<a href="<?php echo esc_url( $jetblack_button_link ); ?>" class="ff-button" target="<?php echo esc_attr( $jetblack_button_target ); ?>"><?php echo esc_html( $jetblack_button_text ); ?></a>
				</div><!-- .more-wrapper -->
			<?php endif; ?>
		</div><!-- .container -->
	</div><!-- .latest-posts-section -->
</div><!-- .section-latest-posts -->

