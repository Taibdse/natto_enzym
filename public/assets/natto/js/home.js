(function($, app) {

    var homeCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {

        };

        this.bindEvents = function() {
            initHomeBanner();
            initHomeNews();
            initHomeProductSlider();
        };

        this.resize = function() {

        };
        var initHomeBanner = function() {
            var swiper = new Swiper('.swiper-banner-top', {
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                speed: 1800,
                loop: true,
                navigation: {
                    nextEl: '.swiper-top-next',
                    prevEl: '.swiper-top-prev',
                },
                pagination: {
                    el: '.swiper-pagination-top',
                    type: 'bullets',
                    clickable: true,
                },
            });
        };
        var initHomeNews = function() {
            var swiper = new Swiper('.home-news', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-news-next',
                    prevEl: '.swiper-news-prev',
                },
                breakpoints: {
                    767: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                }
            });
        };
        var initHomeProductSlider = function() {
            var swiper = new Swiper('.home-product-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: {
                    delay: 4000,
                },
                speed: 2500,
                navigation: {
                    nextEl: '.swiper-product-next',
                    prevEl: '.swiper-product-prev',
                },
                pagination: {
                    el: '.swiper-pagination-product',
                    type: 'bullets',
                    clickable: true,
                },
            });
        };
    };


    $(document).ready(function() {
        var homeObj = new homeCls();
        homeObj.run();
        // On resize
        $(window).resize(function() {
            homeObj.resize();
        });
    });
}(jQuery, $.app));
