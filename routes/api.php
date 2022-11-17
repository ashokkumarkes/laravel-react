<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class,'login']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('logout', [AuthController::class],'logout');
    Route::post('refresh', [AuthController::class],'refresh');
    Route::post('me', [AuthController::class],'me');
});

Route::get('/users',function(){
    $users = User::latest()->get();
    return response()->json($users);
});

// Route::post('/add-user',[UserController::class,'store'])->name('add-user');
Route::post('/add-user',function(Request $request){
    
   User::create(
    [
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]
   );
})->name('add-user');

Route::get('/edit/{id}',[UserController::class,'find']);
Route::post('/update',[UserController::class,'update']);
Route::get('/delete/{id}',[UserController::class,'delete']);
