<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentSiteController;
use App\Http\Controllers\TeacherSiteController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;


use App\Http\Controllers\TestController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');


Route::get('/courses', [TestController::class, 'courses'])->name('courses');
Route::get('/publics', [TestController::class, 'publics'])->name('publics');
Route::get('/exams', [TestController::class, 'exams'])->name('exams');
Route::get('/surveys', [TestController::class, 'surveys'])->name('surveys');
Route::get('/content', [TestController::class, 'content'])->name('content');
Route::get('/create-quiz', [TestController::class, 'createQuiz'])->name('createQuiz');
Route::get('/quizzes', [TestController::class, 'quizzes'])->name('quizzes');









Route::get('/role', [AuthController::class, 'roleFun']);

Route::prefix('/teacher')->middleware(['role:teacher|admin'])->group(function () {
    Route::get('/', [TeacherSiteController::class, 'index'])->name('index_teacher');
});

Route::prefix('/student')->middleware(['role:student|admin'])->group(function () {
    Route::get('/', [StudentSiteController::class, 'index'])->name('index_student');
});


Route::prefix('/admin')->middleware(['role:admin'])->group(function () {
    Route::get('/', function(){return view('admin.panel');})->name('admin_panel');
    // Projects
    Route::prefix('/projects')->group(function () {
        Route::post('/create-project', [ProjectController::class, 'createProject'])->name('create_project');
        Route::put('/edit-project/{id}', [ProjectController::class, 'editeProject'])->name('edit_project');
        Route::get('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('delete_project');
        Route::get('/projects', [ProjectController::class, 'returnAllProjects'])->name('all_projects');
        Route::get('/projects/{id}', [ProjectController::class, 'returnProjectById'])->name('project_by_id');

        // Images
        Route::post('/projects/{projectId}/images', [ProjectController::class, 'addImageToProject'])->name('add_project_image');
        Route::get('/images/{imageId}', [ProjectController::class, 'deleteImageFromProject'])->name('delete_project_image');

        // Features
        Route::post('/projects/{projectId}/features', [ProjectController::class, 'addFeatureToProject'])->name('add_project_feature');
        Route::get('/features/{featureId}', [ProjectController::class, 'deleteFeatureFromProject'])->name('delete_project_feature');

        // Number
        Route::post('/change-project-number/{projectId}/number', [ProjectController::class, 'changeNumberOfProject'])->name('change_project_number');
    });
    
    Route::prefix('/questions')->group(function () {
         Route::post('/create-question', [QuestionController::class, 'createQuestion'])->name('create_question');
    Route::post('/edit-question/{id}', [QuestionController::class, 'updateQuestion'])->name('update_question');
    Route::get('/delete-question/{id}', [QuestionController::class, 'deleteQuestion'])->name('delete_question');
    Route::get('/questions', [QuestionController::class, 'getAllQuestions'])->name('all_questions');
    Route::post('/change-question-number/{id}/number', [QuestionController::class, 'changeNumber'])->name('change_question_number');
    });
    
});