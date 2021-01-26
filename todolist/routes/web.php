<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function () {

	/**
	 * Show Task Dashboard
	 */
	Route::get('/', function () {
		//
	});

	/**
	 * Add New Task
	 */
	Route::post('/task', function (Request $request) {
		//
	});

	/**
	 * Delete Task
	 */
	Route::delete('/task/{task}', function (Task $task) {
		//
	});
});

Route::post('/task', function (Request $request) {
	$validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	// Create The Task...
});

Route::post('/task', function (Request $request) {
	$validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	$task = new Task;
	$task->name = $request->name;
	$task->save();

	return redirect('/');
});

Route::get('/', function () {
	$tasks = Task::orderBy('created_at', 'asc')->get();

	return view('tasks', [
		'tasks' => $tasks
	]);
});

Route::delete('/task/{task}', function (Task $task) {
	$task->delete();

	return redirect('/');
});

Route::get('/', function () {
    return view('tasks');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
