<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use App\Tax\Gst;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('sales', 'Sales\Sales');
Route::resource('items', 'Items\Items');
Route::post('items/itemCalculate', 'Items\Items@itemCalculate');




Route::get('test', function () {
    $GstRate = App\Models\Tax\Cess::find(0)->rate;
    echo($GstRate);
})


?>