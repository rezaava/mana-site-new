<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentSiteController;
use App\Http\Controllers\TeacherSiteController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\UserStatsController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SiteTextController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UploadController;


Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/services/{slug}', [SiteController::class, 'servise'])->name('servise');

Route::post('/upload/video', [UploadController::class, 'uploadVideo'])->name('upload.video');
Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/blog', [BlogsController::class, 'blog'])->name('blog');
Route::get('/blog/{id}/{slug}', [BlogsController::class, 'singleBlog'])->name('singleBlog');

Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/role', [AuthController::class, 'roleFun']);

Route::prefix('/teacher')->middleware(['role:teacher|admin'])->group(function () {
    Route::get('/', [TeacherSiteController::class, 'index'])->name('index_teacher');
});

Route::prefix('/student')->middleware(['role:student|admin'])->group(function () {
    Route::get('/', [StudentSiteController::class, 'index'])->name('index_student');
});


Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {

    // متن‌های سایت
    Route::get('/site-texts', [SiteTextController::class, 'index'])->name('site-texts.index');
    Route::post('/site-texts', [SiteTextController::class, 'update'])->name('site-texts.update');
    Route::get('/', [SiteController::class, 'index_admin'])->name('home');

    // صفحات
    Route::get('/pages', [ServiceController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [ServiceController::class, 'create'])->name('pages.create');
    Route::post('/pages', [ServiceController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [ServiceController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/{id}', [ServiceController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}', [ServiceController::class, 'destroy'])->name('pages.destroy');

    // نظرات
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}/unapprove', [CommentController::class, 'unapprove'])->name('comments.unapprove');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

    // پشتیبانی
    Route::get('/support', [TicketController::class, 'index'])->name('support.index');
    Route::get('/support/{id}', [TicketController::class, 'show'])->name('support.show');
    Route::get('/support/{id}/close', [TicketController::class, 'close'])->name('support.close');
    Route::delete('/support/{id}', [TicketController::class, 'destroy'])->name('support.destroy');

    // دسته‌بندی‌ها
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Projects
    Route::prefix('/projects')->group(function () {
        // Blade
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::post('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // API
        Route::post('/create-project', [ProjectController::class, 'createProject'])->name('create_project');
        Route::put('/edit-project/{id}', [ProjectController::class, 'editeProject'])->name('edit_project');
        Route::get('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('delete_project');

        // Images
        Route::post('/projects/{projectId}/images', [ProjectController::class, 'addImageToProject'])->name('add_project_image');
        Route::get('/images/{imageId}', [ProjectController::class, 'deleteImageFromProject'])->name('delete_project_image');

        // Features
        Route::post('/projects/{projectId}/features', [ProjectController::class, 'addFeatureToProject'])->name('add_project_feature');
        Route::get('/features/{featureId}', [ProjectController::class, 'deleteFeatureFromProject'])->name('delete_project_feature');

        // Number
        Route::post('/change-project-number/{projectId}/number', [ProjectController::class, 'changeNumberOfProject'])->name('change_project_number');
    });



    // Questions Routes
    Route::prefix('questions')->group(function () {
        Route::get('/', [QuestionsController::class, 'index'])->name('questions.index');
        Route::get('/create', [QuestionsController::class, 'create'])->name('questions.create');
        Route::post('/', [QuestionsController::class, 'store'])->name('questions.store');
        Route::get('/{id}/edit', [QuestionsController::class, 'edit'])->name('questions.edit');
        Route::post('/{id}', [QuestionsController::class, 'update'])->name('questions.update');
        Route::delete('/{id}', [QuestionsController::class, 'destroy'])->name('questions.destroy');
    });

    Route::prefix('/blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogsController::class, 'index'])->name('index');
        Route::get('/create', [BlogsController::class, 'create'])->name('create');
        Route::post('/', [BlogsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BlogsController::class, 'edit'])->name('edit');
        Route::post('/{id}', [BlogsController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogsController::class, 'destroy'])->name('destroy');
        Route::get('/all_blogs', [SiteController::class, 'all_blogs'])->name('all_blogs');
        Route::get('/blog/{id}', [SiteController::class, 'singleBlog'])->name('singleBlog');
    });

    Route::prefix('/team')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('team.index');
        Route::get('/create-team', [TeamController::class, 'create'])->name('create_team_form');
        Route::post('/create-team', [TeamController::class, 'store'])->name('create_team');
        Route::get('/edit-team/{id}', [TeamController::class, 'edit'])->name('edit_team_form');
        Route::post('/edit-team/{id}', [TeamController::class, 'update'])->name('update_team');
        Route::delete('/delete-team/{id}', [TeamController::class, 'destroy'])->name('destroy_team');
    });

    Route::prefix('/images')->group(function () {
        Route::post('/store-image', [ImageController::class, 'store_image'])->name('store_image');
        Route::put('/edit-image/{id}', [ImageController::class, 'edit_image'])->name('edit_image');
        Route::get('/delete-image/{id}', [ImageController::class, 'delete_image'])->name('delete_image');
    });

    Route::prefix('socials')->group(function () {
        Route::get('/', [SocialsController::class, 'index'])->name('socials.index');
        Route::get('/create', [SocialsController::class, 'create'])->name('socials.create');
        Route::post('/', [SocialsController::class, 'store'])->name('socials.store');
        Route::get('/{id}/edit', [SocialsController::class, 'edit'])->name('socials.edit');
        Route::post('/{id}', [SocialsController::class, 'update'])->name('socials.update');
        Route::delete('/{id}', [SocialsController::class, 'destroy'])->name('socials.destroy');
    });

});

Route::prefix('projects')->group(function () {
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('projects.show');
});