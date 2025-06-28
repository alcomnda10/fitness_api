<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Admin\UserController;

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

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::put('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar']);
});;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin/stats', [AdminController::class, 'stats']);
    Route::get('/admin/products', [AdminController::class, 'products']);
    Route::get('/admin/orders', [AdminController::class, 'orders']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? response()->json(['message' => __($status)])
        : response()->json(['error' => __($status)], 400);
});
// Route::post('/orders', [OrderController::class, 'store']);
// Route::get('/products', [ProductController::class, 'index']);
Route::get('/features', [FeatureController::class, 'index']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::get('/team-members', [TeamMemberController::class, 'index']);
Route::apiResource('plans', PlanController::class)->only(['index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


Route::get('/orders', [OrderController::class, 'index']);
Route::middleware('auth:sanctum')->post('/orders', [OrderController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/plans', [PlanController::class, 'store']);
    // Route::get('/plans/{id}', [PlanController::class, 'show']);
});
Route::put('/plans/{id}', [PlanController::class, 'update']);
Route::get('/plans/{id}', [PlanController::class, 'show']);
Route::delete('/plans/{id}', [PlanController::class, 'destroy']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
Route::patch('/users/{id}/role', [UserController::class, 'updateRole']);


// Route::post('/proxy/ask', function (Request $request) {
//     $response = Http::post('https://gamalalzain.pythonanywhere.com/ask', [
//         'question' => $request->question
//     ]);

//     \Log::info('External API response:', $response->json());

//     return response()->json($response->json());
// });
Route::post('/proxy/ask', [ChatController::class, 'ask']);
