<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __invoke($locale)
    {
        return redirect()->back()->withCookie(cookie()->forever('language', $locale));
    }    
}
