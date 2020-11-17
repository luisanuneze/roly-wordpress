<?php
/**
 * Displays header site branding
 *
 * @package JetBlack
 */

// Check metabox option.
$meta_option = get_post_meta( get_the_ID(), 'jetblack-header-image', true );

if ( empty( $meta_option ) ) {
	$meta_option = 'default';
}

// Bail if header image is removed via metabox option.
if ( 'disable' === $meta_option ) {
	return;
}

$jetblack_enable = jetblack_gtm( 'jetblack_header_image_visibility' );

if ( jetblack_display_section( $jetblack_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php jetblack_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
