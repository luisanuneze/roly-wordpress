/* global photoJournalScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {

    if ( $.isFunction( $.fn.masonry ) ) {
        /*
         * Masonry
         */
        //Masonry blocks
        $blocks = $('.grid');

        $blocks.imagesLoaded(function(){
            $blocks.masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-item',
                // slow transitions
                transitionDuration: '1s'
            });

            // Fade blocks in after images are ready (prevents jumping and re-rendering)
            $('.grid-item').fadeIn();

            $blocks.find( '.grid-item' ).animate( {
                'opacity' : 1
            } );
        });

        $( function() {
            setTimeout( function() { $blocks.masonry(); }, 2000);
        });

        $(window).resize(function () {
            $blocks.masonry();
        });
    }

    // Countdown Init.
    if ( jQuery.isFunction( jQuery.fn.final_countdown ) ) {
        $('.countdown').final_countdown();
    }

    //FitVids Initialize
    if ( jQuery.isFunction( jQuery.fn.fitVids ) ) {
        jQuery('.hentry, .widget').fitVids();
    }

    // Add header video class after the video is loaded.
    $( document ).on( 'wp-custom-header-video-loaded', function() {
        $( 'body' ).addClass( 'has-header-video' );
    });

    /**
     * Functionality for scroll to top button
     */
    $( function() {
        $(window).scroll( function () {
            if ( $( this ).scrollTop() > 100 ) {
                $( '#scrollup' ).addClass('scroll-on');
            } else {
                $("#scrollup").removeClass('scroll-on');
            }
        });

        $( '#scrollup' ).on( 'click', function () {
            $( 'body, html' ).animate({
                scrollTop: 0
            }, 500 );
            return false;
        });

        //Light Box for videos section
        if ( jQuery.isFunction( jQuery.fn.flashy ) ) {
            $('.mixed').flashy({
                gallery: false,
            });
        }
    });

    /*
     * Test if inline SVGs are supported.
     * @link https://github.com/Modernizr/Modernizr/
     */
    function supportsInlineSVG() {
        var div = document.createElement( 'div' );
        div.innerHTML = '<svg/>';
        return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
    }

    $( function() {
        $( document ).ready( function() {
            if ( true === supportsInlineSVG() ) {
                document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
            }
        });
    });


    var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

    function initMainNavigation( container ) {

        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
            .append( photoJournalScreenReaderText.icon )
            .append( $( '<span />', { 'class': 'screen-reader-text', text: photoJournalScreenReaderText.expand }) );

        container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

        // Set the active submenu dropdown toggle button initial state.
        container.find( '.current-menu-ancestor > button' )
            .addClass( 'toggled-on' )
            .attr( 'aria-expanded', 'true' )
            .find( '.screen-reader-text' )
            .text( photoJournalScreenReaderText.collapse );
        // Set the active submenu initial state.
        container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        // Add menu items with submenus to aria-haspopup="true".
        container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

        container.find( '.dropdown-toggle' ).click( function( e ) {
            var _this            = $( this ),
                screenReaderSpan = _this.find( '.screen-reader-text' );

            e.preventDefault();
            _this.toggleClass( 'toggled-on' );
            _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

            // jscs:disable
            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
            screenReaderSpan.text( screenReaderSpan.text() === photoJournalScreenReaderText.expand ? photoJournalScreenReaderText.collapse : photoJournalScreenReaderText.expand );
        } );
    }

    masthead         = $( '#header-navigation-area' );
    menuToggle       = masthead.find( '#primary-menu-toggle' );
    siteHeaderMenu   = masthead.find( '#site-header-menu' );
    siteNavigation   = masthead.find( '.site-navigation' );
    socialNavigation = masthead.find( '#search-social-container' );
    initMainNavigation( siteNavigation );

    // Enable menuToggle.
    ( function() {

        // Return early if menuToggle is missing.
        if ( ! menuToggle.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );

        menuToggle.on( 'click.photoJournal', function() {
            $( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 1024 ) {
                $( document.body ).on( 'touchstart.photoJournal', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.photoJournal', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.photoJournal' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize.photoJournal', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus.photoJournal blur.photoJournal', function() {
            $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
        } );
    } )();

    //For Secondary Menu
    menuToggleSecondary     = $( '#menu-toggle-secondary' ); // button id
    siteSecondaryMenu       = $( '#site-header-menu' ); // wrapper id
    siteNavigationSecondary = $( '#site-secondary-navigation' ); // nav id
    initMainNavigation( siteNavigationSecondary );

    // Enable menuToggleSecondary.
    ( function() {
        // Return early if menuToggleSecondary is missing.
        if ( ! menuToggleSecondary.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleSecondary.add( siteNavigationSecondary ).attr( 'aria-expanded', 'false' );

        menuToggleSecondary.on( 'click', function() {
            $( this ).add( siteSecondaryMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded', $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationSecondary.length || ! siteNavigationSecondary.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 1024 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationSecondary.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Secondary Menu End

    //For Header Top Menu
    menuToggleTop    = $( '#menu-toggle-top' ); // button id
    siteTopMenu       = $( '#site-header-top-menu' ); // wrapper id
    siteNavigationTop = $( '#site-top-navigation' ); // nav id
    initMainNavigation( siteNavigationTop );

    // Enable menuToggleTop.
    ( function() {
        // Return early if menuToggleTop is missing.
        if ( ! menuToggleTop.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleTop.add( siteNavigationTop ).attr( 'aria-expanded', 'false' );

        menuToggleTop.on( 'click', function() {
            $( this ).add( siteTopMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationTop ).attr( 'aria-expanded', $( this ).add( siteNavigationTop ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationTop.length || ! siteNavigationTop.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 1024 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationTop.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationTop.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationTop.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Header Top Menu End

    //For Footer Menu
    menuToggleFooter       = $( '#menu-toggle-footer' ); // button id
    siteFooterMenu         = $( '#site-footer-navigation' ); // wrapper id
    siteNavigationFooter   = $( '#site-footer-navigation' ); // nav id
    initMainNavigation( siteNavigationFooter );

    // Enable menuToggleFooter.
    ( function() {
        // Return early if menuToggleFooter is missing.
        if ( ! menuToggleFooter.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleFooter.add( siteNavigationFooter ).attr( 'aria-expanded', 'false' );

        menuToggleFooter.on( 'click', function() {
            $( this ).add( siteFooterMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationFooter ).attr( 'aria-expanded', $( this ).add( siteNavigationFooter ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();
    //Footer Menu End

    // Add the default ARIA attributes for the menu toggle and the navigations.
    function onResizeARIA() {
        if ( window.innerWidth < 1024 ) {
            if ( menuToggle.hasClass( 'toggled-on' ) ) {
                menuToggle.attr( 'aria-expanded', 'true' );
            } else {
                menuToggle.attr( 'aria-expanded', 'false' );
            }

            if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
                siteNavigation.attr( 'aria-expanded', 'true' );
                socialNavigation.attr( 'aria-expanded', 'true' );
            } else {
                siteNavigation.attr( 'aria-expanded', 'false' );
                socialNavigation.attr( 'aria-expanded', 'false' );
            }

            if ( siteSecondaryMenu.hasClass( 'toggled-on' ) ) {
                siteNavigationSecondary.attr( 'aria-expanded', 'true' );
            } else {
                siteNavigationSecondary.attr( 'aria-expanded', 'false' );
            }

            if ( siteTopMenu.hasClass( 'toggled-on' ) ) {
                siteNavigationTop.attr( 'aria-expanded', 'true' );
            } else {
                siteNavigationTop.attr( 'aria-expanded', 'false' );
            }

            if ( siteFooterMenu.hasClass( 'toggled-on' ) ) {
                siteNavigationFooter.attr( 'aria-expanded', 'true' );
            } else {
                siteNavigationFooter.attr( 'aria-expanded', 'false' );
            }


            menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
        } else {
            menuToggle.removeAttr( 'aria-expanded' );
            siteNavigation.removeAttr( 'aria-expanded' );
            socialNavigation.removeAttr( 'aria-expanded' );
            siteNavigationSecondary.removeAttr( 'aria-expanded' );
            siteNavigationTop.removeAttr( 'aria-expanded' );
            siteNavigationFooter.removeAttr( 'aria-expanded' );
            menuToggle.removeAttr( 'aria-controls' );
        }
    }

    //Search Toggle
    $( '.search-toggle' ).on( 'click', function() {

        $(this).toggleClass('toggled-on');

        var jQuerythis_el_search = $(this),
            jQueryform_search = jQuerythis_el_search.siblings( '.search-social-container' );

        if ( jQueryform_search.hasClass( 'displaynone' ) ) {
            jQueryform_search.removeClass( 'displaynone' ).addClass( 'displayblock' );
        } else {
            jQueryform_search.removeClass( 'displayblock' ).addClass( 'displaynone' );
        }
    });

    /*Click and scrolldown from silder image*/
    $('body').on('click touch','.scroll-down', function(e){
        var Sclass = $(this).parents('.section, .header-media').next().attr('class');
        var Sclass_array = Sclass.split(" ");
        var scrollto = $('.' + Sclass_array[0] ).offset().top;
        $('html, body').animate({
            scrollTop: scrollto
        }, 1000);
    });

    $(function(){
        if( document.getElementById("firefly") ) {
            $.firefly({
                color: '#fff',
                ofTop: 0,
                ofLeft: 0,
                minPixel: 1,
                maxPixel: 3,
                total : 25,
                on: '#firefly',
                zIndex: Math.ceil(Math.random() * 20) - 1,
                borderRadius: '50%',
                borderRadius: 50
            });
        }
    });
})( jQuery );
