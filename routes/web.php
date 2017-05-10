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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('people', function (Request $request) {

    $sortRules = $request->input('sort');
    $limit = $request->input('per_page');
    list($field, $dir) = explode('|', $sortRules);
    return App\Models\Person::orderBy($field, $dir)->paginate($limit);

});
