<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Financial\CreateRequest;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\ManageDepartments;
use App\Livewire\Admin\ManageUnits;
use App\Livewire\Financial\MyRequests;
use App\Livewire\Financial\PendingApprovals;
use App\Livewire\Financial\ViewRequest;
use App\Livewire\Profile\EditProfile;
use App\Livewire\Users\ManageUsers;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', EditProfile::class)->name('profile.edit');

    Route::get('/requests/create', CreateRequest::class)->name('requests.create');
    Route::get('/requests', MyRequests::class)->name('requests.index');
    Route::get('/approvals', PendingApprovals::class)->name('approvals.index');
    Route::get('/requests/{request}', ViewRequest::class)->name('requests.show');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/users', ManageUsers::class)->name('users.index');
        Route::get('/departments', ManageDepartments::class)->name('departments.index');
        Route::get('/units', ManageUnits::class)->name('units.index');
        Route::get('/request-types', \App\Livewire\Admin\ManageRequestTypes::class)->name('request-types.index'); // New
    });
});
