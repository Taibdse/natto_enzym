<div class="home_online">
    <div class="container">
        <div class="section-title d-none">
            <h1>Khóa học online</h1>
        </div>
        <div class="thamgiakhoahoc d-none">
            <div class="row align-items-center">
                <div class="col-sm-5">
                    <div class="img-box">
                        <img src="{{url('assets/natto/images/home/img-online.png')}}" alt="khóa học online" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="thamgia-cta-box">
                        <div class="cta-first">
                            <p>/ Cùng <span>NattoEnzym</span></p>
                            <h3>GIÚP BẠN & NGƯỜI THÂN</h3>
                        </div>
                        <h2>Tham gia khóa học online </h2>
                        <div class="cta">
                            <a href="{{url('/course/videos')}}"><img src="{{url('assets/natto/images/home/thamgia-icon.png')}}" alt="tham gia ngay"> Tham gia ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('natto.pages.home_video')
    </div>
</div>