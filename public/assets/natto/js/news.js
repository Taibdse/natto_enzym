(function($, app) {

    var newsCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {
            vars.page = 0;
        };

        this.bindEvents = function() {
            scrollSticky();
            viewMore();
        };

        this.resize = function() {

        };

        var scrollSticky = function(){
            var $window = $(window);
            var $sidebar = $("#sidebar");
            var $sidebarHeight = $sidebar.innerHeight();
            var $footerOffsetTop = $(".bot-scroll").offset().top;
            var $sidebarOffset = $sidebar.offset();

            $window.scroll(function() {
                if($window.scrollTop() > $sidebarOffset.top) {
                    $sidebar.addClass("sticky");
                } else {
                    $sidebar.removeClass("sticky");
                }
                if($window.scrollTop() + $sidebarHeight > $footerOffsetTop) {
                    $sidebar.css({"top" : -($window.scrollTop() + $sidebarHeight - $footerOffsetTop)});
                } else {
                    $sidebar.css({"top": "0",});
                }
            });
        }

        var viewMore = function () {
            $('.js-btn-more').click(function (e) {

                var dataLink = $(this).attr('data-link');

                if (vars.page) {
                    vars.page++;
                }
                else {
                    vars.page = 2;
                }

                var _cb = function (res) {
                    if (res.code) {
                        $('.js-show-data').append(res.data.html);
                        $('html,body').animate({
                            scrollTop: $('.row-page-' + res.data.items.current_page).offset().top - 30
                        }, 0);

                        if (res.data.items.current_page < res.data.items.last_page) {
                            $('.js-btn-more').show();
                        }
                        else {
                            $('.js-btn-more').hide();
                        }

                    }
                };

                $.app.ajax($(this).find('.cta-btn'), dataLink, {page: vars.page}, _cb, 'GET', '.none');
            });
        };

    };


    $(document).ready(function() {
        var newsObj = new newsCls();
        newsObj.run();
        // On resize
        $(window).resize(function() {
            newsObj.resize();
        });
    });
}(jQuery, $.app));
