<?php
/**
 * Photo Journal back compat functionality
 *
 * Prevents Photo Journal from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package Photo_Journal
 */

/**
 * Prevent switching to Photo Journal on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Photo Journal 0.1
 */
function photo_journal_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'photo_journal_upgrade_notice' );
}
add_action( 'after_switch_theme', 'photo_journal_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Photo Journal on WordPress versions prior to 4.4.
 *
 * @since Photo Journal 0.1
 *
 * @global string $wp_version WordPress version.
 */
function photo_journal_upgrade_notice() {
	/* translators: %s: current WordPress version. */
	$message = sprintf( __( 'Photo Journal requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'photo-journal' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );// phpcs:ignore Standard.Category.SniffName.ErrorCode.
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Photo Journal 0.1
 *
 * @global string $wp_version WordPress version.
 */
function photo_journal_customize() {
	/* translators: %s: current WordPress version. */
	$message = sprintf( __( 'Photo Journal requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'photo-journal' ), $GLOBALS['wp_version'] ); // phpcs:ignore Standard.Category.SniffName.ErrorCode.

	wp_die( $message, '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'photo_journal_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Photo Journal 0.1
 *
 * @global string $wp_version WordPress version.
 */
function photo_journal_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: current WordPress version. */
		wp_die( sprintf( __( 'Photo Journal requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'photo-journal' ), $GLOBALS['wp_version'] ) );// phpcs:ignore Standard.Category.SniffName.ErrorCode.
	}
}
add_action( 'template_redirect', 'photo_journal_preview' );
