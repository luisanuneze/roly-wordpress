<?php
/**
 * The template for displaying service posts on the front page
 *
 * @package Abletone
 */
$number        = get_theme_mod( 'abletone_service_number', 4 );

$post_list  = array();
$no_of_post = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

$args['post_type'] = 'ect-service';

for ( $i = 1; $i <= $number; $i++ ) {
	$abletone_post_id = '';
	$abletone_post_id = get_theme_mod( 'abletone_service_cpt_' . $i );
	if ( $abletone_post_id ) {
		$post_list = array_merge( $post_list, array( $abletone_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

$args['posts_per_page'] = $no_of_post;

if ( ! $no_of_post ) {
	return;
}

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	
	$loop->the_post();
	$no_thumb = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-140x140.jpg';
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php if( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<a class="cover-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>">
					</a>
				</div>
			<?php else : ?>
				<div class="post-thumbnail">
					<a class="cover-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php echo esc_url( $no_thumb ); ?>">
					</a>
				</div>
			<?php endif; ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<?php
					$excerpt = get_the_excerpt();
					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
				 ?>
			</div><!-- .entry-container -->
		</div> <!-- .hentry-inner -->
	</article> <!-- .article -->
	<?php
endwhile;

wp_reset_postdata();
