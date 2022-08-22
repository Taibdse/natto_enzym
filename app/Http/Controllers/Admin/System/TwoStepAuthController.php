<?php
/**
 * TwoStepAuthController
 *
 * Controller for app
 * php version 7.0
 *
 * @category   StatusCommunication
 * @package    App\Http\Controllers
 * @subpackage TwoStepAuthController
 * @author     VinhCV <vinh@nomeo.be>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://status.nomeo.be
 * @since      1.0.0
 */
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\GoogleAuthenticator;

/**
 * TwoStepAuthController Class
 *
 * @category   StatusCommunication
 * @package    App\Http\Controllers
 * @subpackage HomeController
 * @author     VinhCV <vinh@nomeo.be>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://status.nomeo.be
 */
class TwoStepAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show scan barcode or input verify code
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view("auth.2fa.verify");

        $secretCode = auth()->user()->ga_code;
        if ($secretCode) {
            return view("auth.2fa.verify");
        } else {
            $googleAuthenticator = new GoogleAuthenticator();
            $secretCode = $googleAuthenticator->createSecret();

            $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
                auth()->user()->email,
                $secretCode,
                config("app.name")
            );

            session(["secret_code" => $secretCode]);
            return view("auth.2fa.scan", compact("qrCodeUrl"));
        }
    }

    /**
     * Enable 2FA for account
     *
     * @param Request $request App request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function enable(Request $request)
    {
        $this->validate(
            $request,
            [
            "code" => "required|digits:6"
            ]
        );

        $googleAuthenticator = new GoogleAuthenticator();
        $secretCode = session("secret_code");

        if (!$googleAuthenticator->verifyCode(
            $secretCode,
            $request->get("code"),
            0
        )
        ) {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add("code", "Invalid authentication code");

            return redirect()->back()->withErrors($errors);
        }

        $user = auth()->user();
        $user->ga_code = $secretCode;
        $user->save();

        // Redirect to admin
        session(["2fa_verified" => true]);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Verify 2FA code
     *
     * @param Request $request App request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function verify(Request $request)
    {
        $this->validate(
            $request,
            [
            "code" => "required|digits:6",
            ]
        );

        $googleAuthenticator = new GoogleAuthenticator();
        $secretCode = auth()->user()->ga_code;

        if (!$googleAuthenticator->verifyCode(
            $secretCode,
            $request->get("code"),
            0
        )
        ) {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add("code", "Invalid authentication code");

            return redirect()
                ->back()
                ->withErrors($errors)
                ->withInput();
        }

        session(["2fa_verified" => true]);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Generate GA Code
     *
     * @param Request $request Request data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateGAC(Request $request)
    {
        $email = $request->input('email');
        $secretCode = $request->input('secretCode');

        $googleAuthenticator = new GoogleAuthenticator();
        $secretCode = $secretCode ?? $googleAuthenticator->createSecret();

        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            $email,
            $secretCode,
            env("APP_NAME")
        );

        return $this->ajaxRespond(1, '', [
            'secretCode' => $secretCode,
            'qrCodeUrl' => $qrCodeUrl,
        ]);
    }
}
