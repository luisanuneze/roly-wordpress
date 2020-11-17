<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Abletone
 */

if ( ! function_exists( 'abletone_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see abletone_custom_header_setup().
	 */
	function abletone_header_style() {
		$header_image = abletone_featured_overall_image();

	    if ( 'disable' !== $header_image ) : ?>
	        <style type="text/css" rel="header-image">
	            .custom-header .wrapper:before {
	                background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center top;
					background-repeat: no-repeat;
					background-size: cover;
	            }
	        </style>
	    <?php
	    endif;

	    $header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title a,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-title a:hover,
			.site-title a:focus,
			.site-description,
			.main-navigation a,
			.menu-toggle,
			.dropdown-toggle,
			.site-header-cart .cart-contents,
			.site-header-menu .social-navigation a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'abletone_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own abletone_featured_image(), and that function will be used instead.
	 *
	 * @since Abletone 0.1
	 */
	function abletone_featured_image() {
		if ( is_header_video_active() && has_header_video() ) {
			return true;
		}
		
		$thumbnail = 'abletone-slider';

		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$image = wp_get_attachment_image_src( (int) $jetpack_options['featured-image'], $thumbnail );
				return $image['0'];
			} else {
				return false;
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) || is_post_type_archive( 'featured-content' ) || is_post_type_archive( 'ect-service' ) ) {
			$option = '';

			if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
				$option = 'jetpack_portfolio_featured_image';
			} elseif ( is_post_type_archive( 'featured-content' ) ) {
				$option = 'featured_content_featured_image';
			} elseif ( is_post_type_archive( 'ect-service' ) ) {
				$option = 'ect_service_featured_image';
			}

			$featured_image = get_option( $option );

			if ( '' !== $featured_image ) {
				$image = wp_get_attachment_image_src( (int) $featured_image, $thumbnail );
				return $image[0];
			} else {
				return get_header_image();
			}
		} elseif ( is_header_video_active() && has_header_video() ) {
			return true;
		} else {
			return get_header_image();
		}
	} // abletone_featured_image
endif;

if ( ! function_exists( 'abletone_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own abletone_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Abletone 0.1
	 */
	function abletone_featured_page_post_image() {
		$thumbnail = 'abletone-slider';

		if ( is_home() && $blog_id = get_option('page_for_posts') ) {
			if ( has_post_thumbnail( $blog_id  ) ) {
		    	return get_the_post_thumbnail_url( $blog_id, $thumbnail );
			} else {
				return  abletone_featured_image();
			}
		} elseif ( ! has_post_thumbnail() ) {
			return  abletone_featured_image();
		} elseif ( is_home() && is_front_page() ) {
			return  abletone_featured_image();
		}
		return get_the_post_thumbnail_url( get_the_id(), $thumbnail );
	} // abletone_featured_page_post_image
endif;

if ( ! function_exists( 'abletone_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own abletone_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Abletone 0.1
	 */
	function abletone_featured_overall_image() {
		global $post;
		$enable = get_theme_mod( 'abletone_header_media_option', 'homepage' );

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			$abletone_id = $post->ID;

			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $abletone_id, 'abletone-header-image', true );

			if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
				return 'disable' ;
			} elseif ( 'enable' == $individual_featured_image ) {
				return abletone_featured_page_post_image();
			}
		}

		// Check Homepage
		if ( 'homepage' === $enable ) {
			if ( is_front_page() ) {
				return abletone_featured_image();
			}
		} elseif ( 'entire-site' === $enable ) {
			// Check Entire Site
			return abletone_featured_image();
		}
		return 'disable';
	} // abletone_featured_overall_image
endif;

if ( ! function_exists( 'abletone_header_media_text' ) ):
	/**
	 * Display Header Media Text
	 *
	 * @since Abletone 0.1
	 */
	function abletone_header_media_text() {

		if ( ! abletone_has_header_media_text() ) {
			// Bail early if header media text is disabled on front page
			return false;
		}

		$content_alignment = get_theme_mod( 'abletone_header_media_content_alignment', 'content-align-left' );
		$text_alignment = get_theme_mod( 'abletone_header_media_text_alignment', 'text-align-left' );

		$header_media_logo = get_theme_mod( 'abletone_header_media_logo' );
		?>
		<div class="custom-header-content sections header-media-section <?php echo esc_attr( $content_alignment ); ?> <?php echo esc_attr( $text_alignment ); ?>">
			<div class="custom-header-content-wrapper">
				<?php
				$enable_homepage_logo = get_theme_mod( 'abletone_header_media_logo_option', 'homepage' );
				if ( abletone_check_section( $enable_homepage_logo ) && $header_media_logo ) {  ?>
					<div class="site-header-logo">
						<img src="<?php echo esc_url( $header_media_logo ); ?>" title="<?php echo esc_url( home_url( '/' ) ); ?>" />
					</div><!-- .site-header-logo -->
				<?php } ?>

				<?php
				$before = '<div class="section-title-wrapper"><h2 class="entry-title';

				if ( is_singular() ) {
					$before = '<div class="section-title-wrapper"><h1 class="entry-title';
				}
 
				if ( ! is_page() ) {
					$before .= ' section-title';
				}

				$before .= '">';

				if ( is_singular() ) {
					abletone_header_title( $before, '</h1></div>' );
				} else {
					abletone_header_title( $before, '</h2></div>' );
				}
				?>

				<?php abletone_header_description( '<div class="site-header-text">', '</div>' ); ?>

				<?php if ( is_front_page() ) :
					$header_media_url      = get_theme_mod( 'abletone_header_media_url', '#' );
					$header_media_url_text = get_theme_mod( 'abletone_header_media_url_text' );
				?>

					<?php if ( $header_media_url_text ) : ?>
							<a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'abletone_header_url_target' ) ) ? '_blank' : '_self'; ?>" class="more-link"><?php echo esc_html( $header_media_url_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_url_text ); ?></span></a>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .custom-header-content-wrapper -->
		</div><!-- .custom-header-content -->
		<?php
	} // abletone_header_media_text.
