<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

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

Route::post("register", [AuthController::class, "register"]);
Route::post("logout", [AuthController::class, "logout"]);
Route::post("login", [AuthController::class, "login"]);

Route::resource('meals', MealController::class);

Route::middleware(['auth:sanctum'])->group(function () {

    // User actions
    Route::post('/users/{userId}/follow', [UserController::class, 'followUser']);
    Route::post('/users/{userId}/unfollow', [UserController::class, 'unfollowUser']);
    // Restaurant actions
    Route::post('/restaurants/{restaurantId}/like', [RestaurantController::class, 'likeRestaurant']);
    Route::post('/restaurants/{restaurantId}/unlike', [RestaurantController::class, 'unlikeRestaurant']);

    Route::post('/restaurants/{restaurantId}/save', [RestaurantController::class, 'saveRestaurant']);
    Route::post('/restaurants/{restaurantId}/unsave', [RestaurantController::class, 'unsaveRestaurant']);

    Route::resource('reviews', ReviewController::class);

    Route::resource('restaurants', RestaurantController::class);
    Route::resource('users', UserController::class);
    Route::resource('menucategory', MenuCategoryController::class);
    Route::post('/promotions', [PromotionController::class, 'create']);

    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications']);
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markNotificationsAsRead']);
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markNotification']);
    Route::get('/notifications/all', [NotificationController::class, 'getAllNotifications']);
});
