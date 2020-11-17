<?php
/**
 * Header Social
 *
 * @package JetBlack
 */
?>

<?php if ( has_nav_menu( 'social' ) ) : ?>
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
<?php endif; ?>
