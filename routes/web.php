<?php

use App\Http\Controllers\LoginCtrl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\LogoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::match(['GET', 'POST'],'/login/{userType}', [LoginCtrl::class,'login'])->name('login');

Route::get('/', function () {
    return view('auth.chooseLogin');
});

Route::get('/login/{userType}', [LoginCtrl::class, 'index'])->name('login-type');


Route::group(['middleware' => 'auth'], function() {

    //student routes
    Route::middleware(['checkRole:student'])->group(function() {
        Route::get('/student', function(){
            return view('layout.student');
        });
    });

     //parents routes
    Route::middleware(['checkRole:parents'])->group(function() {
        Route::get('/parents', function(){
            dd('parents');
        });
    });

   // Admin access routes
    Route::middleware(['checkRole:administrator'])->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/student', [AdminController::class, 'student'])->name('admin.student');
        Route::get('/admin/faculty', [AdminController::class, 'faculty'])->name('admin.faculty');
        Route::get('/admin/account', [AdminController::class, 'account'])->name('admin.account');
        Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
        Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::get('/admin/staff', [AdminController::class, 'staff'])->name('admin.staff');
        // user management
        Route::post('/admin/account/register', [AdminController::class, 'register'])->name('admin.account.register');
        Route::get('/admin/accounts/edit/{id}', [AdminController::class, 'edit'])->name('admin.account.edit');
        Route::post('/admin/accounts/update/{id}', [AdminController::class, 'update'])->name('admin.account.update');
        Route::delete('/admin/accounts/delete/{id}', [AdminController::class, 'destroy'])->name('admin.account.delete');

        // student management
        Route::post('/students', [AdminController::class, 'store'])->name('students.store');
        Route::put('/students/{id}', [AdminController::class, 'updateStudent'])->name('students.update');
        Route::delete('/students/{id}', [AdminController::class, 'destroyStudent'])->name('students.destroy');

       // download in excel format
       Route::get('/student/export/{id}', function ($id) {
        return Excel::download(new StudentExport($id), 'student_information.xlsx');
        })->name('student.export');

        #students full info
        Route::post('/students/{studentId}/academic', [AdminController::class, 'storeAcademic'])->name('academic.store');
        Route::post('/students/{studentId}/medical', [AdminController::class, 'storeMedical'])->name('medical.store');
        Route::post('/students/{studentId}/disciplinary', [AdminController::class, 'storeDisciplinary'])->name('disciplinary.store');
        Route::get('/students/{id}', [AdminController::class, 'show'])->name('students.show');
       

        #faculty management routes
        // Route to display the faculty listing
        Route::get('/admin/faculty', [AdminController::class, 'faculty'])->name('admin.faculty');
        // Route to display the detailed view for a specific faculty
        Route::get('/admin/faculty/{id}', [AdminController::class, 'showFacultyDetails'])->name('admin.faculty.details');
        // add new faculty record 
        Route::post('/admin/faculty', [AdminController::class, 'storeNewFaculty'])->name('faculty.store');
        //route to open add record
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        // Route to show the edit form for a faculty member
        Route::get('/admin/faculty/edit/{id}', [AdminController::class, 'editSingleRecord'])->name('admin.faculty.edit');
        // Route to update the faculty record
        Route::put('/admin/faculty/update/{id}', [AdminController::class, 'updateSingleFacultyRecord'])->name('admin.faculty.update');
        // Route to delete the faculty record
        Route::delete('/admin/faculty/{id}', [AdminController::class, 'deleteFacultyRecord'])->name('admin.faculty.delete');


    });

    Route::middleware(['checkRole:staff'])->group(function() {
        Route::get('/staff', function(){
            dd('staff');
        });
    });


     //faculty routes  
    Route::middleware(['checkRole:faculty'])->group(function() {
        Route::get('/faculty', function(){ #create another route to where faculty land after login, 
            dd('faculty');
        });
       
    });

});
