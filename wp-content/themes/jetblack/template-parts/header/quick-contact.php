<?php
/**
 * Header Search
 *
 * @package JetBlack
 */

$jetblack_phone      = jetblack_gtm( 'jetblack_header_phone' );
$jetblack_email      = jetblack_gtm( 'jetblack_header_email' );
$jetblack_address    = jetblack_gtm( 'jetblack_header_address' );
$jetblack_open_hours = jetblack_gtm( 'jetblack_header_open_hours' );

if ( $jetblack_phone || $jetblack_email || $jetblack_address || $jetblack_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $jetblack_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'jetblack' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $jetblack_phone ) ); ?>"><?php echo esc_html( $jetblack_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $jetblack_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'jetblack' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $jetblack_email ) ) ); ?>"><?php echo esc_html( antispambot( $jetblack_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $jetblack_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'jetblack' ); ?></span><?php echo esc_html( $jetblack_address ); ?></li>
			<?php endif; ?>

			<?php if ( $jetblack_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'jetblack' ); ?></span><?php echo esc_html( $jetblack_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