endif;

if ( ! function_exists( 'abletone_has_header_media_text' ) ):
	/**
	 * Return Header Media Text fro front page
	 *
	 * @since Abletone 0.1
	 */
	function abletone_has_header_media_text() {
		$header_image = abletone_featured_overall_image();

		if ( is_front_page() ) {
			$header_media_logo     = get_theme_mod( 'abletone_header_media_logo' );
			$header_media_title    = get_theme_mod( 'abletone_header_media_title' );
			$header_media_text     = get_theme_mod( 'abletone_header_media_text' );
			$header_media_url      = get_theme_mod( 'abletone_header_media_url', '#' );
			$header_media_url_text = get_theme_mod( 'abletone_header_media_url_text' );

			if ( ! $header_media_logo && ! $header_media_title && ! $header_media_text && ! $header_media_url && ! $header_media_url_text ) {
				// Bail early if header media text is disabled
				return false;
			}
		} elseif ( 'disable' === $header_image ) {
			return false;
		}

		return true;
	} // abletone_has_header_media_text.
endif;

if ( ! function_exists( 'abletone_header_title' ) ) :
	/**
	 * Display header media text
	 */
	function abletone_header_title( $before = '', $after = '' ) {
		if ( is_front_page() ) {
			$header_media_title = get_theme_mod( 'abletone_header_media_title' );
			if ( $header_media_title ) {
				echo $before . wp_kses_post( $header_media_title ) . $after;
			}
		} else if ( is_home() ) {
			$header_media_title = get_theme_mod( 'abletone_static_page_heading','Archives' );
			if ( $header_media_title ) {
				echo $before . wp_kses_post( $header_media_title ) . $after;
			}
		} elseif ( is_singular() ) {
			the_title( $before, $after );
		} elseif ( is_404() ) {
			echo $before . esc_html__( 'Nothing Found', 'abletone' ) . $after;
		} elseif ( is_search() ) {
			/* translators: %s: search query. */
			echo $before . sprintf( esc_html__( 'Search Results for: %s', 'abletone' ), '<span>' . get_search_query() . '</span>' ) . $after;
		} else {
			the_archive_title( $before, $after );
		}
	}
endif;

if ( ! function_exists( 'abletone_header_description' ) ) :
	/**
	 * Display header media description
	 */
	function abletone_header_description( $before = '', $after = '' ) {
		if ( is_front_page() ) {
			echo $before . '<p>' . wp_kses_post( get_theme_mod( 'abletone_header_media_text' ) ) . '</p>' . $after;
		} elseif ( is_singular() && ! is_page() ) {
			echo $before . '<div class="entry-header"><div class="entry-meta">';
				abletone_posted_on();
			echo '</div><!-- .entry-meta --></div>' . $after;
		} elseif ( is_404() ) {
			echo $before . '<p>' . esc_html__( 'Oops! That page can&rsquo;t be found', 'abletone' ) . '</p>' . $after;
		} else {
			the_archive_description( $before, $after );
		}
	}
endif;
