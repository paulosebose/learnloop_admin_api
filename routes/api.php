<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\SubjectController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function() {
    return response()->json(['message' => 'API is working']);
});

Route::post('register_user',[UserController::class,'registerUser']);
Route::post('accounts_user_login', [UserController::class, 'loginUser']);
Route::post('forgot_password', [MailController::class, 'forgotPassword']);
Route::middleware('auth:sanctum')->group(function () {
   
    Route::post('logout_user', [UserController::class, 'logoutUser']);
    Route::post('user_status', [UserController::class, 'getUserStatus']);

    Route::post('get_levels', [LevelController::class, 'getLevel']);
    Route::post('get_exams', [ExamController::class, 'examview']);
    Route::post('getFirstQuestion/{id}', [QuestionController::class, 'getFirstQuestion']);



    
    Route::get('showQuestions/{examId}', [QuestionController::class, 'showQuestions']);
    Route::post('startExam/{exam_id}', [QuestionController::class, 'startExam'])->middleware('auth:sanctum');
    Route::post('submitAnswer', [QuestionController::class, 'submitAnswer']);


    Route::post('getQuestionsWithOptions', [QuestionController::class, 'getQuestionsWithOptions']);
    Route::post('troubledQuestions', [QuestionController::class, 'troubledQuestions']);
    Route::post('masteredQuestions', [QuestionController::class, 'masteredQuestions']);
     
    
    
    Route::post('change_password', [UserController::class, 'changePassword']);
    
    Route::post('get_subjects', [SubjectController::class, 'getSubjects']);
    Route::get('purchased_courses', [SubjectController::class, 'purchasedCourses']);
    
    Route::post('exam_reappear', [QuestionController::class, 'examReappear']);
    
Route::post('total_time_spent', [UserController::class, 'totalTimeSpent']);

Route::post('exam_mode', [QuestionController::class, 'examMode']);


   


});


Route::delete('/cleanup-user-responses', [QuestionController::class, 'deleteSoftDeletedQuestionResponses']);
Route::delete('/user-responses/delete-latest', [QuestionController::class, 'deleteLatestUserResponsesPerExam']);

Route::post('/add-not-sure-option', [QuestionController::class, 'addNotSureOption']);




