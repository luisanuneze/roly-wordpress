<?php
/**
 * Displays Primary Navigation
 *
 * @package Photo_Journal
 */
?>

<div id="header-navigation-area">
	<div class="wrapper">
		<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			echo photo_journal_get_svg( array( 'icon' => 'bars' ) );
			echo photo_journal_get_svg( array( 'icon' => 'close' ) );
			echo '<span class="menu-label-prefix">'. esc_attr__( 'Primary ', 'photo-journal' ) . '</span>'; ?>
				<span class="menu-label">
					<?php echo esc_html__( 'Menu', 'photo-journal' ); ?>
				</span>
		</button>

		<div id="site-header-menu" class="site-primary-menu">
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'photo-journal' ); ?>">
					<?php wp_nav_menu( array(
						'theme_location'	=> 'menu-1',
						'container_class'	=> 'primary-menu-container',
						'menu_class'		=> 'primary-menu',
					) ); ?>
				</nav><!-- #site-primary-navigation.custom-primary-menu -->
			<?php else : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'photo-journal' ); ?>">
					<?php wp_page_menu(
						array(
							'menu_class' => 'primary-menu-container',
							'before'     => '<ul id="primary-page-menu" class="primary-menu">',
							'after'      => '</ul>',
						)
					); ?>
				</nav><!-- #site-primary-navigation.default-page-menu -->
			<?php endif; ?>

			<div class="search-social-wrap">
				<div class="secondary-search-wrapper">
					<div id="search-social-container-right" class="search-social-container with-social">
        				<div id="search-container">
            				<?php get_search_form(); ?>
            			</div><!-- #search-container -->
					</div><!-- #search-social-container-right -->
				</div><!-- .secondary-search-wrapper -->

				<?php if ( has_nav_menu( 'social-header' ) ): ?>
					<div id="site-header-social-menu" class="site-secondary-menu">
							<nav id="social-secondary-navigation-top" class="social-navigation displaynone" role="navigation" aria-label="<?php esc_attr_e( 'Header Right Social Links Menu', 'photo-journal' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social-header',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>' . photo_journal_get_svg( array( 'icon' => 'chain' ) ),
									) );
								?>
							</nav><!-- #social-secondary-navigation -->
					</div><!-- #site-header-menu -->
				<?php endif; ?>
				</div> <!-- .search-social-wrap -->
		</div><!-- .site-header-main -->
	</div><!-- .wrapper -->
</div><!-- #header-navigation-area -->
