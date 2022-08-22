@extends('natto.layouts.default')
@section('header')
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article"/>
    <meta property="og:site_name" content="{{ config('app.name') }}"/>
    <meta property="og:url" content="{{ Request::url()  }}"/>
    <meta property="og:image" content="{{ url(config('system.general_share') ?? '') }}"/>
    <meta property="og:title" content="{{ config('system.general_title') }}"/>
    <meta property="og:description" content="{{ config('system.general_description') }}"/>
    <link type="text/css" href="{{ url('assets/lib/selectric/selectric.css') }}?{{ config('system.version') }}"
          rel="stylesheet">
    <script src="{{ url('assets/lib/js/vue.js') }}"></script>
    <script src="{{ url('assets/lib/js/axios.min.js') }}"></script>
    <script src="{{ url('assets/lib/js/scroll-loader.umd.js') }}"></script>
@stop

@section('content')


    <div id="app">
        <section id="video-rule" class="sc-video invisible ">
            <div class="container">
                <div class="section-title">
                    <h2>HỌC ONLINE CÙNG NATTOENZYM</h2>
                </div>
                <ul class="nav-video nav nav-tabs">
                    <li>
                        <a v-bind:class="[{ active: curentVideo == 1 },{ enableTab: curentVideo >= 1 }, disabled]"  data-toggle="tab" href="#tab1">Bài 1: 2:06' </a>
                    </li>
                    <li>
                        <a v-bind:class="[{ active: curentVideo == 2 },{ enableTab: curentVideo >= 2 }, disabled]" data-toggle="tab" href="#tab2">Bài 2: 1:11' </a>
                    </li>
                    <li>
                        <a v-bind:class="[{ active: curentVideo == 3 },{ enableTab: curentVideo >= 3 }, disabled]" data-toggle="tab" href="#tab3">Bài 3: 1:53' </a>
                    </li>
                    <li>
                        <a v-bind:class="[{ active: curentVideo == 4 },{ enableTab: curentVideo >= 4 }, disabled]" data-toggle="tab" href="#tab4">Bài 4: 1:14' </a>
                    </li>
                    <li>
                        <a v-bind:class="[{ active: curentVideo == 5 },{ enableTab: curentVideo >= 5 }, disabled]" data-toggle="tab" href="#tab5">Bài 5: 1:45' </a>
                    </li>
                </ul>
                <div class="tab-content tab-videos" v-if="videos">

                    <template  v-for="(video, index) in videos.slice(0,4)" >
                        <div class="tab-pane fade" v-bind:class="[{ active: curentVideo == index +1 },{ show: curentVideo ==  index +1},'']" :id="'tab'+ (index + 1)">
                            <h3 class="name-video" v-if="index == 0">Đột quỵ và những con số đáng báo động</h3>
                            <h3 class="name-video" v-if="index == 1">Các dấu hiệu nhận biết đột quỵ</h3>
                            <h3 class="name-video" v-if="index == 2">Cách xử trí khi gặp người bị đột quỵ</h3>
                            <h3 class="name-video" v-if="index == 3">Hai đối tượng nguy cơ cao bị đột quỵ</h3>

                            <div class="block-video">
                                <div class="video">
                                    <video :id="'video'+ (index + 1)"   @ended="onEnd()"  class="video-tip" controls v-bind:src="getFullUrl(video.video_link)"></video>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-if="videos[4]">
                        <div class="tab-pane fade" v-bind:class="[{ active: curentVideo == 5 },{ show: curentVideo ==  5},'']" id="tab5" v-if="videos[4]">
                            <h3 class="name-video">Đột quỵ - Phòng bệnh hơn chữa bệnh</h3>
                            <div class="block-video">
                                <div class="video">
                                    <video id="video5"  @ended="showBtn()"   class="video-tip" controls v-bind:src="getFullUrl(videos[4].video_link)"></video>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="text-center mt-3" v-if="btnTest == true">
                    <a href="{{url('/course/questions')}}" class="btn-test"><i class="fa fa-play"></i>TEST KIỂM TRA KIẾN THỨC</a>
                </div>


            </div>

        </section>
        <section class="section-rule invisible">
            <div class="container">
                <div class="block-rule">
                    <h2 class="title-rule">THỂ LỆ KHÓA HỌC</h2>
                    <div class="bdr">
                        <div class="rule-content">
                            <b>Mục đích khóa học:</b> <br>
                            - Khóa training là những bài học cơ bản về các vấn đề liên quan đến đột quỵ,
                            nhằm giúp mọi người có thêm kiến thức, mỗi người tham gia sau khóa
                            học đều trở thành một chuyên gia có thể chủ động bảo vệ sức khỏe của bản thân
                            và gia đình mình trước căn bệnh đột quỵ nguy hiểm. <br>
                            - Chủ động phòng ngừa là quan trọng nhất. <br><br>

                            <b>Nội dung khóa học:</b> <br>
                            <ul>
                                <li>Khóa training online bao gồm 5 bài học cơ bản về đột quỵ và 1 bài kiểm tra kiến thức sau khi hoàn thành nội dung học.
                                </li>
                                <li>Bài 1:  Đột quỵ và những con số đáng báo động</li>
                                <li>Bài 2: Các dấu hiệu nhận biết đột quỵ</li>
                                <li>Bài 3: Cách xử trí khi gặp người bị đột quỵ</li>
                                <li>Bài 4: Hai đối tượng nguy cơ cao bị đột quỵ</li>
                                <li>Bài 5: Đột quỵ - Phòng bệnh hơn chữa bệnh</li>
                                <li>Bài Kiểm tra kiến thức: Gồm 10 câu hỏi được lấy ngẫu nhiên từ bộ đề và liên quan đến 5 bài học trên.</li>

                            </ul>
                            <br>
                            <b>Cách thức tham gia khóa học:
                            </b> <br>
                            <ul>
                                <li>B1: Đăng nhập hoặc đăng ký để tham gia
                                </li>
                                <li>B2: Tham gia học qua 5 video bài học
                                </li>
                                <li>B3: Tham gia Kiểm tra kiến thức sau khi hoàn thành tất cả các bài học (có thể Kiểm tra nhiều lần để cải thiện điểm số)
                                </li>
                                <li>B4: Xem kết quả kiểm tra và nhận Chứng nhận hoàn thành khoá học khi đạt điểm yêu cầu.
                                </li>
                            </ul>
                            <br>
                            <b>Bạn sẽ nhận được gì khi tham gia Khóa học:
                            </b><br>
                            <ol style="padding-left: 15px">
                                <li>1.  Bổ sung thêm các kiến thức cơ bản về đột quỵ để chủ động phòng ngừa cho bản thân và gia đình.
                                </li>
                                <li>2.  Đạt 80% điểm Kiểm tra kiến thức sau khóa học sẽ nhận được chứng nhận hoàn thành khóa học.</li>
                            </ol>

                        </div>
                    </div>

                </div>
                <img class="img-fluid mt-2" src="{{url('assets/natto/images/video/img11.png')}}" alt="">
            </div>
        </section>
        <div id="form_dangky" class="modal form_dangky">
            <div class="dangky-kt">
                <h5>ĐĂNG KÝ THÔNG TIN NHANH <br>
                    ĐỂ HỌC ONLINE CÙNG NATTOENZYM</h5>
                <form action="#" id="contactForm">
                    <div class="form-group row align-items-center">
                        <label for="name" class="col-sm-4 col-3 col-form-label">Họ và tên</label>
                        <div class="col-sm-8 col-9">
                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên"
                                   v-model="formData.name">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="phone_number" class="col-sm-4 col-3 col-form-label">Số điện thoại</label>
                        <div class="col-sm-8 col-9">
                            <input type="text" class="form-control" id="phone_number" placeholder="Nhập số điện thoại"
                                   v-model="formData.mobile">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="email" class="col-sm-4 col-3 col-form-label">Email</label>
                        <div class="col-sm-8 col-9">
                            <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email"
                                   v-model="formData.email">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label class="col-sm-4 col-3 col-form-label">Ngày sinh</label>
                        <div class="col-sm-8 col-9">
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-control form-select" ref="selectDay">
                                        <option value="">Ngày</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control form-select" ref="selectMonth">
                                        <option value="">Tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control form-select" ref="selectYear">
                                        <option value="">Năm</option>
                                        @for ($i = 1920; $i <= 2020; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="gener" class="col-sm-4 col-3 col-form-label">Giới tính</label>
                        <div class="col-sm-8 col-9">
                            <div class="radio-cnt">
                                <div class="form-check form-check-inline custom-radio mr-4">
                                    <input class="form-check-input custom-control-input" type="radio"
                                           name="inlineRadioOptions" id="inlineRadio1" value="0" v-model="formData.gender">
                                    <label class="form-check-label custom-control-label" for="inlineRadio1">Nam</label>
                                </div>
                                <div class="form-check form-check-inline custom-radio">
                                    <input class="form-check-input custom-control-input" type="radio"
                                           name="inlineRadioOptions" id="inlineRadio2" value="1" v-model="formData.gender">
                                    <label class="form-check-label custom-control-label" for="inlineRadio2">Nữ</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert-form alert-danger" v-if="errors.message" v-html="errors.message"></div>
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-submi" v-on:click="submitForm">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('footer')
    <script type='text/javascript'>
        const url = '{{ url('/') }}';
    </script>
    <script src="{{ url('assets/natto/js/vue_app.js?'.config('system.version')) }}"></script>
    <script src="{{ url('assets/lib/selectric/jquery.selectric.min.js?'.config('system.version')) }}"></script>
    <script>
        vue_app.$mount('#app');
        $(document).ready(function () {

            // $("#form_dangky").modal({
            //     fadeDuration: 100
            // });
            var selectric;
            $(function () {
                selectric = $('.form-select').selectric({
                    maxHeight: 200,
                });
            });
        });

        function checkInfo()
        {
            var _cb = function (res) {
                if (!res.data) {
                    $("#form_dangky").modal({
                        fadeDuration: 100
                    });
                }
                else {
                    $('#video-rule, .section-rule').removeClass('invisible ');
                }
            };

            $.app.ajax(null, 'course/checkInfo', {}, _cb, 'GET', '.none');
        }

        function checkLogin()
        {
            function _cbLogin(res)
            {
                if (res.code) {
                    checkInfo()
                }
            }
            $.app.checkLogin('{!! url('course/videos?logged=1') !!}', _cbLogin);
        }

        @if(\Auth::check() && app('request')->get('logged', 0))
            $(document).ready(function () {
                checkInfo();
            });
        @endif

        $(document).ready(function () {
            checkLogin();
        });

        @if(session('message', ''))
        $(document).ready(function () {
            $.app.alert.info('{{ session('message', '') }}');
        });
        @endif
    </script>

@stop
