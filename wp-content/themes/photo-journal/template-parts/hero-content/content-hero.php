<?php
/**
 * The template used for displaying hero content
 *
 * @package Photo_Journal
 */
?>

<?php
$enable_section = get_theme_mod( 'photo_journal_hero_content_visibility', 'disabled' );

if ( ! photo_journal_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type', 'hero' );
