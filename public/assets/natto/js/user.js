(function($, app) {

    var UserCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {
            vars.data = [];
            vars.page = [];
            vars.cat = 1;

        };

        this.bindEvents = function() {
             initTopUser();
            // initTopUserCd();
            searchGallery();
            eventHandle();
            viewMore();
            updateInfo();
        };

        this.resize = function() {

        };

        var initTopUser = function() {
            var swiper = new Swiper('.user-top10-slider-gallery', {
                slidesPerView: 3,
                spaceBetween: 30,
                // mousewheel: true,
                navigation: {
                    nextEl: '.next-gallery',
                    prevEl: '.prev-gallery',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    991: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        // mousewheel: false,
                    },
                }
            });

        };
        var initTopUserCd = function() {
            var swiper = new Swiper('.user-top10-slider-chuaduyet', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next2',
                    prevEl: '.swiper-button-prev2',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    991: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                }
            });

        };

        var eventHandle = function () {
            // Click on tab gallery
            $('.js-tab-gallery li a').click(function () {
                var category_id = $(this).attr('data-category');
                vars.cat = category_id;
                $('.js-form-search').find('input[name=search_category]').val(category_id);
            });
        };

        var searchGallery = function() {
            $('.js-btn-search').click(function (e) {
                proccessSearch(e);
                e.preventDefault();
            });

            $('.js-input-keyword').keypress(function (e) {
                if (e.which === 13) {
                    proccessSearch(e);
                    e.preventDefault();
                }
            });
        };

        var proccessSearch = function (eventObject) {

            var $formSearch = $('.js-form-search');
            vars.data[vars.cat] = $formSearch.serializeArray();
            vars.page[vars.cat] = 1;
            vars.data[vars.cat].push({name: 'page', value: vars.page[vars.cat]});

            requestFilter();

        };

        var viewMore = function () {
            $('.js-btn-more').click(function (e) {
                if (typeof vars.page[vars.cat] !== 'undefined') {
                    vars.page[vars.cat]++;
                }
                else {
                    vars.page[vars.cat] = 2;
                }

                let category_id = $(this).attr('data-category');

                if (typeof vars.data[vars.cat] == 'undefined') {
                    vars.data[vars.cat] = [];
                }

                vars.data[vars.cat].push({name: 'page', value: vars.page[vars.cat]});
                vars.data[vars.cat].push({name: 'search_category', value: category_id});

                requestFilter(true, $(this));
            });
        };

        var requestFilter = function (append = false, $currentObject = null) {

            $('.show-alert').text('');

            var _cb = function (res) {
                if (res.code) {
                    if (append) {

                        $('.js-show-' + res.data.category_id).append(res.data.html).hide().fadeIn(400);
                        $('html,body').animate({
                            scrollTop: $('.js-show-' + res.data.category_id + ' .row-page-' + res.data.items.current_page).offset().top
                        }, 0);
                    }
                    else {
                        $('.js-show-' + res.data.category_id).html(res.data.html).hide().fadeIn(300);
                        window.location.hash = '';
                        window.location.hash = 'contest-content';
                    }

                    if (res.data.items.current_page < res.data.items.last_page) {
                        $('.js-show-' + res.data.category_id).siblings().show();
                    }
                    else {
                        $('.js-show-' + res.data.category_id).siblings().hide();
                    }
                }
                else {
                    $('.js-show-' + res.data.category_id).html('');
                    $('.js-show-' + res.data.category_id).siblings().hide();
                }
            };

            $.app.ajax($currentObject, 'contest', vars.data[vars.cat], _cb, 'GET', '.show-alert');
        };

        var updateInfo = function () {
            var $form = $('#js-user-info');
            $('.js-btn-submit', $form).click(function () {
                var data = $form.serializeArray();

                var _cb = function (res) {
                    if(res.code){
                        alert('Bạn đã cập nhật thông tin thành công!');
                        $.modal.close();
                    }
                };

                $.app.ajax(this, 'contest/updateMember', data, _cb, 'POST', '.alert-submit');
            });
        };

    };


    $(document).ready(function() {
        var UserObj = new UserCls();
        UserObj.run();
        // On resize
        $(window).resize(function() {
            UserObj.resize();
        });
        function swiperUserSlide(){
            var swiperUser = new Swiper('.user-top10-slider', {
                slidesPerView: 3,
                spaceBetween: 30,
                // mousewheel: true,
                navigation: {
                    nextEl: '.swiper-button-next-daduyet',
                    prevEl: '.swiper-button-prev-daduyet',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    991: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        // mousewheel: false,
                    },
                }
            });
        }
        function swiperUserSlideCd(){
            var swiperUser = new Swiper('.user-top10-slider-chuaduyet', {
                slidesPerView: 3,
                spaceBetween: 30,
                // mousewheel: true,
                navigation: {
                    nextEl: '.swiper-button-next-chuaduyet',
                    prevEl: '.swiper-button-prev-chuaduyet',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    991: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                        // mousewheel: false,
                    },
                }
            });
        }
        swiperUserSlide();
        swiperUserSlideCd();
        $('.nav-tabs a').on('shown.bs.tab', function(){
            swiperUserSlide();
            swiperUserSlideCd();
        });
    });
}(jQuery, $.app));
