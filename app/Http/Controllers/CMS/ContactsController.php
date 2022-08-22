<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Test;
use Illuminate\Http\Request;
use App\Models\CMS\Contact;
use Illuminate\Support\Facades\Validator;
use App\Helpers\NotificationHelper;
use App\Models\Shop\Product;

use Auth;
use Illuminate\Support\Facades\Session;

class ContactsController extends Controller
{
    public $baseModel;
    public $questions;

    public function __construct()
    {
        $this->baseModel = new Contact();
    }

    public function create()
    {
        $this->questions = config('test.questions');
        return view('natto.pages.health_check')->with('questions', $this->questions);
    }

    public function test(Request $request)
    {
        $user = Auth::user();
        $requestData = $request->all();
        $results = $requestData['results'];
        $scores = 0;
        $messages = '';
        $title = '';

        $this->questions = config('test.questions');
        $advice = config('test.advice');

        foreach ($results as $key => $result) {
            $answer = $this->questions[$key]['answer'][$result];
            if ($answer['value']) {
                $scores += $answer['value'];
            }
        }

        if ($scores <= 3) {
            $title = $advice[0]['title'];
            $messages = $advice[0]['content'];
        }
        elseif ($scores <= 5) {
            $title = $advice[1]['title'];
            $messages = $advice[1]['content'];
        }
        elseif ($scores <= 7) {
            $title = $advice[2]['title'];
            $messages = $advice[2]['content'];
        }
        elseif ($scores <= 9) {
            $title = $advice[3]['title'];
            $messages = $advice[3]['content'];
        }
        else {
            $title = $advice[4]['title'];
            $messages = $advice[4]['content'];
        }

        $testResult = [
            'score' => $scores,
            'results' => $results,
            'title' => $title,
            'messages' => $messages,
        ];

        return $this->ajaxRespond(
            1, '', $testResult
        );

    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $user = Auth::user();
        $bugs = [];

        if ($request->ajax()) {
            $messages = [
                'mobile.required' => 'Bạn phải nhập Số điện thoại',
                'mobile.digits_between' => 'Định dạng số điện thoại không hợp lệ',
                'mobile.numeric' => 'Định dạng số điện thoại không hợp lệ',
                'name.required' => 'Bạn phải nhập Họ tên',
                'email.required' => 'Bạn phải nhập Email',
                'email.email' => 'Định dạng email không hợp lệ',
                'gender.required' => 'Bạn phải chọn Giới tính',
                'day.required' => 'Bạn phải chọn một Ngày sinh',
                'month.required' => 'Bạn phải chọn một Tháng sinh',
                'year.required' => 'Bạn phải chọn một Năm sinh',
            ];
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric|digits_between:10,10',
                'email' => 'required|email',
                'gender' => 'required',
                'day' => 'required',
                'month' => 'required',
                'year' => 'required',
            ];

            $validator = Validator::make($requestData, $rules, $messages);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                foreach ($errors as $error) {
                    $bugs[] = $error[0];
                }
            }

            if (count($bugs)) {
                $message = 'Ops<br/>' . join('<br/>', $bugs);
                return $this->ajaxRespond(0, $message);
            }

            $birth_day = date('d/m/Y', mktime(0,0, 0, $requestData['month'], $requestData['day'], $requestData['year']));

            $contactData = [
                'name'  => makeSafe($requestData['name']),
                'mobile'  => makeSafe($requestData['mobile']),
                'email'  => makeSafe($requestData['email']),
                'gender'  => makeSafe($requestData['gender']),
                'birth_day'  => $birth_day,
                'status' => 2,
            ];

            $contact = $this->baseModel->create($contactData);

            return $this->ajaxRespond(
                1,
                '',
                $contact
            );

        }

    }

}
