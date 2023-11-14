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

    const setSubmenuCurrent = (item, item_link) => {
    };

    $(window).load(() => {
        // const admin_nav = $("#toplevel_page_dev-suite > ul.wp-submenu");
        // const admin_nav_items = admin_nav.find("li");
        // const currentHash = window.location.hash;
        // const params = new Proxy(new URLSearchParams(window.location.search), {
        //   get: (searchParams, prop) => searchParams.get(prop),
        // });

        // for (let i = 0; i < admin_nav_items.length; i++) {
        //   let item = admin_nav_items[i];
        //   let item_link = $(item).find("a").attr("href");
        //   let item_link_hash = item_link && item_link.split("#")[1];

        //   $(item).on("click", () => {
        //     for (let j = 0; j < admin_nav_items.length; j++) {
        //       $(admin_nav_items[j]).removeClass("current");
        //     }
        //     $(item).addClass("current");
        //   });

        //   console.log(params)

        //   if (window.location.hash && window.location.hash === item_link_hash) {
        //     $(item).addClass("current");
        //   } else if (!window.location.hash && params.page === item_link_hash) {
        //     $(item).addClass("current");
        //   } else {
        //     $(item).removeClass("current");
        //   }
        // }
        //
        const notices = $('.notice');
        const clones = []
        const dock = $('#notices-dock');
        const dockBody = $('#notices-dock__body');
        const dockToggle = $('#notices-dock__toggle');

        console.log(notices)


        for (let notice of notices) {
            console.log('notice: ', notice);
            dockBody.append($(notice));
            $(notice).addClass('docked');
            // $(notice).clone().appendTo(dockBody);
            // console.log(notice);
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
