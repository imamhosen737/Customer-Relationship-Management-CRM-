<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadshowController;


use App\Http\Controllers\customer\ProposalApproveController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\EstimatesStatusController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ProposalStatusController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IsAdmin;
use App\Http\Controllers\IsCustomer;
use App\Http\Controllers\Customers;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;

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

Route::Group(['prefix' => 'admin', 'middleware' => ['ChkAdmin']], function () {

    Route::resource('/estimate', EstimateController::class);
    Route::resource('/expense', ExpenseController::class);
    Route::resource('/expensecat', ExpenseCategoryController::class);
    Route::resource('/item', ItemController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/tax', TaxController::class);
    Route::resource('/proposal_status', ProposalStatusController::class);
    Route::get('/approved_proposal', [ProposalStatusController::class, 'approved'])->name('approved_proposal');
    Route::get('/declined_proposal', [ProposalStatusController::class, 'declined'])->name('declined_proposal');
    Route::resource('/estimate_status', EstimatesStatusController::class);
    Route::get('/approved_estimate', [EstimatesStatusController::class, 'approved'])->name('approved_estimate');
    Route::get('/declined_estimate', [EstimatesStatusController::class, 'declined'])->name('declined_estimate');
    Route::resource('/customers', CustomersController::class);
    Route::get('/customer', [IsAdmin::class, 'customer'])->name('customer');
    Route::get('/', [IsAdmin::class, 'index'])->name('dashboard');

    // route for lead
    Route::resource('/leads', LeadshowController::class);
});

Route::Group(['middleware' => ['ChkCustomer']], function () {
    Route::get('/customer_panel', [IsCustomer::class, 'index'])->name('customer_panel');

    Route::resource('customer', CustomerController::class);


    Route::get('/pending_proposal', [ProposalApproveController::class, 'view'])->name('pending_proposal');
    Route::resource('/proposals', ProposalApproveController::class);
});


Auth::routes(['register' => false]);

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::post('store/lead', [LeadController::class, 'store'])->name('store.lead');
Route::get('/', [LeadController::class, 'index'])->name('front');
