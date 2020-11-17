/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var style = $( '#photo-journal-color-scheme-css' ),
		api = wp.customize;

	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="photo-journal-color-scheme-css" />' )
		                    .find( '#photo-journal-color-scheme-css' );
	}

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		});
	});

	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Add custom-background-image body class when background image is added.
	api( 'background_image', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		});
	});

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		});
	});

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-identity' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$( '.site-identity' ).css( {
					'clip': 'auto',
					'position': 'relative'
				});
				$( '.site-title a, .site-description' ).css( {
					'color': to
				});
			}
		});
	});

	// Header text color.
	api( 'color_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'color-scheme-default color-scheme-dark color-scheme-gray color-scheme-red color-scheme-yellow' );
			$( 'body' ).addClass( 'color-scheme-' + to );
		});
	});

	// Add layout class to body.
	api( 'photo_journal_layout_type', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'boxed-layout' );
			$( 'body' ).removeClass( 'fixed-layout' );
			$( 'body' ).addClass( to + '-layout' );
			if ( 'fluid' === to ) {
				$( 'body #page' ).css( 'background-color', 'transparent' );
			} else {
				$( 'body #page' ).removeAttr('style');
			}
		} );
	} );
})( jQuery );
