<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\System\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage($lang)
    {
        $checkValidLanguage = Language::where('locale', $lang)->count();

        if ($checkValidLanguage <= 0) {
            return redirect()->back();
        }

        App::setLocale($lang);
        Session::put('localeLanguage', $lang);
        return redirect()->back();

    }
}
