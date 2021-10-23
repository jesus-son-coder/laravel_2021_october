<?php

namespace App\Http\Controllers\Learning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JavaScriptController extends Controller
{

    public function radioButton()
    {
        return view('posts.radio-button-lesson');
    }
}
