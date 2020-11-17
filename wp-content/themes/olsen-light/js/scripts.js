jQuery(function( $ ) {
	'use strict';

	var $body = $( 'body' );
	var isRTL = $body.hasClass('rtl');

	/* -----------------------------------------
	Responsive Menus
	----------------------------------------- */
	var $topNav           = $('.top-bar .navigation');
	var $mobileWPMenu     = $('#masthead .mobile-navigation');
	var $mainNav          = $mobileWPMenu.length ? $mobileWPMenu : $('#masthead .navigation');
	var $mobileNav        = $( '.navigation-mobile-wrap' );
	var $mobileNavTrigger = $('.mobile-nav-trigger');
	var $mobileNavDismiss = $('.navigation-mobile-dismiss');

	$mainNav.each( function () {
		var $this = $( this );
		$this.clone()
			.find('> li')
			.removeAttr( 'id' )
			.appendTo( $mobileNav.find( '.navigation-mobile' ) );
	} );

	$mobileNav.find( 'li' )
		.each(function () {
			var $this = $(this);
			$this.removeAttr( 'id' );

			if ( $this.find('.sub-menu').length > 0 ) {
				var $button = $( '<button />', {
					class: 'menu-item-sub-menu-toggle',
				} );

				$this.find('> a').after( $button );
			}
		});

	$mobileNav.find('.menu-item-sub-menu-toggle').on( 'click', function ( event ) {
		event.preventDefault();
		var $this = $(this);
		$this.parent().toggleClass('menu-item-expanded')
	} );

	$mobileNavTrigger.on( 'click', function ( event ) {
		event.preventDefault();
		$body.addClass('mobile-nav-open');
		$mobileNavDismiss.focus();
	} );

	$mobileNavDismiss.on( 'click', function ( event ) {
		event.preventDefault();
		$body.removeClass('mobile-nav-open');
		$mobileNavTrigger.focus();
	} );

	/* -----------------------------------------
	Main Navigation Init
	----------------------------------------- */
	$mainNav.add($topNav).superfish({
		delay: 300,
		animation: { opacity: 'show', height: 'show' },
		speed: 'fast',
		dropShadows: false
	});


	/* -----------------------------------------
	Image Lightbox
	----------------------------------------- */
	$( ".ci-lightbox, a[data-lightbox^='gal']" ).magnificPopup({
		type: 'image',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true
		}
	} );

	/* -----------------------------------------
	Instagram Widget
	----------------------------------------- */
	var $instagramWrap = $('.footer-widget-area');
	var $instagramWidget = $instagramWrap.find('.zoom-instagram-widget__items');

	if ( $instagramWidget.length ) {
		var auto  = $instagramWrap.data('auto'),
			speed = $instagramWrap.data('speed');

		$instagramWidget.slick({
			slidesToShow: 8,
			slidesToScroll: 3,
			arrows: false,
			autoplay: auto == 1,
			speed: speed,
			rtl: isRTL,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 4
					}
				}
			]
		});
	}

	/* -----------------------------------------
	Main Carousel
	----------------------------------------- */
	var homeSlider = $( '.home-slider' );

	if ( homeSlider.length ) {
		var autoplay = homeSlider.data( 'autoplay' ),
			autoplayspeed = homeSlider.data( 'autoplayspeed' ),
			fade = homeSlider.data( 'fade' );

		homeSlider.slick({
			autoplay: autoplay == 1,
			autoplaySpeed: autoplayspeed,
			fade: fade == 1,
			rtl: isRTL,
		});
	}
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
