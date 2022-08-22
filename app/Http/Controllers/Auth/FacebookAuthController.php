<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Facebook;
use Illuminate\Support\Facades\Log;
use App\Helpers\FileHelper;
use App\Models\System\User;

use Session;
use Auth;

class FacebookAuthController extends Controller
{
    private $appId;
    private $appSecret;
    private $appVersion;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->appId = config('system.apikey_facebook_app_id');
        $this->appSecret = config('system.apikey_facebook_app_secret');
        $this->appVersion = 'v2.7';
    }

    public function getFacebookObject()
    {
        return new Facebook([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'default_graph_version' => $this->appVersion
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkLogin(Request $request)
    {
        $user = Auth::user();

        $redirect = $request->input('redirect', url('?fbRedirect=1'));
        Session::put('redirect', $redirect);
        $request->session()->put('redirect', $redirect);

        $fb = $this->getFacebookObject();

        $helper = $fb->getRedirectLoginHelper();
        //$permissions = ['email,user_link'];
        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl(url('facebook/login'), $permissions);

        if (!$user) {
            return $this->ajaxRespond(2, 'Bạn phải đăng nhập để tham gia cuộc thi!', [
                'login_url' => $loginUrl
            ]);
        }

        return $this->ajaxRespond(1, 'Logged in', $user);
    }

    /**
     * Login facebook with access token
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        $fb = $this->getFacebookObject();

        $accessToken = $request->input('accessToken', '');
        $code = $request->input('code', '');

        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }

        try {
            $accessToken = $code ? $helper->getAccessToken() : $accessToken;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return $this->respond(0, $e->getMessage(), [], $request);
        }

        if ($accessToken) {

            $fb->setDefaultAccessToken($accessToken);

            // Logged in
            try {
                $response = $fb->get('/me?fields=id,name,email', $accessToken);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                return $this->respond(0, 'Facebook SDK returned an error: ' . $e->getMessage(), [], $request);
            }

            $me = $response->getGraphUser();
            $user = new \stdClass();
            $user->id = $me->getId();
            $user->name = $me->getName();
            $user->email = $me->getEmail();

            $authUser = $this->findOrCreateUser($user, $accessToken);

            if (is_object($authUser)) {
                Auth::login($authUser, true);

                return $this->respond(1, 'Bạn đã đăng nhập bằng Facebook thành công!', [], $request);
                //Session::flash('message', 'Bạn đã đăng nhập bằng Facebook thành công!');
                //return redirect(Session::get('redirect', url('?fbRedirect=1')));
            } else {
                return $this->respond(0, 'Lỗi khi đăng nhập bằng tài khoản Facebook: ' . $authUser, [], $request);
            }

        } else {
            return $this->respond(0, 'Bad request', [], $request);
        }
    }

    public function respond($code, $message = '', $data = [], $request)
    {
        if (!$code){
            Log::info($message);
        }

        if ($request->ajax()) {
            return $this->ajaxRespond($code, $message, $data);

        } else{
            $request->session()->flash('message', $message);

            if($code){
                //$link = Session::get('redirect', url('/?fbRedirect=1'));
                $link = $request->session()->pull('redirect', url('/?fbRedirect=1'));
                return redirect($link);

            }else{

                return redirect('/');
            }
        }
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $facebookUser->email = (strpos($facebookUser->email, '@') === false) ? $facebookUser->id . '@facebook.com' : $facebookUser->email;

        $ext = explode('@', $facebookUser->email);
        $ext = explode('.', $ext[1]);

        $endExt = $ext[count($ext) - 1];
        $firstExt = $ext[0];
        $domains = ['facebook', 'gmail', 'yahoo', 'live', 'hotmail', 'outlook', 'icloud',
            'ymail', 'unilever', 'msn', 'thegioididong', 'nokiamail'];

        if (!in_array($firstExt, $domains) && $endExt != 'vn') {
            Log::info($facebookUser->email);

            $msg = 'Đăng nhập thất bại với email: ' . $facebookUser->email . '. <br/>' .
                'BTC chỉ chấp nhận các tài khoản Facebook được đăng ký bằng số điện thoại, gmail, yahoo mail, live mail, hot mail, outlook, icloud!<br/>';

            return $msg;
        }

        $fileContents = @file_get_contents("http://graph.facebook.com/" . $facebookUser->id . "/picture?redirect=false");
        if ($fileContents) {
            $fileContents = json_decode($fileContents);
            if (is_object($fileContents) && $fileContents->data && $fileContents->data->is_silhouette) {
                Log::info($facebookUser);
                return 'Tài khoản Facebook với Avatar không hợp lệ!';
            }
        }

        $authUser = User::where('facebook_id', $facebookUser->id)->orWhere('email', $facebookUser->email)->first();

        if ($authUser) {
            /*$authUser->update([
                'facebook' => isset($facebookUser->link) ? $facebookUser->link : $facebookUser->name,
            ]);*/
            return $authUser;
        }

        $avatar = FileHelper::getMediaLink();
        $fileContents = @file_get_contents("http://graph.facebook.com/" . $facebookUser->id . "/picture?type=large");
        FileHelper::saveFile($avatar, $fileContents);

        try {
            $userObject = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                //'facebook' => isset($facebookUser->link) ? $facebookUser->link : $facebookUser->name,
                'facebook' => $facebookUser->name,
                'avatar' => $avatar,
                'password' => '',
            ]);

        } catch (\Exception $e) {
            $userObject = User::where('facebook_id', $facebookUser->id)->orWhere('email', $facebookUser->email)->first();
            Log::info('Error: ' . $e->getMessage());
            Log::info('Return: ' . $userObject);
        }

        return $userObject;
    }
}
