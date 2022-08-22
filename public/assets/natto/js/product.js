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
            initHomeProductBannerPc();
            initHomeProductBannerMb();
            // initHomeNews();
             initProductType();
        };

        this.resize = function() {

        };

        var initHomeProductBannerPc = function() {
            var swiper = new Swiper('.home-product-banner-pc', {
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: {
                    delay: 2000,
                },
                loop: true,
                pagination: {
                    el: '.swiper-pagination-pc',
                    type: 'bullets',
                    clickable: true,
                },
            });
        };
        var initHomeProductBannerMb = function() {
            var swiper = new Swiper('.home-product-banner-mb', {
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: {
                    delay: 2000,
                },
                loop: true,
                pagination: {
                    el: '.swiper-pagination-mb',
                    type: 'bullets',
                    clickable: true,
                },
            });
        };

        var initProductType = function() {
            $('.carousel').carousel({
                interval: 2000
            })
        };


        var initHomeNews = function() {
            var swiper = new Swiper('.home-news', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    767: {
                        slidesPerView: 1,
                        spaceBetween: 0,
                    }
                }
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
