<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Photo_Journal
 */

$number = get_theme_mod( 'photo_journal_featured_content_number', 3 );

$post_list    = array();

$args = array(
	'posts_per_page'      => $number,
	'post_type'           => 'featured-content',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
	'orderby'             => 'post__in',
);

for ( $i = 1; $i <= $number; $i++ ) {
	$photo_journal_post_id = get_theme_mod( 'photo_journal_featured_content_cpt_' . $i );

	if ( $photo_journal_post_id && '' !== $photo_journal_post_id ) {
		$post_list = array_merge( $post_list, array( $photo_journal_post_id ) );
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

$args['posts_per_page'] = $number;

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) : ?>
<div class="section-content-wrapper featured-content-wrapper layout-three">
	<?php
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="hentry-inner">
				<?php if ( has_post_thumbnail() ) : ?>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>">
					<?php
					$thumbnail = 'photo-journal-featured-content';

					the_post_thumbnail( $thumbnail );
					?>
				</a>
				<?php endif; ?>

				<div class="entry-container">
					<header class="entry-header">
						<?php echo photo_journal_entry_category_date(); ?>

						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
					</header>
					<?php
						$excerpt = get_the_excerpt();
						echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
					?>
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
	endwhile;

wp_reset_postdata();

endif;
