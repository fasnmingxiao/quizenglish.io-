<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizzCategoryController;
use App\Http\Controllers\Admin\TopicAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MemberQuizController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/403', function () {
    return view('errors.403');
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/email/verify', [AuthController::class, 'index'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resend_token'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
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

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('db.user');
    Route::post('/ajax/user', [UserController::class, 'ajaxGetUser'])->name('ajax.user');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/change-password', [UserController::class, 'updatePass'])->name('user.changePassword');
    Route::put('/users', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/updateAvatar', [UserController::class, 'updateAvatar']);
    Route::post('/upload/services', [UploadController::class, 'store']);
    Route::post('/upload/remove', [UploadController::class, 'remove']);

    Route::group(['prefix' => 'admin', 'middleware' => ['is-admin']], function () {
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/remove/permission-from-role', [ManagementController::class, 'unsetpermission'])->name('management.unsetpermission');
    Route::post('/get-permission-diff', [ManagementController::class, 'getPermissionDiff'])->name('management.getpermissiondiff');

    Route::post('/add-role', [ManagementController::class, 'addRole'])->name('add.role');
    Route::post('/update-role', [ManagementController::class, 'updateRole'])->name('update.role');
    Route::get('/delete/{id}', [ManagementController::class, 'deleteRole'])->name('management.delete');
    Route::get('/role/{id}', [ManagementController::class, 'getRole'])->name('management.getRole');


        // Route::get('/topic', [TopicAdminController::class, 'index'])->name('admin.topic');
        Route::get('/db/topic', [TopicAdminController::class, 'index_db'])->name('db.topic.view');
        // Route::get('/db/topic/add', [TopicAdminController::class, 'add_topic'])->name('db.topic.add');
        // Route::get('/db/category/add', [TopicAdminController::class, 'add_category'])->name('db.category.add');
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
        Route::get('/add-quiz', [QuizzCategoryController::class, 'quiz_db'])->name('db.quiz');
        Route::get('/list-quiz', [QuizzCategoryController::class, 'quiz_list'])->name('db.quiz_list');
        Route::get('/QuizTest/{id}', [QuizzCategoryController::class, 'get']);
        Route::post('/ajax/quiz', [QuizzCategoryController::class, 'ajaxGetQuiz'])->name('ajax.quiz');

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
        Route::post('/ajax/option', [OptionController::class, 'ajaxGetOption'])->name('ajax.option');
        Route::get('/ajax/option/{id}', [OptionController::class, 'ajaxGetOptionByid'])->name('ajax.option.id');
        Route::get('/option/new', [OptionController::class, 'new']);
        Route::post('/checkOptionUnique', [OptionController::class, 'checkOptionUnique']);
        Route::post('/addOptionAndUpdate', [OptionController::class, 'storeAjax']);
        Route::get('/get-option/{id}', [OptionController::class, 'getByQuestion']);
        Route::get('/option/{id}/get', [OptionController::class, 'edit']);
        Route::get('/option/{id}/delete', [OptionController::class, 'delete']);
        Route::post('/UpdateOption', [OptionController::class, 'update'])->name('ajax.option.update');
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
