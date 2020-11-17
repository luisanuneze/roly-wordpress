<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Photo_Journal
 */
?>

<?php
$photo_journal_layout = photo_journal_get_theme_layout();

// Bail early if no sidebar layout is selected.
if ( 'no-sidebar' === $photo_journal_layout ) {
	return;
}

$sidebar = photo_journal_get_sidebar_id();

if ( '' === $sidebar ) {
    return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- .sidebar .widget-area -->
