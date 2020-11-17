<?php
/**
 * Displays header site branding
 *
 * @package Photo_Journal
 */
?>

<header id="masthead" class="site-header" role="banner">
	<div id="header-content" class="header-content">
		<div class="wrapper">
			<div class="site-header-main">
				<?php get_template_part( 'template-parts/navigation/navigation-header', 'social' ); ?>
					<div class="site-branding">
						<?php photo_journal_the_custom_logo(); ?>

						<div class="site-identity">
							<?php if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html( $description ); ?></p>
							<?php endif; ?>
						</div><!-- .site-identity -->
					</div><!-- .site-branding -->
					<div class="secondary-search-wrapper">
						<div id="search-social-container-right" class="search-social-container with-social">
	        				<div id="search-container">
	            				<?php get_search_form(); ?>
	            			</div><!-- #search-container -->
						</div><!-- #search-social-container-right -->
					</div><!-- .secondary-search-wrapper -->
			</div><!-- .site-header-main -->
		</div><!-- .wrapper -->
	</div><!-- #header-content -->
</header><!-- .site-header -->

<?php
get_template_part( 'template-parts/navigation/navigation', 'primary' );
?>
