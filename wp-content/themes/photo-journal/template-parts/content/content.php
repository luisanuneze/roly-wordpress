<?php
/**
 * The template part for displaying content
 *
 * @package Photo_Journal
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="post-wrapper">
		<?php	
			photo_journal_post_thumbnail();		
		?>

		<div class="entry-container">
			<header class="entry-header">
				<div class="entry-meta">
					<?php echo photo_journal_entry_category(); ?>
				</div><!-- .entry-meta -->
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php esc_html_e( 'Featured', 'photo-journal' ); ?></span>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php echo photo_journal_recent_post_entry_header(); ?>
			</header><!-- .entry-header -->
				<div class="entry-summary">
					<?php the_excerpt(); ?>

					<?php
						photo_journal_edit_link();
					?>
				</div><!-- .entry-summary -->
			<?php
			//echo photo_journal_entry_footer(); ?>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article><!-- #post-## -->
