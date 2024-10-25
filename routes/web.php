<?php

use App\Http\Controllers\LoginCtrl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Exports\StudentExport;
use App\Http\Controllers\FacultyCtrl;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FacAnnouncementCtrl;
use App\Http\Controllers\FacGradeCtrl;
use App\Http\Controllers\FacMemoCtrl;
use App\Http\Controllers\FacNotifCtrl;
use App\Http\Controllers\FacultyTaskCtrl;
use App\Http\Controllers\StudentMainCtrl;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\GovernanceController;
use App\Http\Controllers\ChatController;



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

    // chat
    Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/fetch-messages', [ChatController::class, 'fetchMessages'])->name('chat.fetchMessages');

    Route::get('/settings/account', [AdminController::class, 'curUser'])->name('settings.account');
    Route::put('/admin/updateAccount/{id}', [AdminController::class, 'updateAccount'])->name('admin.account.update');
    //student routes
    Route::middleware(['checkRole:student'])->group(function() {

        Route::get('/student', [StudentMainCtrl::class, 'scheduleIndex']);

        Route::get('/student/event', [StudentMainCtrl::class, 'eventIndex']);
        Route::post('/student/event/in/{id}', [StudentMainCtrl::class, 'eventIn'])->name('event.in');

        Route::get('/student/notification', [StudentMainCtrl::class, 'notificationIndex']);
        Route::get('/student/notification/getNotif', [StudentMainCtrl::class, 'getNotif']);

        Route::get('/student/announcement', [StudentMainCtrl::class, 'announcementIndex']);
            
        Route::get('/student/info', [StudentMainCtrl::class, 'show']);
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
        Route::get('/admin/logs', [UserLogController::class, 'logs'])->name('admin.logs');

        // user management
        Route::post('/admin/account/register', [AdminController::class, 'register'])->name('admin.account.register');
        Route::get('/admin/accounts/edit/{id}', [AdminController::class, 'edit'])->name('admin.account.edit');
        Route::put('/admin/accounts/update/{id}', [AdminController::class, 'update'])->name('admin.account.update');
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
        Route::get('/admin/faculty', [AdminController::class, 'faculty'])->name('admin.faculty');
        Route::get('/admin/faculty/{id}', [AdminController::class, 'showFacultyDetails'])->name('admin.faculty.details');
        Route::post('/admin/faculty', [AdminController::class, 'storeNewFaculty'])->name('faculty.store');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::get('/admin/faculty/edit/{id}', [AdminController::class, 'editSingleRecord'])->name('admin.faculty.edit');
        Route::put('/admin/faculty/update/{id}', [AdminController::class, 'updateSingleFacultyRecord'])->name('admin.faculty.update');
        Route::delete('/admin/faculty/{id}', [AdminController::class, 'deleteFacultyRecord'])->name('admin.faculty.delete');

        //schools info
        Route::resource('admin/schools', SchoolController::class);
        Route::resource('admin/governance', GovernanceController::class); 
        // facilities
        Route::get('facilities', [SchoolController::class, 'facilities'])->name('facilities.index');
        Route::get('facilities/create', [SchoolController::class, 'create'])->name('facilities.create');
        Route::post('facilities/store', [SchoolController::class, 'storeFacility'])->name('facilities.storeFacility');
        Route::get('facilities/edit/{id}', [SchoolController::class, 'editFacilities'])->name('facilities.editFacilities');
        Route::put('facilities/update/{id}', [SchoolController::class, 'updateFacilities'])->name('facilities.updateFacilities');
        Route::delete('facilities/{id}', [SchoolController::class, 'destroyFacilities'])->name('facilities.destroyFacilities');
        //procedures
        Route::get('procedures',[SchoolController::class, 'Procedures'])->name('procedures.index');
        Route::get('procedures/create',[SchoolController::class, 'createProcedure'])->name('procedures.createProcedure');
        Route::get('procedures/edit/{id}',[SchoolController::class, 'editProcedure'])->name('procedures.editProcedure');
        Route::post('procedures/store',[SchoolController::class, 'storeProcedure'])->name('procedures.storeProcedure');
        Route::put('procedures/update/{id}', [SchoolController::class, 'updateProcedure'])->name('procedures.updateProcedure');
        Route::delete('procedures/{id}',[SchoolController::class, 'destroyProcedure'])->name('procedures.destroyProcedure');
        //policies
        Route::get('policies',[SchoolController::class, 'Policies'])->name('policies.index');
        Route::get('policies/create',[SchoolController::class, 'createPolicies'])->name('policies.createPolicies');
        Route::get('policies/edit/{id}',[SchoolController::class, 'editPolicies'])->name('policies.editPolicies');
        Route::post('policies/store',[SchoolController::class, 'storePolicies'])->name('policies.storePolicies');
        Route::put('policies/update/{id}',[SchoolController::class, 'updatePolicies'])->name('policies.updatePolicies');
        Route::delete('policies/{id}',[SchoolController::class, 'destroyPolicies'])->name('policies.destroyPolicies');          
    });



    Route::middleware(['checkRole:staff'])->group(function() {
        Route::get('/staff', function(){
            dd('staff');
        });
    });

     //faculty routes  
    Route::middleware(['checkRole:faculty'])->group(function() {
        Route::get('/faculty', [FacultyCtrl::class, 'facultyDash']);
        Route::get('/faculty/list', [FacultyCtrl::class, 'index']);
        Route::get('/faculty/{id}', [FacultyCtrl::class, 'show']);
        Route::get('/faculty/edit/{id}', [FacultyCtrl::class, 'editView']);
        Route::put('/faculty/edit/{id}/save', [FacultyCtrl::class, 'update'])->name('faculty.edit');

        Route::get('/faculty/qualification/{id}', [FacultyCtrl::class, 'qualificationShow']);
        Route::post('/faculty/qualification/add/{faculty_id}', [FacultyCtrl::class, 'addQualification'])->name('add.qualification');
        Route::delete('/qualification/delete/{qualification_id}', [FacultyCtrl::class, 'deleteQualification'])->name('delete.qualification');
        Route::put('/qualification/update/{qualification_id}', [FacultyCtrl::class, 'updateQualification'])->name('update.qualification');

        Route::get('/faculty/teaching-assignment/{id}', [FacultyCtrl::class, 'teachingAssignShow']);
        Route::post('/faculty/assignment/add/{faculty_id}', [FacultyCtrl::class, 'addAssignment'])->name('add.assignment');
        Route::delete('/assignment/delete/{assignment_id}', [FacultyCtrl::class, 'deleteAssignment'])->name('delete.assignment');
        Route::put('/assignment/update/{assignment_id}', [FacultyCtrl::class, 'updateAssignment'])->name('update.assignment');

        Route::get('/faculty/task/list', [FacultyTaskCtrl::class, 'index']);
        Route::delete('/faculty/event/delete', [FacultyTaskCtrl::class, 'destroy'])->name('delete.event');
        Route::post('/faculty/event/add', [FacultyTaskCtrl::class, 'store'])->name('add.event');
        Route::put('/faculty/event/edit/{id}', [FacultyTaskCtrl::class, 'edit'])->name('edit.event');

        Route::get('/faculty/event/attencance/{id}', [FacultyTaskCtrl::class, 'eventAttendance'])->name('attendance.event');

        Route::get('/faculty/notification/list', [FacNotifCtrl::class, 'index']);

        Route::get('/faculty/memo/list', [FacMemoCtrl::class, 'index']);
        Route::post('/faculty/memo/add', [FacMemoCtrl::class, 'store'])->name('add.memo');
        Route::put('/faculty/memo/edit/{id}', [FacMemoCtrl::class, 'edit'])->name('edit.memo');
        Route::delete('/faculty/memo/delete', [FacMemoCtrl::class, 'destroy'])->name('delete.memo');
        
        Route::get('/faculty/announcement/list', [FacAnnouncementCtrl::class, 'index']);
        Route::post('/faculty/announcement/add', [FacAnnouncementCtrl::class, 'store'])->name('add.announcement');
        Route::delete('/faculty/announcement/delete', [FacAnnouncementCtrl::class, 'destroy'])->name('delete.announcement');
        Route::put('/faculty/announcement/edit/{id}', [FacAnnouncementCtrl::class, 'edit'])->name('edit.announcement');

        Route::get('/faculty/grade-section/list', [FacGradeCtrl::class, 'index']);
        Route::post('/faculty/grade/add', [FacGradeCtrl::class, 'store'])->name('add.grade');
        Route::put('/faculty/grade/edit/{id}', [FacGradeCtrl::class, 'edit'])->name('edit.grade');
        Route::delete('/faculty/grade/delete', [FacGradeCtrl::class, 'destroy'])->name('delete.grade');

        Route::get('/faculty/grade-section/list/{id}', [FacGradeCtrl::class, 'shedule'])->name('show.schedule');
        Route::post('/faculty/schedule/update', [FacGradeCtrl::class, 'updateSchedule'])->name('update.schedule');
        Route::delete('/faculty/schedule/delete/{day}/{id}', [FacGradeCtrl::class, 'destroySchedule'])->name('delete.schedule');

        Route::post('/faculty/instructor/update/{id}', [FacGradeCtrl::class, 'updateInstructor'])->name('update.instructor');

        Route::get('/faculty/student/list', [FacGradeCtrl::class, 'studentIndex']);
        Route::post('/faculty/student/update/{id}', [FacGradeCtrl::class, 'updateEnroll'])->name('update.enroll');

         //SUBJECT
         Route::post('/faculty/subject/add/{id}', [FacGradeCtrl::class, 'addSubject'])->name('add.subject');
         Route::delete('/faculty/subject/delete/{id}', [FacGradeCtrl::class, 'destroySubject'])->name('delete.subject');
         Route::post('/faculty/grade/add/{subjectId}/{studentId}', [FacGradeCtrl::class, 'addGrade'])->name('update.grade');
 
    });
});