<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        $supportedLocales = ['en', 'id'];

        if (! in_array($locale, $supportedLocales)) {
            abort(400);
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        return Redirect::back();
    }
}

