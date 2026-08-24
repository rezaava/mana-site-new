<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Projects;
use App\Models\Services;
use App\Models\Team;
use App\Models\Blogs;
use App\Models\Comments;
use App\Models\Socials;
use Auth;

class TestController extends Controller
{
    public function index()
    {
        $projects = Projects::latest()->get();
        $services = Services::latest()->get();
        $teams = Team::latest()->get();
        $blogs = Blogs::latest()->take(6)->get();
        $comments = Comments::where('is_approved', true)->latest()->take(4)->get();
        $socials = Socials::latest()->get();
        $services = Services::orderBy('number', 'asc')->get();
        return view('index', compact('projects', 'services', 'teams', 'blogs', 'comments', 'socials'));
    }

    public function courses()
    {
        return view('courses');
    }

    public function publics()
    {
        return view('publics');
    }

    public function exams()
    {
        return view('exams');
    }

    public function surveys()
    {
        return view('surveys');
    }

    public function content()
    {
        return view('content');
    }

    public function createQuiz()
    {
        return view('create-quiz');
    }

    public function quizzes()
    {
        return view('quizzes');
    }
}
