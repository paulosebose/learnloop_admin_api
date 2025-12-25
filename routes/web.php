<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PaymentController;

// Route::get('/', function () {
//     return view('admin.adminlogin'); 
// })->name('adminlogin');

Route::get('pay/{subject_id}/{user_id}', [PaymentController::class, 'showPaymentPage']);
Route::post('payment/success', [PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::get('/success', function () {
    return view('thank-you'); 
})->name('thank.you');

Route::get('/payment-failed', function () {
    return view('payment-failed'); 
})->name('payment.failed');


Route::get('/', function () {
    return view('admin.adminlogin');
})->name('login');


Route::post('dologin', [LoginController::class, 'login'])->name('dologin');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/payments', [PaymentController::class, 'listPayments'])->name('payments.list');
    Route::get('levelview',[LevelController::class,'getLevels'])->name('levelview');
    //Level
    Route::get('getLevels/{id}', [LevelController::class, 'getLevelById'])->name('getLevelById');
Route::get('addlevel',[AdminController::class,'addLevel'])->name('addlevel');
Route::match(['get', 'post'],'searchByQuestion',[AdminController::class,'searchByQuestion'])->name('searchByQuestion');
// Route::post('insertlevel',[LevelController::class,'insertlevel'])->name('insertlevel');
Route::post('insertlevel', [LevelController::class, 'insertlevel'])->name('insertlevel');
Route::get('vieweditlevel/{id}', [LevelController::class, 'viewEditLevel'])->name('vieweditlevel');
Route::post('editlevel/{id}', [LevelController::class, 'editLevel'])->name('editlevel');
Route::delete('deletelevel/{id}',[LevelController::class,'deleteLevel'])->name('deletelevel');

//Exam
Route::get('examview/{id}',[ExamController::class,'examview'])->name('examview');
Route::get('viewaddexam/{id}',[ExamController::class,'viewAddExam'])->name('viewaddexam');
Route::post('insert-exam', [ExamController::class, 'insertExam'])->name('insertExam');
Route::get('/exam/edit/{id}', [ExamController::class, 'editExam'])->name('editexam');
Route::put('/exam/update/{id}', [ExamController::class, 'updateExam'])->name('updateexam');
Route::delete('/exam/delete/{id}', [ExamController::class, 'deleteExam'])->name('deleteexam');
Route::post('/upload-csv', [ExamController::class, 'uploadCSV'])->name('upload.csv');
Route::post('toggle-exam-status/{id}', [ExamController::class, 'toggleExamStatus'])->name('toggle.exam.status');
Route::delete('/admin/delete-multiple-exams', [ExamController::class, 'deleteMultipleExams'])->name('exam.multiDelete');

Route::post('/exams/import', [ExamController::class, 'importExam'])->name('exams.import');




// Show all exams (table)
Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');

// AJAX modal upload POST
Route::post('/exam/{id}/doc-upload', [ExamController::class, 'processDocUpload'])
    ->name('docUpload.store');



//Subject
Route::post('/insertSubject', [SubjectController::class, 'insertSubject'])->name('insertSubject');
Route::get('/addSubject', [SubjectController::class, 'viewAddSubject'])->name('viewAddSubject');
Route::get('/viewSubjects', [SubjectController::class, 'getSubjects'])->name('viewSubjects');
Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::post('/subjects/{id}/update', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');






//Question

Route::get('/exams/{examId}/questions', [QuestionController::class, 'showQuestions'])->name('show-questions');
Route::get('/exams/{examId}/questions/add', [QuestionController::class, 'create'])->name('add-question');
Route::post('/exams/{examId}/questions', [QuestionController::class, 'store'])->name('store-question');
Route::get('/exams/{examId}/questions/{questionId}', [QuestionController::class, 'show'])->name('show-question');
Route::get('/exams/{examId}/questions/{questionId}/edit', [QuestionController::class, 'edit'])->name('edit-question');
Route::put('/exams/{examId}/questions/{questionId}', [QuestionController::class, 'update'])->name('update-question');
Route::delete('/exams/{examId}/questions/{questionId}', [QuestionController::class, 'destroy'])->name('delete-question');
Route::delete('/questions/bulk-delete', [QuestionController::class, 'bulkDelete'])->name('questions.bulkDelete');


   Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
   Route::get('/studentdetails', [UserController::class, 'studentDetails'])->name('studentdetails');

    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    
});
Route::middleware(['auth','admin'])->group(function () {
 
    Route::get('getuser', [UserController::class, 'getUsers'])->name('getuser');
     Route::get('/user/status', [UserController::class, 'showUserStatus'])->name('user.status1');
     Route::get('/user/status/{id}', [UserController::class, 'showUserQuizStatus'])->name('user.status');
     Route::post('/update-level-access', [UserController::class, 'updateLevelAccess'])->name('updateLevelAccess');
     Route::post('/admin/update-subject-access', [UserController::class, 'updateSubjectAccess'])->name('updateSubjectAccess');





//User
Route::get('userrequest',[UserController::class,'viewUserRequets'])->name('userrequest');
Route::post('user-request/{id}/approve', [UserController::class, 'approve'])->name('user-request.approve');
Route::post('user-request/{id}/reject', [UserController::class, 'reject'])->name('user-request.reject');
Route::get('user_search', [UserController::class, 'userSearch'])->name('user_search');
 Route::post('subadmin/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('subadmin.toggleStatus');








//Sub-admin
Route::get('subadmins', [UserController::class, 'index'])->name('subadmin.index');
Route::get('add-subadmin', [UserController::class, 'showAddSubadminForm'])->name('subadmin.form');
Route::post('/add-subadmin', [UserController::class, 'addSubadmin'])->name('add.subadmin');
Route::delete('subadmin/{id}/delete', [UserController::class, 'subAdminDelete'])->name('subadmin.softDelete');
Route::get('subadmin/{id}/edit', [UserController::class, 'edit'])->name('subadmin.edit');
Route::put('subadmin/{id}/update', [UserController::class, 'update'])->name('subadmin.update');
    
});







