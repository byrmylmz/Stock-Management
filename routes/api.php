<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::ApiResource('/employee','App\Http\Controllers\Api\EmployeeController');
Route::ApiResource('/supplier','App\Http\Controllers\Api\SupplierController');
Route::ApiResource('/category','App\Http\Controllers\Api\CategoryController');
Route::ApiResource('/product','App\Http\Controllers\Api\ProductController');
Route::ApiResource('/expense','App\Http\Controllers\Api\ExpenseController');
Route::ApiResource('/customer','App\Http\Controllers\Api\CustomerController');

Route::post('/salary/paid/{id}','App\Http\Controllers\Api\SalaryController@Paid');
Route::get('/salary','App\Http\Controllers\Api\SalaryController@AllSalary');
Route::get('/salary/view/{id}','App\Http\Controllers\Api\SalaryController@ViewSalary');


Route::get('edit/salary/{id}','App\Http\Controllers\Api\SalaryController@EditSalary');
Route::post('/salary/update/{id}','App\Http\Controllers\Api\SalaryController@SalaryUpdate');
Route::post('/stock/update/{id}','App\Http\Controllers\Api\ProductController@StockUpdate');
Route::get('/getting/product/{id}','App\Http\Controllers\Api\PosController@GetProduct');

// add to card route
Route::get('/addToCard/{id}','App\Http\Controllers\Api\CardController@AddToCard');
Route::get('/card/product/','App\Http\Controllers\Api\CardController@CardProduct');
Route::get('/remove/card/{id}','App\Http\Controllers\Api\CardController@CardDelete');
Route::get('/decrement/{id}','App\Http\Controllers\Api\CardController@Decrement');
Route::get('/increment/{id}','App\Http\Controllers\Api\CardController@Increment');

//vat route
Route::get('/vats','App\Http\Controllers\Api\CardController@Vats');

//order
Route::post('/orderdone','App\Http\Controllers\Api\PosController@OrderDone');
Route::get('/orders','App\Http\Controllers\Api\OrderController@TodayOrder');


Route::get('/order/details/{id}','App\Http\Controllers\Api\OrderController@OrderDetails');
Route::get('/order/orderdetails/{id}','App\Http\Controllers\Api\OrderController@OrderDetailsAll');

//search order
Route::post('/search/order','App\Http\Controllers\Api\PosController@SearchOrderDate');
//admin dashboard route
Route::get('/today/sell','App\Http\Controllers\Api\PosController@TodaySell');
Route::get('/today/income','App\Http\Controllers\Api\PosController@TodayIncome');
Route::get('/today/due','App\Http\Controllers\Api\PosController@TodayDue');
Route::get('/today/expense','App\Http\Controllers\Api\PosController@TodayExpense');
Route::get('/today/stockout','App\Http\Controllers\Api\PosController@TodayStockout');
