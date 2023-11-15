(function ($) {
    "use strict";

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(window).load(() => {
        const notices = $('.notice');
        const clones = []
        const dock = $('#notices-dock');
        const dockBody = $('#notices-dock__body');
        const dockToggle = $('#notices-dock__toggle');

        $(document).on('DOMNodeInserted', '.notice', (e) => {
            console.log('notice inserted: ', e.target);
            const notice = $(e.target);
            dockBody.append(notice);
            notice.addClass('docked');
        });


        for (let notice of notices) {
            console.log('notice: ', notice);
            dockBody.append($(notice));
            $(notice).addClass('docked');
        }

        const handleDockOpen = () => {
            if (dock.hasClass('active')) {
                dock.removeClass('active');
            } else {
                dock.addClass('active');
            }

        }

        dockToggle.on('click', () => {
            handleDockOpen();
        });
    });

    console.log("dev-suite-admin.js loaded");
})(jQuery);
