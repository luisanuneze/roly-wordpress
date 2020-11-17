<?php
/**
 * The template used for displaying playlist
 *
 * @package Music_Journal
 */
?>

<?php
$enable_section = get_theme_mod( 'photo_journal_sticky_playlist_visibility', 'disabled' );

if ( ! photo_journal_check_section( $enable_section ) ) {
	// Bail if playlist is not enabled
	return;
}

get_template_part( 'template-parts/sticky-playlist/post-type', 'playlist' );
