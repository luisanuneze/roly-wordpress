<?php
/**
 * Template part for displaying Hero Content
 *
 * @package JetBlack
 */

$jetblack_args = array(
	'page_id' => absint( jetblack_gtm( 'jetblack_hero_content_page' ) ),
);

// If $jetblack_args is empty return false
if ( ! $jetblack_args ) {
	return;
}

$jetblack_args['posts_per_page'] = 1;

$jetblack_loop = new WP_Query( $jetblack_args );

while ( $jetblack_loop->have_posts() ) :
	$jetblack_loop->the_post();
	?>

	<div id="hero-content-section" class="hero-content-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<?php the_post_thumbnail( 'jetblack-hero', array( 'class' => 'alignnone' ) );?>
					</div>
					<?php endif; ?>

					<!-- .ff-grid-6 -->
					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap">
								<?php 
								$jetblack_subtitle = jetblack_gtm( 'jetblack_hero_content_custom_subtitle' );
								
								if ( $jetblack_subtitle ) : ?>
								<p class="section-top-subtitle"><?php echo esc_html( $jetblack_subtitle ); ?></p>
								<?php endif; ?>

								<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

								<span class="divider"></span>
							</div>

							<?php jetblack_display_content( 'hero_content' ); ?>
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
