<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Create Course Form
Route::get('/courses/create', function () {
    return view('course.create');
});

// Store New Course
Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|string|max:100',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|string|max:50',
        'is_active' => 'required|boolean',
    ]);

    $course = Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
});

// Display All Courses
Route::get('/courses', function () {
    $courses = Course::all();

    return view('course.list', [
        'courses' => $courses,
    ]);
})->name('courses.index');

// Display Single Course
Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.detail', [
        'course' => $course,
    ]);
});

// Edit Course Form
Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);

    return view('course.edit', [
        'course' => $course,
    ]);
});

// Update Course
Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'duration' => 'required|string|max:100',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|string|max:50',
        'is_active' => 'required|boolean',
    ]);

    $course->update($validated);

    return redirect('/courses/'.$course->id)
        ->with('success', 'Course updated successfully!');
});

// Delete Course
Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);

    $course->delete();

    return redirect('/courses')
        ->with(
            'success',
            'Course deleted successfully!'
        );
});

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
