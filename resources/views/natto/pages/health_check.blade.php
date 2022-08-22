@extends('natto.layouts.default')
@section('header')
    <title>{{ config('system.general_title') }}</title>
    <meta name="description" content="{{ config('system.general_description') }}">
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ Request::url()  }}" />
    <meta property="og:image" content="{{ url(config('system.general_share') ?? '') }}" />
    <meta property="og:title" content="{{ config('system.general_title') }}" />
    <meta property="og:description" content="{{ config('system.general_description') }}" />
    <link type="text/css" href="{{ url('assets/lib/selectric/selectric.css') }}?{{ config('system.version') }}" rel="stylesheet">
@stop

@section('content')
    <div class="health-check" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="dangky-kt">
                        <div class="section-title-2">
                            <h2>ĐĂNG KÝ THÔNG TIN NHANH <br>
                                ĐỂ CHÚNG TÔI TƯ VẤN CHO BẠN</h2>
                        </div>
                        <form action="#" id="contactForm">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-4 col-form-label">Họ và tên</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên" v-model="formData.name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Ngày sinh</label>
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-4 p-xl-0 pl-xl-2">
                                                    <select class="form-control form-select" name="day">
                                                        <option value="">Ngày</option>
                                                        @for ($i = 1; $i <= 31; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-4 p-xl-0 pl-xl-2">
                                                    <select class="form-control form-select" name="month">
                                                        <option value="">Tháng</option>
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-4 p-xl-0 pl-xl-2">
                                                    <select class="form-control form-select" name="year">
                                                        <option value="">Năm</option>
                                                        @for ($i = 1920; $i <= 2020; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-4 col-form-label">Số điện thoại</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="phone_number" placeholder="Nhập số điện thoại" v-model="formData.mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label for="gener" class="col-4 col-form-label">Giới tính</label>
                                        <div class="col-8">
                                            <div class="radio-cnt">
                                                <div class="form-check form-check-inline custom-radio mr-4">
                                                    <input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0" v-model="formData.gender">
                                                    <label class="form-check-label custom-control-label" for="inlineRadio1">Nam</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-radio">
                                                    <input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" v-model="formData.gender">
                                                    <label class="form-check-label custom-control-label" for="inlineRadio2">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email</label>
                                        <div class="col-8">
                                            <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email" v-model="formData.email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <p>Các thông tin này được sử dụng với mục đích lưu trữ và tư vấn sức khỏe của bạn. Chúng tôi sẽ nỗ lực lưu trữ bảo mật và xử lý cẩn thận thông tin mà bạn chia sẻ với chúng tôi</p>
                                </div>
                            </div>
                            <div class="alert-form"></div>
                            <div class="form-group text-center mt-3">
                                <button type="button" class="btn btn-submi" v-on:click="submitForm">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                    <div class="tracnghiem">
                        <div class="section-title-2">
                            <h2>Trắc nghiệm nhanh <br>
                                tình trạng sức khỏe của bạn</h2>
                        </div>
                        <div class="quiz-cnt">
                            <div class="re-test js-re-test">
                                <p>Trả lời lại từ đầu</p>
                            </div>
                            <div class="quiz-list js-quiz-list">
                                <div class="quiz-li js-quiz-li">
                                        @foreach ($questions as $key => $question)
                                            <div class="quiz-slide" style="display: none">
                                                <div class="quiz-box">
                                                    <div class="quiz-question">
                                                        <p><span>Câu hỏi {{ $loop->index + 1 }}: </span>{{ $question['question'] }}</p>
                                                    </div>
                                                    <div class="quiz-answer">
                                                        <div class="row">
                                                            @foreach ($question['answer'] as $key => $answer)
                                                                <div class="col-6">
                                                                    <div class="answer-txt js-answer" data-value="{{ $key }}">
                                                                        {{ $answer['text'] }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- If we need navigation buttons -->
                                                <div class="swiper-button-prev swiper-button-prev-1 js-btn-prev"></div>
                                                <div class="swiper-button-next swiper-button-next-1 js-btn-next"></div>
                                            </div>
                                        @endforeach
                                </div>

                            </div>
                            <div class="quiz-result js-quiz-result" style="display: none">
                                <h5>Nguy cơ rất cao</h5>
                                <p>Lời khuyên dành riêng cho bạn:</p>
                                <div class="loikhuyen">
                                    <ul>
                                        <li>Thường xuyên kiểm tra sức khoẻ tại các trung tâm y tế.</li>
                                        <li>Tăng cường tập vận động thể dục thể thao hằng ngày.</li>
                                        <li>Ăn uống, nghỉ ngơi điều độ, tránh các chất kích thích (rượu, bia, thuốc lá,...).</li>
                                        <li>Tham gia tư vấn bác sĩ thêm về phòng tránh bệnh đột quỵ ở độ tuổi trên 40.</li>
                                        <li>Tuân thủ theo yêu cầu của bác sĩ, hạn chế căng thẳng, suy nghĩ tích cực.</li>
                                        <li>Luôn mang hồ sơ bệnh bên người.</li>
                                        <li>Chọn một trung tâm chăm sóc phục hồi chức năng hiệu quả và thực hành các bài tập trị liệu tại nhà.</li>
                                        <li>Tìm ngay sự chăm sóc của người thân để hỗ trợ kịp khi xảy ra trường hợp khẩn cấp.</li>
                                        <li><span>Khuyến nghị cao:</span> Bạn rất cần sử dụng sản phẩm NattoEnzym - DHG Pharma để ngăn ngừa đột quỵ, kiểm soát các yếu tố gây nên bệnh (bệnh tim mạch, đái tháo đường, cholesterol cao,...).</li>
                                    </ul>
                                </div>
                                <div class="see-more flase-btn">
                                    <a href="{{ url('products') }}">Tìm Hiểu Sản Phẩm NattoEnzym</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="height: 100%; top: 0px;" id="sidebar">
                    <div class="banner-right show-popup-store">
                        <a href="#">
                            <img src="{{url('assets/natto/images/default/banner-right-1.jpg')}}" alt="nattoenzym" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bot-scroll"></div>
@stop

@section('footer')
    <script src="{{ url('assets/lib/selectric/jquery.selectric.min.js?'.config('system.version')) }}"></script>
    <script src="{{ url('assets/natto/js/contact.js?'.config('system.version')) }}"></script>
    <script src="{{ url('assets/natto/js/health_check.js?'.config('system.version')) }}"></script>
    <script src="{{ url('assets/natto/js/news.js?'.config('system.version')) }}"></script>

    <script>
        $(document).ready(function() {
            var selectric;
            $(function () {
                selectric = $('select').selectric({
                    maxHeight: 200,
                });
            });
        });
    </script>
@stop
