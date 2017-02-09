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

/*Route::get('/', 'FrontEndController@index');
Route::get('signup', 'FrontEndController@signUp');
Route::get('forgotpassword', 'FrontEndController@forgotPassword');

Route::post('autentication', [ 
    'uses' => 'FrontEndController@autentication',
    'as' => 'autentication'
]);

Route::post('register', [ 
    'uses' => 'FrontEndController@register',
    'as' => 'register'
]);



 
 Route::get('create', [ 
    'uses' => 'FrontEndController@autentication',
    'as' => 'create'
]); 
 
  
Route::get('/', function () {
    return view('welcome');
});*/




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Route::get('admin/user', 'admin\UserController@index');

//Route::get('admin/user/form/{id}', 'admin\UserController@form')->where('id', '[0-9]+');

Route::resource('user', 'UserController');

Route::resource('proyectosaperturas', 'ProyectosAperturasController');

Route::resource('userType', 'admin\UserTypeController');


Route::get('/generador', 'GeneradorController@index');
Route::post('/generador/find_table', 'GeneradorController@find_table');
Route::post('/generador/generar_archivo', 'GeneradorController@generar_archivo');