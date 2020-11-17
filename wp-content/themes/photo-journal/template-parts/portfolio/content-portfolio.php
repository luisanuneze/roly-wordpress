<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Photo_Journal
 */
?>

<?php
$show_content = get_theme_mod( 'photo_journal_portfolio_content_show', 'hide-content' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?> class="hentry">
	<div class="hentry-inner">
		<div class="portfolio-thumbnail post-thumbnail">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				// Output the featured image.
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('photo-journal-portfolio');
				} else {
					echo '<a href=' . esc_url( get_permalink() ) .'><img src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb.jpg"/></a>';
				}
				?>
			</a>
		</div><!-- .portfolio-thumbnail -->

		<div class="entry-container">
			<div class="inner-wrap">
				<header class="entry-header portfolio-entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</header>
			</div><!-- .inner-wrap -->
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
