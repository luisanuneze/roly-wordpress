/* global jQuery, photoJournalCustomizerReset, ajaxurl, wp */

jQuery(function ($) {

    var sections = [
        [ '#customize-theme-controls', 'all', 'ct-reset', 'ct-reset-main', photoJournalCustomizerReset.confirm, photoJournalCustomizerReset.reset ] // Reset sections sorter.
    ];

    $.each( sections, function( key, value ) {
        var $container = $(value[0]);

        var $button = $('<input type="submit" name="' + value[2] + '" id="' + value[2] + '" class="ct-reset ' + value[3] + ' button-secondary button">')
        .attr('value', value[5]);

        $button.on('click', function (event) {
            event.preventDefault();

            var data = {
                wp_customize: 'on',
                action: 'customizer_reset',
                nonce: photoJournalCustomizerReset.nonce.reset,
                section: value[1]
            };

            var r = confirm(value[4]);

            if (!r) return;

            $(".spinner").css('visibility', 'visible');

            $button.attr('disabled', 'disabled');

            $.post(ajaxurl, data, function () {
                wp.customize.state('saved').set(true);
                location.reload();
            });
        });

        $container.after($button);
    });
});
