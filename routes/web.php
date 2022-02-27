<?php

use App\Http\Controllers\IsAdmin;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\Customers;
use App\Http\Controllers\IsCustomer;

// Mehedi:
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\LeadController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\LeadshowController;
use App\Http\Controllers\proposalController;
use App\Http\Controllers\AdmintaskController;
use App\Http\Controllers\CustomersController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\MilestonesController;
use App\Http\Controllers\TimesheetsController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\ProposalStatusController;
use App\Http\Controllers\EstimatesStatusController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\paymentreceivedController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\InvoiceStatusController;
use App\Http\Controllers\customer\ProposalApproveController;
use App\Http\Controllers\customer\EstimateController as CustomerEstimate;

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

    Route::get('/gantt/{id}', [CustomersController::class, 'gantt'])->name('gantt');
    // Mehedi:
    Route::resource('/project', ProjectController::class);
    Route::get('/project/{id}/tasks',  [ProjectController::class, 'tasks'])->name('project.tasks');
    // tasks
    Route::get('/project/tasks/create/{project_id}', [TasksController::class, 'create'])->name('tasks.create');
    Route::get('/project/{project_id}/tasks/{task_id}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::delete('/project/{project_id}/tasks/{task_id}', [TasksController::class, 'destroy'])->name('tasks.destroy');
    Route::resource('project/tasks', TasksController::class)->except(['create', 'destroy', 'edit']);


    //milestones
    Route::resource('/project/milestones', MilestonesController::class)->except(['create', 'destroy', 'edit']);
    Route::get('/project/milestones/create/{project_id}', [MilestonesController::class, 'create'])->name('milestones.milestones_create');

    Route::get('/project/{project_id}/milestones/{milestones_id}/edit', [MilestonesController::class, 'edit'])->name('milestones.milestones_edit');

    Route::delete('/project/{project_id}/milestones/{milestones_id}', [MilestonesController::class, 'destroy'])->name('milestones.destroy');

    Route::get('/project/{id}/milestones',  [ProjectController::class, 'milestones'])->name('project.milestones');

    Route::resource('/contacts', ContactController::class);
    Route::resource('/customers', CustomersController::class);
    Route::get('/customer_details/{id}', [CustomersController::class, 'details'])->name('customer_details');

    Route::resource('/users', UserRegisterController::class);
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

    Route::resource('/task_list', StatusController::class);
    Route::resource('/timesheets',TimesheetsController::class);
    Route::resource('/paymentreceived', paymentreceivedController::class);
    Route::resource('/department', departmentController::class);
    Route::resource('/proposal', proposalController::class);
    Route::get('/download/{id}', [ProposalController::class, 'printToPdf'])->name('download');

    Route::get('/getPrice/{id}', [proposalController::class, 'getPrice'])->name('getPrice');
    // route for lead
    Route::resource('/leads', LeadshowController::class);

    // route for invoice:
    // Route::post('sendmail/invoice/{id}', [InvoiceController::class, 'mail_send'] )->name('mail');
    Route::resource('/invoice', InvoiceController::class);
    Route::resource('/payments', PaymentController::class);
    Route::get('/est_invoice/{id}/{estimate_id}', [InvoiceController::class, 'estimate_invoice'])->name('est_invoice');
});

Route::Group(['middleware' => ['ChkCustomer']], function () {
    Route::get('/customer_panel', [IsCustomer::class, 'index'])->name('customer_panel');

    Route::resource('customer', CustomerController::class);
    // Route::resource('/invoice', InvoiceController::class);
    Route::get('/estimate_list', [CustomerEstimate::class, 'index'])->name('cm_estimate');
    Route::get('/estimate_View/{id}', [CustomerEstimate::class, 'show'])->name('cm_estimate_view');
    Route::post('/estimate_accept/{id}', [CustomerEstimate::class, 'accept'])->name('cm_estimate_accept');
    Route::post('/estimate_reject/{id}', [CustomerEstimate::class, 'reject'])->name('cm_estimate_reject');
    Route::get('/proposal/status',  [ProposalApproveController::class, 'status'])->name('proposals.status');
    Route::get('proposal/pending', [ProposalApproveController::class, 'pending'])->name('proposals.pending');
    Route::get('proposal/approved', [ProposalApproveController::class, 'approved'])->name('proposals.approved');
    Route::get('proposal/declined', [ProposalApproveController::class, 'declined'])->name('proposals.declined');
    Route::resource('/proposals', ProposalApproveController::class);
    Route::get('/proposalDownload/{id}', [ProposalApproveController::class, 'printToPdf'])->name('proposalDownload');

    Route::resource('/customer_invoice', InvoiceStatusController::class);
});


Auth::routes(['register' => false]);

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::post('store/lead', [LeadController::class, 'store'])->name('store.lead');
Route::get('/', [LeadController::class, 'index'])->name('front');
