<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\CategorieProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DocumentationController;
use App\Http\Controllers\Api\DefaultController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\FichiersController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['cors', 'json.response']], function () {
    // Route::post('forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    // public routes
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
// Password reset link request routes...
//Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
   // Route::post('password/reset', 'Auth\PasswordController@postReset');

        // Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetLinkEmail']);
        // Route::post('/password/reset',  [ResetPasswordController::class, 'reset']);
        // Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
        // Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    });
    //Protected routes
    Route::group([
        'middleware' => ['auth:api'],
    ], function () {
        Route::post('changePassword', [AuthController::class, 'changePassword'])->name('changePassword');

       // Route::post('users/{id}', [UserController::class, 'assigneRoleToUser'])->name('assigneRoleToUser');
        Route::apiResource('users', UserController::class);
        Route::apiResource('roles', RoleController::class)->only(['index']);
        
        Route::apiResource('fichiers', FichiersController::class);
        Route::apiResource('entreprises', EntrepriseController::class);
        Route::apiResource('categorie_produits', CategorieProductController::class);
        Route::apiResource('produits', ProductController::class);
        
        Route::apiResource('settings', SettingController::class);
        
        Route::apiResource('applications', ApplicationController::class)->middleware('client');

    });
});


    Route::resource('applications', ApplicationController::class)->only([
        'index', 'show'
    ]);

    Route::resource('fichiers', FichiersController::class)->only([
        'index', 'show'
    ]);

    Route::resource('settings', SettingController::class)->only([
        'index', 'show'
    ]);

    Route::post('search', [SearchController::class, 'searchAll']);
