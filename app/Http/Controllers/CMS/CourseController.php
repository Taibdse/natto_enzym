<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\GmailHelper;
use App\Http\Controllers\Controller;
use App\Models\CMS\Questions;
use App\Models\CMS\VideosCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\System\User;
use Session;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $categoryModel;
    public $questionModel;
    public $videoModel;

    public function __construct(Questions $questions, VideosCourse $videos)
    {
        // Localhost only
        if(env('APP_DEBUG', false)) {
            $user = User::find(9);
            Auth::login($user);
        }

        $this->questionModel = $questions;
        $this->videoModel = $videos;
    }

    public function videos() {
        return view('natto.pages.rule');
    }

    public function questions() {
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        if ($user->others) {
            return redirect('/course/videos')->with('message', 'Bạn đã hoàn thành khóa học! Cảm ơn bạn đã tham gia và chúc bạn thật nhiều sức khỏe');
        }

        return view('natto.pages.online_quiz');
    }

    public function getQuestions()
    {
        $topic = rand(0, 4);
        $questions = $this->questionModel
            ->search()
            ->where('is_hot', $topic)
            ->select('id', 'title', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'answer_5')
            ->limit(10)
            ->get();
        Session::put('process_time', Carbon::now());
        Session::put('question_topic', $topic);
        return $this->ajaxRespond(1, '', $questions);
    }

    public function getVideos()
    {
        $videos = $this->videoModel->search()->select('id', 'title', 'video_link', 'image')->limit(5)->get();
        return $this->ajaxRespond(1, '', $videos);
    }

    public function checkResult(Request $request)
    {
        $requestData = $request->all();
        $scores = 0;
        $user = Auth::user();
        $topic = Session::get('question_topic', '');

        if ($user->others) {
            return $this->ajaxRespond(2, 'Bạn đã hoàn thành khóa học! Cảm ơn bạn đã tham gia và chúc bạn thật nhiều sức khỏe', null);
        }

        $questions = $this->questionModel->search()->where('is_hot', $topic)->limit(10)->get();

        foreach ($questions as $key => $question) {
            if ($question->correct == (int) $requestData[$key]) {
                $scores++;
            }
        }

        $scores *= 10;
        $now = Carbon::now();
        $processTime = $now->diff(Session::get('process_time', 0))->format('%i:%s');

        if ($scores > 80) {
            $updated = $user->update([
                'others' => $scores
            ]);

            if ($updated) {
                // Send mail here
                $subject = "NattoEnzym - Chứng Nhận Hoàn Thành Khoá Học";
                $template = view('emails.quiz.quiz_result')->with('name', $user->name)->render();
                $sent = GmailHelper::sendEmail($user->email, $subject, $template);
                if (!$sent) {
                    Log::info('Send mail fail: '. $user->email);
                }
                ///

                return $this->ajaxRespond(1, 'Ok', ['scores' => $scores, 'time' => $processTime]);
            }
        }
        else {
            return $this->ajaxRespond(1, 'Not reached', ['scores' => $scores, 'time' => $processTime]);
        }
    }

    public function checkInfo()
    {
        $user = Auth::user();
        if ($user && $user->mobile) {
            return $this->ajaxRespond(1, '', true);
        }
        else {
            return $this->ajaxRespond(1, '', false);
        }
    }

    public function updateUser(Request $request)
    {
        $requestData = $request->all();
        $user = Auth::user();
        $bugs = [];

        $messages = [
            'mobile.required' => 'Bạn phải nhập Số điện thoại',
            'mobile.digits_between' => 'Định dạng số điện thoại không hợp lệ',
            'mobile.numeric' => 'Định dạng số điện thoại không hợp lệ',
            'name.required' => 'Bạn phải nhập Họ tên',
            'email.required' => 'Bạn phải nhập Email',
            'email.email' => 'Định dạng email không hợp lệ',
            'email.unique' => 'Email bạn nhập đã được sử dụng',
            'gender.required' => 'Bạn phải chọn Giới tính',
            'day.required' => 'Bạn phải chọn một Ngày sinh',
            'month.required' => 'Bạn phải chọn một Tháng sinh',
            'year.required' => 'Bạn phải chọn một Năm sinh',
        ];
        $rules = [
            'name' => 'required',
            'mobile' => 'required|numeric|digits_between:10,10',
            'email' => 'required|email|unique:users,email,' . $user->id,
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

        $birth_day = date('Y-m-d', mktime(0,0, 0, $requestData['month'], $requestData['day'], $requestData['year']));

        if ($user) {
            $contactData = [
                'name'  => makeSafe($requestData['name']),
                'mobile'  => makeSafe($requestData['mobile']),
                'email'  => makeSafe($requestData['email']),
                'gender'  => makeSafe($requestData['gender']),
                'birthday'  => $birth_day,
                'status' => 2,
            ];

            $contact = $user->update($contactData);

            return $this->ajaxRespond(
                1,
                '',
                $contact
            );
        }
    }

}
