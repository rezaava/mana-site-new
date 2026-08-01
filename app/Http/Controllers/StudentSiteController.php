<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSiteController extends Controller
{
    function index() {
        return view('student.index');
    }
}
