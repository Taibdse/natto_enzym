<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Admin Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'news' => 'Tin tức',
    'contest_title' => 'Cuộc thi',
    'contest' => [
        'tb_title' => 'Tiêu đề',
        'tb_image' => 'Ảnh',
        'tb_category' => 'Chuyên mục',
        'tb_preview' => 'Xem trước',
        'tb_status' => 'Trạng thái',
        'tb_shared' => 'Chia sẻ',
        'tb_mail' => 'Gửi mail',
        'not_shared' => 'Chưa chia sẻ',
        'tb_featured' => 'Nổi bật',
        'tb_created_at' => 'Ngày tạo',
        'tb_updated_at' => 'Ngày sửa',
        'tb_id' => 'ID',
        'form_info_contest' => 'Thông tin cuộc thi',
        'form_contest_detail' =>[
            'form_category' => 'Chuyên mục',
            'form_title' => 'Tiêu đề',
            'form_vote' => 'Vote',
            'form_share' => 'Share',
            'form_round' => 'Vòng',
            'form_image_avatar' => 'Ảnh đại diện (400x300)',
            'form_image_full' => 'Ảnh',
            'form_introtext' => 'Mô tả ngắn',
            'form_introfull' => 'Mô tả đầy đủ',
        ],
        'form_info_user' => 'Thông tin thí sinh',
        'form_user_detail' => [
            'user_name' => 'Họ tên',
            'user_avatar' => 'Ảnh đại diện',
            'user_email' => 'Email',
            'user_phone' => 'Điện thoại',
            'user_address' => 'Địa chỉ',
            'time' => 'Thời gian',
            'implementer' => 'Người thực hiện',
            'sender' => 'Người gửi',
            'action' => 'Hành động',
            'reason' => 'Lý do',
        ]
    ],
    'category_title' => 'Chuyên mục',
    'category' => [
        'tb_title' => 'Tiêu đề',
        'tb_image' => 'Ảnh',
        'tb_date' => 'Ngày',
        'tb_order' => 'Thứ tự',
        'tb_status' => 'Trạng thái',
        'tb_id' => 'ID',
        'form_title' => 'Tiêu đề',
        'form_avatar' => 'Ảnh đại diện',
        'form_introtext' => 'Mô tả ngắn',
    ],
    'logs_title' => 'Nhật ký',
    'logs' => [
        'tb_type' => 'Thể loại',
        'tb_contest' => 'Cuộc thi',
        'tb_user' => 'Người dùng',
        'tb_user_agent' => 'Tác nhân người dùng',
        'tb_ip_address' => 'Địa chỉ Ip',
        'tb_created_at' => 'Ngày tạo',
        'tb_id' => 'ID',
    ],
    'statistic_title' => 'Thống kê cuộc thi',
    'statistic_number' => [
        'st_title' => 'Số lượng',
    ],
    'statistic_refer' => [
        'st_title' => 'Nguồn dự thi',
    ],
    'statistic_chart' => [
        'statistic_contest' => 'Thống kê bài dự thi',
        'amount' => 'Số lượng',
        'amount_contest' => 'Số lượng bài dự thi',
        'number_subscriber' => 'Số lượt người đăng ký',
        'votes' => 'Lượt vote',
        'shares' => 'Lượt share',
        'access_source' => 'Thống kê nguồn truy cập',
    ],
    'config_title' => 'Cài đặt cuộc thi',
    'config' => [
        'config_round' => [
            'config_title' => 'Cài đặt vòng chơi',
            'timestart_round1' => 'Thời gian bắt đầu vòng 1',
            'timeend_round1' => 'Thời gian kết thúc vòng 1',
            'timestartvote_round1' => 'Thời gian bắt đầu vote vòng 1',
            'timeendvote_round1' => 'Thời gian kết thúc vote vòng 1',
            'timestartvote_round2' => 'Thời gian bắt đầu vote vòng 2',
            'timeendvote_round2' => 'Thời gian kết thúc vote vòng 2',
            'timestartvote_round3' => 'Thời gian bắt đầu vote vòng 3',
            'timeendvote_round3' => 'Thời gian kết thúc vote vòng 3',
        ],
        'config_share' => [
            'config_title' => 'Cài đặt chia sẻ',
            'hastag' => 'Hastag',
            'quote' => 'Quote',
            'utm_campaign' => 'UTM Campaign',
            'utm_source' => 'UTM Source',
            'utm_medium' => 'UTM Medium',
        ]
    ]
];
