<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LessonController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    

}
