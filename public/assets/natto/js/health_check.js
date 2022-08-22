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
            //initQuiz();
            handleTest();
        };

        this.resize = function() {

        };

        var initQuiz = function() {
            var swiper = new Swiper('.quiz-li', {
                slidesPerView: 1,
                spaceBetween: 0,
                navigation: {
                    nextEl: '.swiper-button-next-1',
                    prevEl: '.swiper-button-prev-1',
                },
            });
            document.querySelector('.re-test').addEventListener('click', function (e) {
                e.preventDefault();
                swiper.slideTo(0, 0);
            });
        };

        var handleTest = function () {
            var index = 0;
            var hasAnswer = false;
            var answers = [];
            var $first = $('.js-quiz-li').children().first();
            var $last = $('.js-quiz-li').children().last();

            $first.css('display', 'block');
            $first.find('.js-btn-prev').hide();
            $last.find('.js-btn-next').hide();

            $('.js-btn-next').click(function () {
                var current = $(this).closest('.quiz-slide');
                var next = current.next();
                var prev = current.prev();
                var isChooseAnswer = current.find('.js-answer').hasClass('active');

                if (!hasAnswer && !isChooseAnswer) {
                    alert('Bạn cần chọn một câu trả lời trước khi chuyển sang câu tiếp theo!');
                    return false;
                }

                hasAnswer = false;
                current.hide();
                next.show();
                index++;
            });

            $('.js-btn-prev').click(function () {
                var current = $(this).closest('.quiz-slide');
                var next = current.next();
                var prev = current.prev();

                current.hide();
                prev.show();
                index--;
            });

            $('.js-answer').click(function (e) {
                var dataValue = $(this).attr('data-value');

                $(this).closest('.row').find('.js-answer').removeClass('active');
                $(this).addClass('active');

                answers.splice(index, 1, dataValue);
                hasAnswer = true;

                $(this).closest('.quiz-slide').find('.js-btn-next').trigger('click');

                if (index >= 11) {
                    var _cb = function (res) {
                        if (res.code) {
                            $('.js-re-test, .js-quiz-list').hide();
                            var $quizResult = $('.js-quiz-result');
                            let list = res.data.messages.split(';');
                            let htmlList = '';
                            list.forEach(function (li) {
                                htmlList += `<li>${ li }</li>`;
                            });
                            $quizResult.find('h5').html(res.data.title);
                            $quizResult.find('.loikhuyen ul').html(htmlList);
                            $quizResult.show();
                        }
                    };

                    $.app.ajax(null, 'test', {results: answers}, _cb, 'GET', '.alert-form');
                }



            });

            $('.js-re-test').click(function () {
                index = 0;
                $('.js-quiz-li .quiz-slide').hide();
                $('.js-answer').removeClass('active');
                $first.css('display', 'block');
                hasAnswer = false;
                answers = [];
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
