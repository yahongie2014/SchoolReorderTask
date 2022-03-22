<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::apiResource('StudentApi', 'App\Http\Controllers\StudentController');
    Route::apiResource('SchoolApi', 'App\Http\Controllers\SchoolController');
    Route::post('positions', ['App\Http\Controllers\HomeController','PositionsStudents']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('schools', function () {
        $schools = \App\Models\School::all();
        return view('School.index')->with('schools', $schools);
    });
    Route::get('school/new', function () {
        return view('School.create');
    });
    Route::get('school/edit/{id}', function ($id) {
        $schools = \App\Models\School::find($id);
        return view('School.edit')->with('school', $schools);
    });


    Route::get('students', function () {
        $students = \App\Models\Student::with('school')->get()->all();
        return view('Student.index')->with('students', $students);
    });
    Route::get('student/new', function () {
        $schools = \App\Models\School::all();
        return view('Student.create')->with('schools', $schools);
    });
    Route::get('student/edit/{id}', function ($id) {
        $student = \App\Models\Student::find($id);
        $schools = \App\Models\School::all();

        return view('Student.edit')->with('student', $student)->with('schools', $schools);
    });


});


