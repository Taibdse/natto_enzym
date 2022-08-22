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
@stop

@section('content')


    <div class="online-quiz" id="quizz">
        <div class="container">
            <div class="section-title">
                <h2>HỌC ONLINE CÙNG NATTOENZYM</h2>
            </div>
            <div class="quiz-title">
                <div class="quick-test">
                    <h6>Trắc nghiệm nhanh</h6>
                </div>
                <h5>CÁC CÂU HỎI TEST NHANH KIẾN THỨC <br class="d-none d-sm-block">
                    KHÓA HỌC TRAINING</h5>
            </div>
            <div class="quiz-container">
                <form action="" >
                    <div class="quiz-li" v-cloak v-for="(ques, index) in quetions" :key="index">
                        <div class="quiz-ques">
                            <div class="quiz-order">
                                @{{index + 1}}
                            </div>
                            <p>@{{ques.title}}</p>
                        </div>
                        <div class="radio-cnt">
                            <div class="form-check custom-radio mr-4" v-if="ques.answer_1">
                                <input v-model="answer[index]" :value="0" class="form-check-input custom-control-input" type="radio" :name="ques.id"
                                       :id="'ques' + ques.id + '-op1'">
                                <label class="form-check-label custom-control-label" :for="'ques' + ques.id + '-op1'">@{{ques.answer_1}}</label>
                            </div>
                            <div class="form-check custom-radio" v-if="ques.answer_2">
                                <input v-model="answer[index]"  :value="1" class="form-check-input custom-control-input" type="radio" :name="ques.id"
                                       :id="'ques' + ques.id + '-op2'">
                                <label class="form-check-label custom-control-label" :for="'ques' + ques.id + '-op2'">@{{ques.answer_2}}</label>
                            </div>
                            <div class="form-check custom-radio" v-if="ques.answer_3">
                                <input v-model="answer[index]"  :value="2" class="form-check-input custom-control-input" type="radio" :name="ques.id"
                                       :id="'ques' + ques.id + '-op3'">
                                <label class="form-check-label custom-control-label" :for="'ques' + ques.id + '-op3'">@{{ques.answer_3}}</label>
                            </div>
                            <div class="form-check custom-radio" v-if="ques.answer_4">
                                <input  v-model="answer[index]"  :value="3" class="form-check-input custom-control-input" type="radio" :name="ques.id"
                                       :id="'ques' + ques.id + '-op4'">
                                <label class="form-check-label custom-control-label" :for="'ques' + ques.id + '-op4'">@{{ques.answer_4}}</label>
                            </div>
                            <div class="form-check custom-radio" v-if="ques.answer_5">
                                <input  v-model="answer[index]"  :value="4" class="form-check-input custom-control-input" type="radio" :name="ques.id"
                                       :id="'ques' + ques.id + '-op5'">
                                <label class="form-check-label custom-control-label" :for="'ques' + ques.id + '-op5'">@{{ques.answer_5}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3"  v-cloak  >
                        <button type="button" @click="postAnswer() " class="btn btn-submi">Kết quả bài test </button>
                    </div>
                </form>
            </div>
        </div>

            <div id="popup-result-fail" class="modal popup-result" >
                <div class="results-container">
                    <h3>KẾT QUẢ KIỂM TRA BÀI TEST</h3>
                    <div class="result-cnt">
                        <p>Tổng điểm: <span class="large-font">@{{ score.scores }}</span></p>
                        <p>Thời gian làm bài: <span>@{{ score.time }}</span></p>
                    </div>
                    <p>Bài thi của bạn chưa đạt đủ số điểm, bạn có thể học lại hoặc làm lại bài kiểm tra</p>
                    <div class="re-l-t">
                        <a href="{{url('/course/videos')}}">Học lại</a>
                        <a href="{{url('/course/questions')}}">Thi lại</a>
                    </div>
                </div>
            </div>



        <div id="popup-result-pass" class="modal popup-result pass" >
            <div class="results-container">
                <h3>KẾT QUẢ KIỂM TRA BÀI TEST</h3>
                <div class="result-cnt">
                    <p>Tổng điểm: <span class="large-font">@{{ score.scores }}</span></p>
                    <p>Thời gian làm bài: <span>@{{ score.time }}</span></p>
                </div>
                <p>Chúc mừng bạn đã hoàn thành khóa học online cùng Nattoenzym.
                    Nattoenzym đã gửi chứng chỉ qua email, bạn hãy kiểm tra ngay nhé</p>
            </div>
            <div class="des1">
                <img src="{{url('assets/natto/images/online/des1.png')}}" alt="des1" class="img-fluid">
            </div>
            <div class="des2">
                <img src="{{url('assets/natto/images/online/des2.png')}}" alt="des1" class="img-fluid">
            </div>
            <div class="des3">
                <img src="{{url('assets/natto/images/online/des3.png')}}" alt="des1" class="img-fluid">
            </div>
        </div>
    </div>
    <style>
        [v-cloak] {display: none; }
        .quiz-container{
            min-height: 500px;
        }
    </style>



@stop

@section('footer')
    <script>
        const url = '{{ url('/') }}';
    </script>
    <script src="{{ url('assets/natto/js/vue_app.js?'.config('system.version')) }}"></script>
    <script>
         vue_app.$mount('#quizz');
    </script>
@stop
