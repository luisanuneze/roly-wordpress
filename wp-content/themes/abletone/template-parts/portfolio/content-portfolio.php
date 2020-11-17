<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Abletone
 */
?>

<?php
$show_meta    = get_theme_mod( 'abletone_portfolio_meta_show', 'show-meta' );
$layout       = get_theme_mod( 'abletone_portfolio_content_layout', 'layout-three' );
?>

<article id="portfolio-post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php abletone_post_thumbnail( 'post-thumbnail', 'html', true, true ); ?>
		
		<div class="entry-container caption">
			<div class="entry-container-inner-wrap">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					<div class="entry-meta">
						<?php abletone_posted_on(); ?>
					</div>
				</header>
			</div><!-- .entry-container-inner-wrap -->	
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
