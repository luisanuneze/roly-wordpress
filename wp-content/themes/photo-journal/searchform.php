<?php
/**
 * Template for displaying search forms in Photo Journal
 *
 * @package Photo_Journal
 */
?>

<?php $search_text = get_theme_mod( 'photo_journal_search_text', esc_html__( 'Search', 'photo-journal' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'photo-journal' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><?php echo photo_journal_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'photo-journal' ); ?></span></button>
</form>
