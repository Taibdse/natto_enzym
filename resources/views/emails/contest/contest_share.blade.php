@extends('emails.layout_contest')
@section('content')
    <p style="margin:0;padding:0;padding-bottom:19px;">{{ $user_name ?? 'Bạn' }} thân mến,</p>
    <p style="margin:0;padding:0;padding-bottom:19px;"> BTC rất vui khi nhận được công thức mì dự thi chương trình <span style='color:#ed1c24;'>Bếp Hạnh Phúc</span> do trang báo Afamily tổ chức và ghi nhận tình yêu nấu nướng của bạn thông qua bài dự thi.</p>
    <p style="margin:0;padding:0;padding-bottom:19px;"> Thế nhưng {{ $user_name ?? 'Bạn' }} ơi , sau các bước kiểm duyệt, bài dự thi của bạn vẫn chưa phù hợp với các tiêu chí của chương trình.</p>
    <p style="margin:0;padding:0;padding-bottom: 19px;">
    Lý do là 

    </p>
    <p style="margin:0;padding:0;padding-bottom: 19px;">
       Hãy xem kỹ lại thể lệ chương trình tại <span style='color:#ed1c24;'><a href="https://bephanhphuc.afamily.vn/" style="text-decoration: none; color: #ed1c24;">tại đây</a></span>và gửi ngay các công thức mì ấn tượng để tiếp tục tham gia chương trình <span style='color:#ed1c24;'>Bếp Hạnh Phúc</span>nhé. Nhiều phần quà với tổng giá trị lên tới 50.000.000 ĐỒNG vẫn đang chờ đón bạn!
    </p>
    <p style="margin:0;padding:0;padding-bottom:19px;">Trân trọng, <br>
        Ban Tổ Chức</p>

@stop
