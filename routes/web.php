<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizzCategoryController;
use App\Http\Controllers\Admin\TopicAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MemberQuizController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestQuizController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UploadController;
use App\Models\QuizCategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Question\Question;

Route::get('/403', function () {
    return view('errors.403');
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

//Google Login
Route::get('login/google', [App\Http\Controllers\UserController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\UserController::class, 'handleGoogleCallback']);

//Facebook Login
Route::get('login/facebook', [App\Http\Controllers\UserController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\UserController::class, 'handleFacebookCallback']);


//Client
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login/store', [UserController::class, 'store'])->name('login.store');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/forgot-password', [UserController::class, 'forgotPass'])->name('password.reset');
Route::post('/forgot-password', [UserController::class, 'postEmail']);
Route::get('/update-password/{token}', [UserController::class, 'getPassword']);
Route::post('/update-password', [UserController::class, 'postPassword']);
Route::post('/user/store', [UserController::class, 'create'])->name('user.store');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/{id}/Category-detail', [TopicController::class, 'showDetail']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/change-password', [UserController::class, 'updatePass'])->name('user.changePassword');
    Route::put('/users', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/updateAvatar', [UserController::class, 'updateAvatar']);
    Route::post('/upload/services', [UploadController::class, 'store']);
    Route::post('/upload/remove', [UploadController::class, 'remove']);

    Route::group(['prefix' => 'admin', 'middleware' => ['is-admin']], function () {
        Route::get('/topic', [TopicAdminController::class, 'index'])->name('admin.topic');
        Route::get('/db/topic', [TopicAdminController::class, 'index_db'])->name('db.topic.view');
        Route::get('/db/topic/add', [TopicAdminController::class, 'add_topic'])->name('db.topic.add');
        Route::get('/db/category/add', [TopicAdminController::class, 'add_category'])->name('db.category.add');
        Route::get('/add-topic/{name}', [TopicAdminController::class, 'checkUnique']);
        Route::post('/add-topic', [TopicAdminController::class, 'createTopic']);
        Route::put('/update-topic', [TopicAdminController::class, 'update']);
        Route::get('/ajaxDeleteTopic/{id}', [TopicAdminController::class, 'ajaxDelete']);

        Route::get('/add-category', [TopicAdminController::class, 'createCategory'])->name('admin.addCategory');
        Route::post('/add-category', [TopicAdminController::class, 'storeCategory']);
        Route::get('/getcategory/{id}', [TopicAdminController::class, 'getChildrenTopic']);
        Route::get('/category/{id}/delete', [TopicAdminController::class, 'delete']);
        Route::get('/ajaxGetCategory/{id}', [TopicAdminController::class, 'getAjax']);
        Route::put('/UpdateCategory', [TopicAdminController::class, 'UpdateCat']);

        Route::get('/listQuizTest/{id}', [QuizzCategoryController::class, 'show']);
        Route::get('/Quiz', [QuizzCategoryController::class, 'quiz_db'])->name('db.quiz');
        Route::get('/QuizTest/{id}', [QuizzCategoryController::class, 'get']);

        Route::get('/ListQuizTest/{id}', [QuizzCategoryController::class, 'getQuestion']);
        Route::post('/add-quizcategory', [QuizzCategoryController::class, 'store']);
        Route::put('/update-quizcategory', [QuizzCategoryController::class, 'update']);
        Route::get('/add-quizcategory', [QuizzCategoryController::class, 'index']);
        Route::get('/quizcategory/{id}/delete', [QuizzCategoryController::class, 'delete']);

        Route::get('/question', [QuestionController::class, 'index'])->name('db.question');
        Route::get('/question/{id}', [QuestionController::class, 'getOne']);
        Route::put('/question', [QuestionController::class, 'update']);
        Route::get('/add-question/{id}', [QuestionController::class, 'create']);
        Route::post('/add-question', [QuestionController::class, 'store']);
        Route::get('/question/{id}/delete', [QuestionController::class, 'delete']);
        Route::get('/QuestionByQuiz/{id}', [QuestionController::class, 'getQuestionByQuiz']);

        Route::post('/add-option', [OptionController::class, 'store']);
        Route::get('/option/new', [OptionController::class, 'new']);
        Route::post('/checkOptionUnique', [OptionController::class, 'checkOptionUnique']);
        Route::post('/addOptionAndUpdate', [OptionController::class, 'storeAjax']);
        Route::get('/get-option/{id}', [OptionController::class, 'getByQuestion']);
        Route::get('/option/{id}/get', [OptionController::class, 'edit']);
        Route::get('/option/{id}/delete', [OptionController::class, 'delete']);
        Route::post('/UpdateOption', [OptionController::class, 'update']);
    });

    Route::middleware('is-member')->group(function () {
        Route::get('/topic', [TopicController::class, 'index'])->name('member.topic');
        Route::get('/topic/{key}', [TopicController::class, 'searchTopic']);

        Route::get('/myquiz', [MemberQuizController::class, 'index'])->name('member.myquiz');
        Route::get('/addCatToMyQuiz/{id}', [MemberQuizController::class, 'create'])->name('member.addCat');
        Route::get('/{id}/chooseQuiz', [MemberQuizController::class, 'ChooseQuiz']);
        Route::get('/start/{id}', [QuizController::class, 'start']);
        Route::get('/get-question/{id}', [QuizController::class, 'getById']);

        Route::get('/category/search/{key}', [TopicController::class, 'search']);
        Route::get('/category/searchAll/{key}', [TopicController::class, 'searchAll']);


        Route::get("/ajax/save_answer_insesion/{optionid}/{questionid}", [MemberQuizController::class, 'save_answer_insesion']);
        Route::post('/result', [MemberQuizController::class, 'result']);
        Route::post('/storeReport', [ReportController::class, 'store']);
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('is-admin')->name('dashboard');
});
