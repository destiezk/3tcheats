$(window).on('load', function() {
  var preloaderFadeOutTime = 1000;
  function hidePreloader() {
    var preloader = $('.spinner-wrapper');
    setTimeout(function() {
      preloader.fadeOut(preloaderFadeOutTime);
    }, 1000);
  }
  hidePreloader();
});

$(function() {
    "use strict";
    var wind = $(window);
    $.scrollIt({
        upKey: 38,
        downKey: 40,
        easing: 'swing',
        scrollTime: 600,
        activeClass: 'active',
        onPageChange: null,
        topOffset: -80
    });
    wind.on("scroll", function() {
        var bodyScroll = wind.scrollTop(),
            navbar = $(".navbar"),
            navbloglogo = $(".blog-nav .logo> img"),
            logo = $(".navbar .logo> img");
        if (bodyScroll > 100) {
            navbar.addClass("nav-scroll");
            logo.attr('src', 'img/logo-dark.png');
        } else {
            navbar.removeClass("nav-scroll");
            logo.attr('src', 'img/logo-light.png');
            navbloglogo.attr('src', 'img/logo-dark.png');
        }
    });
    wind.on('scroll', function() {
        $(".skills-progress span").each(function() {
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            var myVal = $(this).attr('data-value');
            if (bottom_of_window > bottom_of_object) {
                $(this).css({
                    width: myVal
                });
            }
        });
    });
    var pageSection = $(".bg-img, section");
    pageSection.each(function(indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });
    $(".info").on("click", ".icon-toggle", function() {
        $(".info").toggleClass("map-show");
        $(".map").toggleClass("o-hidden");
    });
});