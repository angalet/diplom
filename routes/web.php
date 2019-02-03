<?php
use App\Task;
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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    //return view('welcome_new');
    $tasks = Task::orderBy('created_at', 'asc')->get();
    //$questsions[] = [12,34,45];
    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/', function (Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'category' => 'required|max:255',
    ]);
  
    if ($validator->fails()) {
      return redirect('/')
        ->withInput()
        ->withErrors($validator);
    }
  
    $task = new Task;
    $task->name = $request->name;
    $task->category = $request->category;
    $task->save();
  
    return redirect('/');
  });