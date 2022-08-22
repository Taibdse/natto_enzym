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

class GoogleAuthController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getGoogle(){
        return \Laravel\Socialite\Facades\Socialite::driver('google')->scopes(['profile','email'])->redirect();
    }

    public function setGoogle(){
        try {
            $user = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/google');
        }

        $data = [];
        $data['name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $data['google_id'] = $user->getId();

        $avatar = 'media/' . date('Y-m') . '/' . date('d').'/'.time().rand(1,10).'.jpg';
        $fileContents = @file_get_contents($user->avatar_original);
        FileHelper::saveFile($avatar, $fileContents);

        $data['avatar'] = $avatar;

        $check = User::where('email', $data['email'])->orWhere('google_id', $data['google_id'])->first();
        if($check){
            Auth::loginUsingId($check->id);
        }else{
            $user = User::create($data);
            Auth::loginUsingId($user->id);
        }

        return redirect('/?fbRedirect=1');
    }

}
