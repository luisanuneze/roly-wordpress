<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Photo_Journal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="testimonial-thumbnail post-thumbnail">
				<?php the_post_thumbnail( 'photo-journal-testimonial' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

			<?php if ( $position ) : ?>
					<header class="entry-header">
						<?php 
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
						?>
						<?php if ( $position ) : ?>
							<p class="entry-meta"><span class="position">
								<?php echo esc_html( $position ); ?></span>
							</p>
						<?php endif; ?>
					</header>
			<?php endif;?>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
