<?php

use App\Http\Controllers\API\auth\AuthController as OtherAuthController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Classroom\ClassroomController;
use App\Http\Controllers\API\dashboard\DashboardController;
use App\Http\Controllers\API\library\LibraryController;
use App\Http\Controllers\api\quiz\ExamController;
use App\Http\Controllers\API\Grade\GradeController;
use App\Http\Controllers\API\quiz\QuestionController;
use App\Http\Controllers\API\quiz\QuizController;
use App\Http\Controllers\API\Section\SectionController;
use App\Http\Controllers\API\setting\SettingController;
use App\Http\Controllers\api\student\AttendanceController;
use App\Http\Controllers\api\student\FeeController;
use App\Http\Controllers\API\student\FeeInvoiceController;
use App\Http\Controllers\api\student\GraduatedStudentsController;
use App\Http\Controllers\api\student\PormotionController;
use App\Http\Controllers\api\student\ReceiptStudent;
use App\Http\Controllers\api\student\ReceiptStudentController;
use App\Http\Controllers\API\student\StudentController;
use App\Http\Controllers\api\subject\SubjectController;
use App\Http\Controllers\API\Teacher\TeacherController;
use App\Http\Controllers\API\TheParent\TheParentController;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//admin
Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
//teacher login
Route::post("teacher-login", [OtherAuthController::class, 'teacherLogin']);
//parent login
Route::post("parent-login", [OtherAuthController::class, 'parentLogin']);
//student login
Route::post("student-login", [OtherAuthController::class, 'studentLogin']);

 Route::middleware(['auth:sanctum','type.admin'])->group(function () {
     //grades
     Route::apiResource('grades', GradeController::class);
     //class
     Route::apiResource('classrooms', ClassroomController::class);
     Route::post('classrooms/delete_selected', [ClassroomController::class, 'delete_selected_id']);
     //section
     Route::apiResource('sections', SectionController::class);
     Route::get('class_by_grade_id/{grade_id}', [SectionController::class, 'getClassrooms']);
     //parent
     Route::post('parent', [TheParentController::class, 'store']);
     Route::post('parent/{parent}', [TheParentController::class, 'update']);
     Route::delete('parent/{parent}', [TheParentController::class, 'destroy']);

     //teacher
     Route::prefix( 'teachers')->group(function (){
         Route::get('/', [TeacherController::class, 'index']);
         Route::post('/', [TeacherController::class, 'store']);
         Route::post('/{id}/update', [TeacherController::class, 'update']);
         Route::post('/{id}/delete', [TeacherController::class, 'destroy']);
     });

     //student
     Route::prefix( 'students')->group(function (){
         Route::post('/delete-selected', [StudentController::class, 'destroy']);
         Route::post('/upload-student-Image', [StudentController::class, 'uploadImage']);
         Route::get('/download-student-Image/{id}/{fileName}', [StudentController::class, 'downloadImage']);
         Route::post('/delete-student-Image', [StudentController::class, 'deleteImage']);
         Route::apiResource('/', StudentController::class);
     });

     //promotion
     Route::post('students/Promotion', [PormotionController::class, 'store']);
     Route::post('students/Promotion/delete', [PormotionController::class, 'destroy']);
     Route::get('getPromotions', [PormotionController::class, 'index']);
     //graduate
     Route::prefix('graduated')->group(function (){
         Route::get('/', [GraduatedStudentsController::class, 'index']);
         Route::post('/', [GraduatedStudentsController::class, 'store']);
         Route::post('/{id}/restor', [GraduatedStudentsController::class, 'update']);
         Route::post('/{id}/delete', [GraduatedStudentsController::class, 'destroy']);
     });

     //fee
     Route::prefix('fees')->group(function (){
         Route::get('/', [FeeController::class, 'index']);
         Route::post('/', [FeeController::class, 'store']);
         Route::post('/{id}/update', [FeeController::class, 'update']);
         Route::post('/{id}/delete', [FeeController::class, 'destroy']);
     });

     Route::prefix('feeInvoice')->group(function (){
        Route::post('/', [FeeInvoiceController::class, 'store']);
        Route::post('/{id}/update', [FeeInvoiceController::class, 'update']);
        Route::post('/{id}/delete', [FeeInvoiceController::class, 'destroy']);
        Route::get('/{id}', [FeeInvoiceController::class, 'show']);
     });

    Route::prefix('receipt')->group(function(){
    Route::post('/', [ReceiptStudentController::class, 'store']);
     Route::post('/{id}/update', [ReceiptStudentController::class, 'update']);
     Route::post('/{id}/delete', [ReceiptStudentController::class, 'destroy']);
     Route::get('/', [ReceiptStudentController::class, 'index']);
    });

     //subjects
     Route::prefix('subjects')->group(function (){
        Route::get('/', [SubjectController::class, 'index']);
        Route::post('/', [SubjectController::class, 'store']);
        Route::post('/{id}/update', [SubjectController::class, 'update']);
        Route::post('/{id}/delete', [SubjectController::class, 'destroy']);
     });

     //setting
     Route::get('/setting', [SettingController::class, 'index']);
     Route::post('/setting/update', [SettingController::class, 'update']);
     //dashboard
     Route::get('admin/dashboard',[DashboardController::class,'adminDashboard']);
     Route::get('logout', [AuthController::class, 'logout']);

 });
Route::middleware(['auth:sanctum','type.teacher'])->group(function () {
    //attendence
    Route::prefix('attendance')->group(function (){
        Route::post('/', [AttendanceController::class, 'store']);
        Route::post('/update', [AttendanceController::class, 'update']);
        Route::get('/{id}', [AttendanceController::class, 'show']);
    });

    //quiz
    Route::prefix('quizzes')->group(function () {
        // quizzes
        Route::get('/', [QuizController::class, 'index']);
        Route::post('/', [QuizController::class, 'store']);
        Route::post('/{id}/update', [QuizController::class, 'update']);
        Route::post('/{id}/delete', [QuizController::class, 'destroy']);
    });
    //question
    Route::prefix('questions')->group(function () {
        Route::get('/', [QuestionController::class, 'index']);
        Route::post('/', [QuestionController::class, 'store']);
        Route::post('/{id}/update', [QuestionController::class, 'update']);
        Route::post('/{id}/delete', [QuestionController::class, 'destroy']);
    });

    //library
    Route::prefix('books')->group(function () {
        Route::get('/', [LibraryController::class, 'index']);
        Route::post('/', [LibraryController::class, 'store']);
        Route::post('/{id}/update', [LibraryController::class, 'update']);
        Route::post('/{id}/delete', [LibraryController::class, 'destroy']);
        Route::get('/{id}/download', [LibraryController::class, 'download']);
    });

    Route::get('teacher/dashboard',[DashboardController::class,'teacherDashboard']);
    Route::get('teacher-students',[TeacherController::class,'getOwnstudents']);
    Route::get('logout', [AuthController::class, 'logout']);
});

//parent
Route::middleware(['auth:sanctum','type.parent'])->group(function () {
Route::get('children-information',[StudentController::class,'show']);
    Route::get('logout', [AuthController::class, 'logout']);
});

//student
Route::middleware(['auth:sanctum','type.student'])->group(function () {
    Route::prefix('student')->group(function(){
        Route::get('/books', [LibraryController::class, 'index']);
        Route::get('/books/{id}/download', [LibraryController::class, 'download']);
        Route::get('/quizzes', [QuizController::class, 'index']);
        Route::get('/questions', [QuestionController::class, 'index']);
    });
    Route::get('logout', [AuthController::class, 'logout']);
});

