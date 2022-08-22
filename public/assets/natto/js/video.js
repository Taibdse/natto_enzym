(function($, app) {

    var homeCls = function() {

        var vars = {};
        var ele = {};

        this.run = function() {
            this.init();
            this.bindEvents();
        };

        this.init = function() {
            vars.videoPage = 0;
            vars.audioPage = 0;
        };

        this.bindEvents = function() {
            initVideoAudio();
            viewmore();
            initSlideVideo();
            initSlideAudio();
        };

        this.resize = function() {

        };
        var initSlideVideo = function () {
            var swiper = new Swiper('.swiper-video', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-video-next',
                    prevEl: '.swiper-video-prev',
                },
                breakpoints: {
                    767: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                }
            });
        }
        var initSlideAudio = function () {
            var swiper = new Swiper('.swiper-audio', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-audio-next',
                    prevEl: '.swiper-audio-prev',
                },
                breakpoints: {
                    767: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                }
            });
        }
        var initVideoAudio = function() {
            $('.video-item').click(function () {
                var videoSrc = $(this).attr('video-src');
                $('#audio-place').trigger("pause");
                $('.audio-item').removeClass('active');
                // console.log(videoSrc);
                $('#popup-video').on($.modal.OPEN, function () {
                    $(this).find('video').attr('src', videoSrc);
                });
                var vi = document.getElementById("videopopup");
                var check = true;
                var status_sound = vi ? vi.muted : 0;
                //console.log(status_sound);
                // $(".control-video").click(function () {
                //     if (check) {
                //         vi.pause();
                //         $(".overlay-video").css("visibility", "visible");
                //         check = false;
                //     } else {
                //         vi.play();
                //         $(".overlay-video").css("visibility", "hidden");
                //         check = true;
                //     }
                // });
                // $(".sound").click(function () {
                //     if (status_sound) {
                //         vi.muted = false;
                //         status_sound = false;
                //         $(".sound").removeClass('muted');
                //     } else {
                //         vi.muted = true;
                //         status_sound = true;
                //         $(".sound").addClass('muted');
                //     }
                // });
                $('#popup-video').on($.modal.CLOSE, function () {
                    $(".overlay-video").css("visibility", "hidden");
                    $(".sound").removeClass('muted');
                    vi.muted = false;
                    $(this).find('video').attr('src', '');
                });
            })
            var num=0;
            var arr=[];
            var playing=false;
            var audio = $('#audio-place');
            var audioSrc;
            $('.audio-list').find('.audio-item').each(function(){
                num++;
                $(this).attr("id","a"+num);

                $(this).click(function(){

                    $('.audio-item').removeClass('active');
                    $(this).addClass('active');

                    arr.push($(this).attr('id'));
                    if(arr.length>2){
                        arr.shift();
                    }
                    if(arr[0]==arr[1]){
                        if(playing==true){
                            $('.audio-item').removeClass('active');
                            audio.trigger("pause");
                            playing = false;
                        }else{
                            audio.trigger("play");
                            playing=true;
                        }
                    }else{
                        console.log("load")
                        audioSrc = $(this).attr('audio-src');
                        console.log(audioSrc);
                        audio.find('source').attr('src', audioSrc);
                        audio.trigger("load");
                        audio.trigger("play");
                        playing=true;
                    }
                    // console.log(arr);
                })
            });
        };

        var viewmore = function () {
            $('.js-viewmore').click(function () {
                var dataType = $(this).attr('data-type');
                var page = 0;

                if (dataType === 'video') {
                    if (vars.videoPage) {
                        vars.videoPage++;
                    }
                    else {
                        vars.videoPage = 2;
                    }
                    page = vars.videoPage;
                }
                else {
                    if (vars.audioPage) {
                        vars.audioPage++;
                    }
                    else {
                        vars.audioPage = 2;
                    }
                    page = vars.audioPage;
                }

                var _cb = function (res) {
                    if (res.code) {
                        $('.js-show-' + res.data.type).append(res.data.html);
                        $('html,body').animate({
                            scrollTop: $('.row-page-' + res.data.items.current_page).offset().top - 30
                        }, 0);

                        if (res.data.items.current_page >= res.data.items.last_page) {
                            $('.js-viewmore-' + res.data.type).hide();
                        }
                        else {
                            $('.js-viewmore-' + res.data.type).show();
                        }
                    }
                };

                $.app.ajax(null, 'videos', {type: dataType, page: page}, _cb, 'GET', '.alert-form');
            });
        }

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
