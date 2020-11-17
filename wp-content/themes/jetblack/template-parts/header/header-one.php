<?php
/**
 * Header One Style Template
 *
 * @package JetBlack
 */
$jetblack_phone      = jetblack_gtm( 'jetblack_header_phone' );
$jetblack_email      = jetblack_gtm( 'jetblack_header_email' );
$jetblack_address    = jetblack_gtm( 'jetblack_header_address' );
$jetblack_open_hours = jetblack_gtm( 'jetblack_header_open_hours' );

$jetblack_button_text   = jetblack_gtm( 'jetblack_header_button_text' );
$jetblack_button_link   = jetblack_gtm( 'jetblack_header_button_link' );
$jetblack_button_target = jetblack_gtm( 'jetblack_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper<?php echo ! $jetblack_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $jetblack_phone || $jetblack_email || $jetblack_address || $jetblack_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-one dark-top-header">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'jetblack' ); ?></span>
				</button><!-- #header-top-toggle -->

				<div id="site-top-header-mobile-container">
					<?php if ( $jetblack_phone || $jetblack_email || $jetblack_address || $jetblack_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social">
							<div class="social-nav no-border circle-icon">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'jetblack' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'social',
											'menu_class'     => 'social-links-menu',
											'depth'          => 1,
											'link_before'    => '<span class="screen-reader-text">',
										) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>

					<?php get_template_part( 'template-parts/header/header-mobile-search' ); ?>
				</div><!-- #site-top-header-mobile-container-->
			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $jetblack_phone || $jetblack_email || $jetblack_address || $jetblack_open_hours ) : ?>
				<div id="quick-contact" class="pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div>
				<?php endif; ?>

				<?php if ( has_nav_menu( 'social' ) ): ?>
					<div class="top-head-right pull-right">
						<div id="top-social" class="pull-left">
							<div class="social-nav no-border circle-icon">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'jetblack' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'social',
											'menu_class'     => 'social-links-menu',
											'depth'          => 1,
											'link_before'    => '<span class="screen-reader-text">',
										) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					</div>
				<?php endif; ?>
			</div><!-- .container -->
		</div><!-- .site-top-header -->
	</div><!-- #top-header -->
	<?php endif; ?>

	<header id="masthead" class="site-header main-header-one clear-fix<?php echo jetblack_gtm( 'jetblack_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->

				<div class="right-head pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div><!-- .main-nav -->

					<div class="head-search-cart-wrap pull-left">
						<?php if ( function_exists( 'jetblack_woocommerce_header_cart' ) ) : ?>
						<div class="cart-contents pull-left">
							<?php jetblack_woocommerce_header_cart(); ?>
						</div>
						<?php endif; ?>
						<div class="header-search mobile-off pull-right">
							<?php get_template_part( 'template-parts/header/header-search' ); ?>
						</div><!-- .header-search -->
					</div><!-- .head-search-cart-wrap -->

					<?php if ( $jetblack_button_text ) : ?>
					<a target="<?php echo esc_attr( $jetblack_button_target );?>" href="<?php echo esc_url( $jetblack_button_link );?>" class="ff-button header-button pull-right"><?php echo esc_html( $jetblack_button_text );?></a>
					<?php endif; ?>
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div><!-- .header-wrapper -->
