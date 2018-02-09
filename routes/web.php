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

// use App\Task;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () { return view('welcome'); });

/**
 * Show Task Dashboard
 */
Route::get("/tasks", 'TasksController@listTasks');

/**
 * Show Task Edit
 */
Route::get("/task", 'TasksController@vertask');

/**
 * Add New Task
 */
Route::get('/newtask', function (Request $request) { return view('newtask'); });

/**
 * Add save Task
 */
Route::put('/savetask', "TasksController@salvaTask");

/**
 * Marca conclusao de Task
 */
Route::post('/marcarconclusao', "TasksController@marcarConclusao");

/**
 * editar Task
 */
Route::post('/editarTask', "TasksController@editarTask");

/**
 * Delete Task
 */
Route::delete('/deletaTask', "TasksController@deletaTask");



