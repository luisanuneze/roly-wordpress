<?php
/**
 * Header Search
 *
 * @package JetBlack
 */
?>
<div class="primary-search-wrapper">
	<a href="#" id="search-toggle" class="menu-search-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'jetblack' ); ?></span><i class="fas fa-search"></i><i class="far fa-times-circle"></i></a>
	<div id="search-container" class="displaynone">
		<div class="search-container">
			<?php get_search_form(); ?>
		</div><!-- .search-container -->
	</div><!-- #search-container -->
</div><!-- .primary-search-wrapper -->
