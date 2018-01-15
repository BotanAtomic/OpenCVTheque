(function ($) {
    "use strict";

    function ieViewportFix() {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(document.createTextNode("@-ms-viewport { width: device-width; }"));
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            msViewportStyle.appendChild(document.createTextNode("@-ms-viewport { width: auto !important; }"))
        }
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
    }

    function exists(e) {
        return $(e).length > 0
    }

    function isTouchDevice() {
        return !!('ontouchstart' in window) || (!!('onmsgesturechange' in window) && !!window.navigator.maxTouchPoints)
    }

    function setDimensionsPieCharts() {
        $(".pie-chart").each(function () {
            var $t = $(this);
            var n = $t.parent().width();
            var r = $t.attr("data-barSize");
            if (n < r) {
                r = n
            }
            $t.css("height", r);
            $t.css("width", r);
            $t.css("line-height", r + "px");
            $t.find("i").css({"line-height": r + "px", "font-size": r / 3})
        })
    }

    function animatePieCharts() {
        if (typeof $.fn.easyPieChart != 'undefined') {
            $(".pie-chart:in-viewport").each(function () {
                var $t = $(this);
                var n = $t.parent().width();
                var r = $t.attr("data-barSize");
                if (n < r) {
                    r = n
                }
                $t.easyPieChart({
                    animate: 1300,
                    lineCap: "square",
                    lineWidth: $t.attr("data-lineWidth"),
                    size: r,
                    barColor: $t.attr("data-barColor"),
                    trackColor: $t.attr("data-trackColor"),
                    scaleColor: "transparent",
                    onStep: function (from, to, percent) {
                        $(this.el).find('.pie-chart-percent span').text(Math.round(percent))
                    }
                })
            })
        }
    }

    function animateMilestones() {
        $(".milestone:in-viewport").each(function () {
            var $t = $(this);
            var n = $t.find(".milestone-value").attr("data-stop");
            var r = parseInt($t.find(".milestone-value").attr("data-speed"));
            if (!$t.hasClass("already-animated")) {
                $t.addClass("already-animated");
                $({countNum: $t.find(".milestone-value").text()}).animate({countNum: n}, {
                    duration: r,
                    easing: "linear",
                    step: function () {
                        $t.find(".milestone-value").text(Math.floor(this.countNum))
                    },
                    complete: function () {
                        $t.find(".milestone-value").text(this.countNum)
                    }
                })
            }
        })
    }

    function animateProgressBars() {
        $(".progress-bar .progress-bar-outer:in-viewport").each(function () {
            var $t = $(this);
            if (!$t.hasClass("already-animated")) {
                $t.addClass("already-animated");
                $t.animate({width: $t.attr("data-width") + "%"}, 2000)
            }
        })
    }

    function enableParallax() {
        if (typeof $.fn.parallax != 'undefined') {
            $('.parallax').each(function () {
                var $t = $(this);
                $t.addClass("parallax-enabled");
                $t.parallax("49%", 0.3, false)
            })
        }
    }

    function handleContactForm() {
        if (typeof $.fn.validate != 'undefined') {
            $('#contact-form').validate({
                errorClass: 'validation-error',
                rules: {
                    name: {required: true},
                    email: {required: true, email: true},
                    subject: {required: true},
                    message: {required: true}
                },
                messages: {
                    name: {required: "Field is required!"},
                    email: {required: "Field is required!", email: "Please enter a valid email address"},
                    subject: {required: "Field is required!"},
                    message: {required: "Field is required!"}
                },
                submitHandler: function (form) {
                    var result;
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: "_layout/php/send.php",
                        success: function (msg) {
                            if (msg == 'OK') {
                                result = '<div class="alert success"><i class="fa fa-check-circle-o"></i>The message has been sent!</div>';
                                $('#contact-form').clearForm()
                            } else {
                                result = '<div class="alert error"><i class="fa fa-times-circle"></i>' + msg + '</div>'
                            }
                            $("#formstatus").html(result)
                        },
                        error: function () {
                            result = '<div class="alert error"><i class="fa fa-times-circle"></i>There was an error sending the message!</div>';
                            $("#formstatus").html(result)
                        }
                    })
                }
            })
        }
    }

    var MOBILEBREAKPOINT = 979;

    function handleMobileMenu() {
        if ($(window).width() > MOBILEBREAKPOINT) {
            $("#mobile-menu").hide();
            $("#mobile-menu-trigger").removeClass("mobile-menu-opened").addClass("mobile-menu-closed")
        } else {
            if (!exists("#mobile-menu")) {
                $("#menu").clone().attr({id: "mobile-menu", "class": "fixed"}).insertAfter("#nav");
                $("#mobile-menu > li > a, #mobile-menu > li > ul > li > a").each(function () {
                    var $t = $(this);
                    if ($t.next().hasClass('sub-menu') || $t.next().is('ul')) {
                        $t.append('<span class="fa fa-angle-down mobile-menu-submenu-arrow mobile-menu-submenu-closed"></span>')
                    }
                });
                $(".mobile-menu-submenu-arrow").click(function (event) {
                    var $t = $(this);
                    if ($t.hasClass("mobile-menu-submenu-closed")) {
                        $t.parent().siblings("ul").slideDown(300);
                        $t.removeClass("mobile-menu-submenu-closed fa-angle-down").addClass("mobile-menu-submenu-opened fa-angle-up")
                    } else {
                        $t.parent().siblings("ul").slideUp(300);
                        $t.removeClass("mobile-menu-submenu-opened fa-angle-up").addClass("mobile-menu-submenu-closed fa-angle-down")
                    }
                    event.preventDefault()
                });
                $("#mobile-menu li, #mobile-menu li a, #mobile-menu ul").attr("style", "")
            }
        }
    }

    function showHideMobileMenu() {
        $("#mobile-menu-trigger").click(function (event) {
            var $t = $(this);
            var $n = $("#mobile-menu");
            if ($t.hasClass("mobile-menu-opened")) {
                $t.removeClass("mobile-menu-opened").addClass("mobile-menu-closed");
                $n.slideUp(300)
            } else {
                $t.removeClass("mobile-menu-closed").addClass("mobile-menu-opened");
                $n.slideDown(300)
            }
            event.preventDefault()
        })
    }

    function handleAccordionsAndToogles() {
        $('.accordion a.accordion-item-toggle').click(function (e) {
            var dropDown = $(this).closest('.accordion-item').find('.accordion-item-content');
            $(this).closest('.accordion').find('.accordion-item-content').not(dropDown).slideUp();
            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
            } else {
                $(this).closest('.accordion').find('.accordion-item-toggle.active').removeClass('active');
                $(this).addClass('active')
            }
            dropDown.stop(false, true).slideToggle();
            e.preventDefault()
        });
        $('.toggle a.toggle-item-toggle').click(function (e) {
            var dropDown = $(this).closest('.toggle-item').find('.toggle-item-content');
            if ($(this).hasClass('active')) {
                $(this).removeClass('active')
            } else {
                $(this).addClass('active')
            }
            dropDown.stop(false, true).slideToggle();
            e.preventDefault()
        })
    }

    function handleBackToTop() {
        $('#back-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 'slow');
            return false
        })
    }

    function showHidebackToTop() {
        if ($(window).scrollTop() > $(window).height() / 2) {
            $("#back-to-top").removeClass('gone');
            $("#back-to-top").addClass('visible')
        } else {
            $("#back-to-top").removeClass('visible');
            $("#back-to-top").addClass('gone')
        }
    }

    function handlePageLoader() {
        $(".loader-img").delay(500).fadeOut();
        $("#pageloader").delay(1000).fadeOut("slow")
    }

    function handleFullScreenDiv() {
        var x = $(window).height();
        $('.full-screen').css("min-height", x + "px")
    }

    function handleSmoothScrolling() {
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({scrollTop: target.offset().top}, 700);
                    return false
                }
            }
        })
    }

    $(document).ready(function () {
        ieViewportFix();
        setDimensionsPieCharts();
        animatePieCharts();
        animateMilestones();
        animateProgressBars();
        if (!isTouchDevice()) {
            enableParallax()
        }
        handleContactForm();
        handleMobileMenu();
        showHideMobileMenu();
        handleAccordionsAndToogles();
        handleBackToTop();
        showHidebackToTop();
        handleFullScreenDiv();
        handleSmoothScrolling();
        var stickyHeader = true;
        if ((typeof $.fn.waypoint != 'undefined') && stickyHeader && ($(window).width() > 1024)) {
            $('#nav').waypoint('sticky', {wrapper: '<div class="sticky-wrapper" />', stuckClass: 'stuck'})
        }
        if (typeof $.fn.simplePlaceholder != 'undefined') {
            $('input[placeholder], textarea[placeholder]').simplePlaceholder()
        }
        if (typeof $.fn.fitVids != 'undefined') {
            $('.fitvids').fitVids()
        }
        if (typeof $.fn.superfish != 'undefined') {
            $('#menu').superfish({
                delay: 100,
                animation: {opacity: 'show', height: 'show'},
                speed: 100,
                cssArrows: false
            })
        }
        if (typeof $.fn.bxSlider != 'undefined') {
            $('.references-slider .slides').bxSlider({
                mode: 'fade',
                speed: 500,
                infiniteLoop: true,
                hideControlOnEnd: false,
                pager: true,
                pagerType: 'full',
                controls: true,
                auto: true,
                pause: 4000,
                autoHover: true,
                useCSS: false
            })
        }
        if (typeof $.fn.scrollspy != 'undefined') {
            $('body').scrollspy({offset: 50})
        }
        if (typeof $.fn.magnificPopup != 'undefined') {
            $('.magnificPopup').magnificPopup({disableOn: 400, closeOnContentClick: true, type: 'image'});
            $('.magnificPopup-gallery').magnificPopup({disableOn: 400, type: 'image', gallery: {enabled: true}});
            $('.ajax-popup-link').magnificPopup({
                type: 'ajax',
                closeOnContentClick: false,
                closeOnBgClick: false,
                gallery: {enabled: true},
                callbacks: {
                    ajaxContentAdded: function () {
                        $('.portfolio-slider .slides').bxSlider({
                            mode: 'horizontal',
                            speed: 500,
                            infiniteLoop: true,
                            hideControlOnEnd: false,
                            pager: true,
                            pagerType: 'full',
                            controls: false,
                            auto: true,
                            pause: 4000,
                            autoHover: true,
                            useCSS: false
                        })
                    }
                }
            })
        }
        if (typeof $.fn.easytabs != 'undefined') {
            $('.tabs-container').easytabs({animationSpeed: 300, updateHash: false});
            $('.vertical-tabs-container').easytabs({animationSpeed: 300, updateHash: false})
        }
        if (typeof $.fn.gMap != 'undefined') {
            $(".google-map").each(function () {
                var $t = $(this);
                var mapZoom = parseInt($t.attr("data-zoom"));
                var mapAddress = $t.attr("data-address");
                var mapCaption = $t.attr("data-caption");
                $t.gMap({
                    maptype: 'ROADMAP',
                    scrollwheel: false,
                    zoom: mapZoom,
                    markers: [{address: mapAddress, html: mapCaption, popup: false}]
                })
            })
        }
        if ((typeof $.fn.isotope != 'undefined') && ($(window).width() > 767)) {
            $('.portfolio-items').imagesLoaded(function () {
                var container = $('.portfolio-items');
                container.isotope({itemSelector: '.item', layoutMode: 'masonry', transitionDuration: '0.5s'});
                $('.portfolio-filter li a').click(function () {
                    $('.portfolio-filter li a').removeClass('active');
                    $(this).addClass('active');
                    var selector = $(this).attr('data-filter');
                    container.isotope({filter: selector});
                    return false
                });
                $(window).resize(function () {
                    container.isotope({})
                })
            })
        }
    });
    $(window).scroll(function () {
        animateMilestones();
        animatePieCharts();
        animateProgressBars();
        showHidebackToTop()
    });
    $(window).resize(function () {
        handleMobileMenu();
        handleFullScreenDiv()
    });
    $(window).load(function () {
        handlePageLoader()
    })
})(window.jQuery);