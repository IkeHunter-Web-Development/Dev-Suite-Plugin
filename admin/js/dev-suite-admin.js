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

    const waitForElement = (selector) => {
        return new Promise((resolve, reject) => {
            const element = $(selector);
            if (element.length) {
                resolve(element);
                return;
            }

            const observer = new MutationObserver((mutations) => {
                const element = $(selector);
                if (element.length) {
                    resolve(element);
                    observer.disconnect();
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true,
            });
        });
    }


    const onElementLoad = (selector, callback) => {
        const observer = new MutationObserver((mutations) => {
            const element = $(selector);
            if (element.length) {
                callback(element);
                // observer.disconnect();
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
        });
    }


    $(window).load(async () => {
        const dock = await waitForElement('#notices-dock');
        const dockBody = await waitForElement('#notices-dock__body');
        const dockToggle = await waitForElement('#notices-dock__toggle');

        onElementLoad('.notice', (notice) => {
            if (notice.hasClass('docked')) return;

            dockBody.append(notice);
            notice.addClass('docked');
        });

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
