<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    DashboardController,
    VendorController,
    UserController,
    UnitController,
    RevenueSourceController,
    RevenueController,
    BudgetController,
    BudgetHeadController,
    ExpenditureRequestController,
    PaymentVoucherController,
    ReceiptController,
    AuditLogController,
    DepartmentController,
    UserManagementController
};

// Public landing page
Route::get('/', function () {
    return view('welcome');
});

// Authentication (Laravel Breeze)
require __DIR__.'/auth.php';

// Authenticated area
Route::middleware(['auth'])->group(function () {

    // Dashboard (all roles)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->only(['index','edit','update']);
        Route::resource('departments', DepartmentController::class);
        Route::resource('units', UnitController::class);
        Route::resource('vendors', VendorController::class);

        // User Management
        Route::get('/user-management', [UserManagementController::class, 'index'])->name('users.manage');
        Route::post('/user-management/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
        Route::post('/user-management/{user}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
        Route::post('/user-management/{user}/reset', [UserManagementController::class, 'resetPassword'])->name('users.reset');
    });

    /*
    |--------------------------------------------------------------------------
    | BURSAR, DEPUTY BURSAR & ADMIN
    |--------------------------------------------------------------------------
    | Handles financial control, approvals, and revenue management
    */
    Route::middleware(['role:admin|bursar|deputy_bursar'])->group(function () {
        // Revenue & Budget management
        Route::resource('revenues', RevenueController::class);
        Route::resource('revenue-sources', RevenueSourceController::class);
        Route::resource('budgets', BudgetController::class);
        Route::resource('budget-heads', BudgetHeadController::class);

        // Payment Vouchers
        Route::resource('payment-vouchers', PaymentVoucherController::class);
        Route::post('/payment-vouchers/{payment_voucher}/paid', [PaymentVoucherController::class, 'markPaid'])
            ->name('payment-vouchers.paid');
        Route::get('/payment-vouchers/{payment_voucher}/pdf', [PaymentVoucherController::class,'pdf'])
            ->name('payment-vouchers.pdf');

        // Receipts
        Route::resource('receipts', ReceiptController::class)->only(['index','create','store','destroy']);
        Route::get('/receipts/{receipt}/pdf', [ReceiptController::class,'pdf'])->name('receipts.pdf');

        // Approve/Reject Expenditures
        Route::post('/expenditures/{expenditure}/approve', [ExpenditureRequestController::class,'approve'])
            ->name('expenditures.approve');
        Route::post('/expenditures/{expenditure}/reject', [ExpenditureRequestController::class,'reject'])
            ->name('expenditures.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | ACCOUNTANT & CASHIER (Operational Roles)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:accountant|cashier|admin'])->group(function () {
        // Accountant focuses on revenue and receipts
        Route::get('/revenues', [RevenueController::class, 'index'])->name('revenues.index');
        Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
        // Cashier's Cash Book (placeholder)
        Route::get('/cashbook', fn() => view('cashbook.index'))->name('cashbook.index');
    });

    /*
    |--------------------------------------------------------------------------
    | DEPARTMENT OFFICER (Submit Requests)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:dept_officer|admin'])->group(function () {
        Route::resource('expenditures', ExpenditureRequestController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | AUDITOR, BURSAR, ADMIN, RECTOR (Read-only)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin|bursar|auditor|rector'])->group(function () {
        Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');
        Route::get('/reports', fn() => view('reports.index'))->name('reports.index');
    });
});
