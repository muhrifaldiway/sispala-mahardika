(function () {

    "use strict";


    /* ============================================================
       ADMIN SIDEBAR
    ============================================================ */

    document.addEventListener("DOMContentLoaded", function () {

        const body = document.body;

        const toggle =
            document.getElementById("sidebarToggle");

        const overlay =
            document.getElementById("sidebarOverlay");


        /*
        |--------------------------------------------------------------------------
        | Restore sidebar state
        |--------------------------------------------------------------------------
        */

        const sidebarState =
            localStorage.getItem("sispala_sidebar");


        if (
            window.innerWidth >= 992 &&
            sidebarState === "collapsed"
        ) {

            body.classList.add(
                "sidebar-collapsed"
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Toggle sidebar
        |--------------------------------------------------------------------------
        */

        if (toggle) {

            toggle.addEventListener(
                "click",
                function () {


                    /*
                    | Mobile
                    */

                    if (window.innerWidth < 992) {

                        body.classList.toggle(
                            "sidebar-mobile-open"
                        );

                        return;

                    }


                    /*
                    | Desktop
                    */

                    body.classList.toggle(
                        "sidebar-collapsed"
                    );


                    /*
                    | Save state
                    */

                    if (
                        body.classList.contains(
                            "sidebar-collapsed"
                        )
                    ) {

                        localStorage.setItem(
                            "sispala_sidebar",
                            "collapsed"
                        );

                    } else {

                        localStorage.setItem(
                            "sispala_sidebar",
                            "expanded"
                        );

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Mobile overlay
        |--------------------------------------------------------------------------
        */

        if (overlay) {

            overlay.addEventListener(
                "click",
                function () {

                    body.classList.remove(
                        "sidebar-mobile-open"
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Resize
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            "resize",
            function () {

                if (window.innerWidth >= 992) {

                    body.classList.remove(
                        "sidebar-mobile-open"
                    );

                }

            }
        );

    });


    /* ============================================================
       FRONTEND / PUBLIC WEBSITE
       Fitur lama menggunakan jQuery.
       Jalankan hanya jika jQuery tersedia.
    ============================================================ */

    function initFrontendPlugins() {


        /*
        |--------------------------------------------------------------------------
        | Cek jQuery
        |--------------------------------------------------------------------------
        */

        if (typeof window.jQuery === "undefined") {

            console.log(
                "SISPALA: jQuery tidak tersedia. Fitur frontend jQuery dilewati."
            );

            return;

        }


        const $ = window.jQuery;


        /* ========================================================
           SPINNER
        ======================================================== */

        const spinner = function () {

            setTimeout(function () {

                if ($("#spinner").length > 0) {

                    $("#spinner").removeClass("show");

                }

            }, 1);

        };

        spinner();


        /* ========================================================
           WOW JS
        ======================================================== */

        if (typeof window.WOW !== "undefined") {

            new WOW().init();

        }


        /* ========================================================
           FIXED NAVBAR
        ======================================================== */

        $(window).on("scroll", function () {

            if ($(window).width() < 992) {

                if ($(this).scrollTop() > 45) {

                    $(".fixed-top")
                        .addClass("bg-dark shadow");

                } else {

                    $(".fixed-top")
                        .removeClass("bg-dark shadow");

                }

            } else {

                if ($(this).scrollTop() > 45) {

                    $(".fixed-top")
                        .addClass("bg-dark shadow")
                        .css("top", -45);

                } else {

                    $(".fixed-top")
                        .removeClass("bg-dark shadow")
                        .css("top", 0);

                }

            }

        });


        /* ========================================================
           BACK TO TOP
        ======================================================== */

        $(window).on("scroll", function () {

            if ($(this).scrollTop() > 300) {

                $(".back-to-top").fadeIn("slow");

            } else {

                $(".back-to-top").fadeOut("slow");

            }

        });


        $(".back-to-top").on(
            "click",
            function (e) {

                e.preventDefault();


                /*
                | Jika easing plugin tersedia
                */

                if ($.easing && $.easing.easeInOutExpo) {

                    $("html, body").animate(
                        {
                            scrollTop: 0
                        },
                        1500,
                        "easeInOutExpo"
                    );

                } else {

                    $("html, body").animate(
                        {
                            scrollTop: 0
                        },
                        800
                    );

                }

            }
        );


        /* ========================================================
           CAUSES PROGRESS
        ======================================================== */

        if (
            typeof $.fn.waypoint !== "undefined"
        ) {

            $(".causes-progress").waypoint(
                function () {

                    $(".progress .progress-bar")
                        .each(function () {

                            $(this).css(
                                "width",
                                $(this).attr(
                                    "aria-valuenow"
                                ) + "%"
                            );

                        });

                },
                {
                    offset: "80%"
                }
            );

        }


        /* ========================================================
           TESTIMONIAL CAROUSEL
        ======================================================== */

        if (
            typeof $.fn.owlCarousel !== "undefined"
        ) {

            $(".testimonial-carousel").owlCarousel({

                autoplay: false,

                smartSpeed: 1000,

                center: true,

                dots: false,

                loop: true,

                nav: true,

                navText: [

                    '<i class="bi bi-arrow-left"></i>',

                    '<i class="bi bi-arrow-right"></i>'

                ],

                responsive: {

                    0: {
                        items: 1
                    },

                    768: {
                        items: 2
                    }

                }

            });

        }

    }


    /* ============================================================
       INIT FRONTEND
    ============================================================ */

    if (
        document.readyState === "loading"
    ) {

        document.addEventListener(
            "DOMContentLoaded",
            initFrontendPlugins
        );

    } else {

        initFrontendPlugins();

    }


})();