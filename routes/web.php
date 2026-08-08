<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentSiteController;
use App\Http\Controllers\TeacherSiteController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\ImageController;
// use App\Http\Controllers\BlogsController;
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


Route::prefix('/admin')->group(function () {
    //->middleware(['role:admin'])
    //این قسمت برای تست صرفا شماره بندی شد تا بین 2 تا ویو جا به جا شوم
    Route::get('/1', function(){return view('admin.panel');})->name('admin_panel');
    Route::get('/2', function(){return view('admin.dashboard');})->name('admin_dashboard');

    // بازدیدکنندگان
    Route::get('/visitors', function(){return view('admin.visitors');})->name('admin_visitors');

    // فروش
    Route::get('/sales', function(){return view('admin.sales');})->name('admin_sales');

    // آمار کاربران
    Route::get('/users-stats', function(){return view('admin.users-stats');})->name('admin_users_stats');

    // مقالات
    Route::get('/posts', function(){return view('admin.posts');})->name('admin_posts');

    // صفحات
    Route::get('/pages', function(){return view('admin.pages');})->name('admin_pages');

    // نظرات
    Route::get('/comments', function(){return view('admin.comments');})->name('admin_comments');

    // کاربران
    Route::get('/users', function(){return view('admin.users');})->name('admin_users');

    // تنظیمات
    Route::get('/settings', function(){return view('admin.settings');})->name('admin_settings');

    // پشتیبانی
    Route::get('/support', function(){return view('admin.support');})->name('admin_support');

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

    Route::prefix('/services')->group(function () {
        Route::post('/create-service', [ServiceController::class, 'createService'])->name('create_service');
        Route::put('/edit-service/{id}', [ServiceController::class, 'updateService'])->name('edit_service');
        Route::get('/delete-service/{id}', [ServiceController::class, 'deleteService'])->name('delete_service');
        Route::get('/services', [ServiceController::class, 'getAllServices'])->name('all_services');
        Route::post('/change-service-number/{id}/number', [ServiceController::class, 'changeNumber'])->name('change_service_number');
        Route::post('/change-service-image/{id}/image', [ServiceController::class, 'changeImage'])->name('change_service_image');
    });

    Route::prefix('/teams')->group(function () {
        Route::post('/create-team', [TeamController::class, 'create'])->name('create_team');
        Route::put('/edit-team/{id}', [TeamController::class, 'edit'])->name('edit_team');
        Route::get('/delete-team/{id}', [TeamController::class, 'delete'])->name('delete_team');
    });

    Route::prefix('/images')->group(function () {
        Route::post('/store-image', [ImageController::class, 'store_image'])->name('store_image');
        Route::put('/edit-image/{id}', [ImageController::class, 'edit_image'])->name('edit_image');
        Route::get('/delete-image/{id}', [ImageController::class, 'delete_image'])->name('delete_image');
    });

    Route::prefix('/socials')->group(function () {
        Route::post('/create-social', [SocialsController::class, 'create'])->name('create_social');
        Route::put('/edit-social/{id}', [SocialsController::class, 'edit'])->name('edit_social');
        Route::get('/delete-social/{id}', [SocialsController::class, 'delete'])->name('delete_social');
    });

    // Route::prefix('/blogs')->group(function () {
    //     Route::post('/create-blog', [BlogsController::class, 'create'])->name('create_blog');
    //     Route::put('/edit-blog/{id}', [BlogsController::class, 'edit'])->name('edit_blog');
    //     Route::get('/delete-blog/{id}', [BlogsController::class, 'delete'])->name('delete_blog');
    // });
});
