<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(\App\Http\Controllers\RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register.index');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(\App\Http\Controllers\LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login.index');
        Route::post('/login', 'store')->name('login.store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(\App\Http\Controllers\LoginController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });
});

Route::middleware(['auth', 'role:admin,operator'])->group(function () {
    Route::controller(\App\Http\Controllers\Dashboard\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });

    Route::controller(\App\Http\Controllers\Dashboard\ProfileController::class)->group(function () {
        Route::get('/dashboard/profile', 'show')->name('dashboard.profile.show');
        Route::get('/dashboard/profile/edit', 'edit')->name('dashboard.profile.edit');

        Route::match(['put', 'patch'], '/dashboard/profile/edit', 'update')->name('dashboard.profile.update');
    });

    Route::controller(\App\Http\Controllers\Dashboard\AdminController::class)->group(function () {
        Route::get('/dashboard/admin', 'index')->name('dashboard.admin.index');
        Route::get('/dashboard/admin/{id}', 'show')->name('dashboard.admin.show');
    });

    Route::controller(\App\Http\Controllers\Dashboard\OperatorController::class)->group(function () {
        Route::get('/dashboard/operator', 'index')->name('dashboard.operator.index');
        Route::get('/dashboard/operator/create', 'create')->name('dashboard.operator.create');
        Route::get('/dashboard/operator/{id}', 'show')->name('dashboard.operator.show');
        Route::get('/dashboard/operator/{id}/edit', 'edit')->name('dashboard.operator.edit');

        Route::post('/dashboard/operator', 'store')->name('dashboard.operator.store');
        Route::match(['put', 'patch'], '/dashboard/operator/{id}/edit', 'update')->name('dashboard.operator.update');
        Route::delete('/dashboard/operator/{id}/delete', 'destroy')->name('dashboard.operator.destroy');
    });

    Route::controller(\App\Http\Controllers\Dashboard\StudentController::class)->group(function () {
        Route::get('/dashboard/student', 'index')->name('dashboard.student.index');
        Route::get('/dashboard/student/create', 'create')->name('dashboard.student.create');
        Route::get('/dashboard/student/{id}', 'show')->name('dashboard.student.show');
        Route::get('/dashboard/student/{id}/edit', 'edit')->name('dashboard.student.edit');

        Route::post('/dashboard/student', 'store')->name('dashboard.student.store');
        Route::match(['put', 'patch'], '/dashboard/student/{id}/edit', 'update')->name('dashboard.student.update');
        Route::delete('/dashboard/student/{id}/delete', 'destroy')->name('dashboard.student.destroy');
    });

    Route::controller(\App\Http\Controllers\Dashboard\BlogController::class)->group(function () {
        Route::get('/dashboard/blog', 'index')->name('dashboard.blog.index');
        Route::get('/dashboard/blog/create', 'create')->name('dashboard.blog.create');
        Route::get('/dashboard/blog/{id}', 'show')->name('dashboard.blog.show');
        Route::get('/dashboard/blog/{id}/edit', 'edit')->name('dashboard.blog.edit');

        Route::post('/dashboard/blog', 'store')->name('dashboard.blog.store');
        Route::match(['put', 'patch'], '/dashboard/blog/{id}/edit', 'update')->name('dashboard.blog.update');
        Route::delete('/dashboard/blog/{id}/delete', 'destroy')->name('dashboard.blog.destroy');
    });

    Route::controller(\App\Http\Controllers\Dashboard\SubmissionController::class)->group(function () {
        Route::get('/dashboard/submission', 'index')->name('dashboard.submission.index');
        Route::get('/dashboard/submission/create', 'create')->name('dashboard.submission.create');
        Route::get('/dashboard/submission/{id}', 'show')->name('dashboard.submission.show');
        Route::get('/dashboard/submission/{id}/edit', 'edit')->name('dashboard.submission.edit');
        Route::get('/dashboard/submission/export/excel', 'export')->name('dashboard.submission.export-excel');

        Route::post('/dashboard/submission', 'store')->name('dashboard.submission.store');
        Route::match(['put', 'patch'], '/dashboard/submission/{id}/edit', 'update')->name('dashboard.submission.update');
        Route::delete('/dashboard/submission/{id}/delete', 'destroy')->name('dashboard.submission.destroy');
        Route::post('/dashboard/submission/{id}/confirm', 'confirm')->name('dashboard.submission.confirm');
    });

    Route::controller(\App\Http\Controllers\Dashboard\SubmissionPostController::class)->group(function () {
        Route::get('/dashboard/submission-post', 'index')->name('dashboard.submission-post.index');
        Route::get('/dashboard/submission-post/{id}', 'show')->name('dashboard.submission-post.show');
        Route::get('/dashboard/submission-post/{id}/edit', 'edit')->name('dashboard.submission-post.edit');

        Route::match(['put', 'patch'], '/dashboard/submission-post/{id}/edit', 'update')->name('dashboard.submission-post.update');
        Route::delete('/dashboard/submission-post/{id}/delete', 'destroy')->name('dashboard.submission-post.destroy');
    });

    Route::controller(\App\Http\Controllers\Dashboard\TimelineController::class)->group(function () {
        Route::get('/dashboard/submission/{submission}/timeline/create', 'create')->name('dashboard.timeline.create');
        Route::get('/dashboard/submission/{submission}/timeline/{timeline}', 'show')->name('dashboard.timeline.show');
        Route::get('/dashboard/submission/{submission}/timeline/{timeline}/edit', 'edit')->name('dashboard.timeline.edit');

        Route::post('/dashboard/submission/{submission}/timeline/create', 'store')->name('dashboard.timeline.store');
        Route::match(['put', 'patch'], '/dashboard/submission/{submission}/timeline/{timeline}/edit', 'update')->name('dashboard.timeline.update');
        Route::delete('/dashboard/submission/{submission}/timeline/{timeline}/delete', 'destroy')->name('dashboard.timeline.destroy');
    });

});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::controller(\App\Http\Controllers\Homepage\MainController::class)->group(function () {
        Route::get('/', 'index')->name('main.index');
    });

    Route::controller(\App\Http\Controllers\Homepage\BlogController::class)->group(function () {
        Route::get('/blog', 'index')->name('blog.index');
        Route::get('/blog/{id}', 'show')->name('blog.show');
    });

    Route::controller(\App\Http\Controllers\Homepage\SubmissionController::class)->group(function () {
        Route::get('/submission', 'index')->name('submission.index');
        Route::get('/submission/{id}', 'show')->name('submission.show');
        Route::get('/submission/create', 'create')->name('submission.create');

        Route::post('/submission/create', 'store')->name('submission.store');
    });

    Route::controller(\App\Http\Controllers\Homepage\TrackController::class)->group(function () {
        Route::get('/track', 'index')->name('track.index');
        Route::get('/track/{id}', 'show')->name('track.show');
    });

    Route::controller(\App\Http\Controllers\Homepage\ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit', 'edit')->name('profile.edit');

        Route::match(['put', 'patch'], '/profile/edit', 'update')->name('profile.update');
    });

    Route::controller(\App\Http\Controllers\Homepage\ProfileLikeController::class)->group(function () {
        Route::get('/profile/like', 'index')->name('profile-like.index');
    });

    Route::controller(\App\Http\Controllers\Homepage\ProfileSubmissionController::class)->group(function () {
        Route::get('/profile/submission', 'index')->name('profile-submission.index');
        Route::get('/profile/submission/create', 'create')->name('profile-submission.create');
        Route::get('/profile/submission/{id}', 'show')->name('profile-submission.show');
        Route::get('/profile/submission/{id}/edit', 'edit')->name('profile-submission.edit');

        Route::post('/profile/submission', 'store')->name('profile-submission.store');
        Route::match(['put', 'patch'], '/profile/submission/{id}/edit', 'update')->name('profile-submission.update');
        Route::delete('/profile/submission/{id}/delete', 'destroy')->name('profile-submission.destroy');
    });

    Route::controller(\App\Http\Controllers\Homepage\ProfileSubmissionController::class)->group(function () {
        Route::get('/profile/submission', 'index')->name('profile-submission.index');
        Route::get('/profile/submission/{id}', 'show')->name('profile-submission.show');
    });

    Route::controller(\App\Http\Controllers\Homepage\LikeController::class)->group(function () {
        Route::post('/like', 'store')->name('like.store');
    });

    Route::controller(\App\Http\Controllers\Homepage\CommentController::class)->group(function () {
        Route::post('/comment', 'store')->name('comment.store');
    });
});
