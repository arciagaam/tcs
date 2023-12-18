<?php

use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ConversationMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PanelMemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\StudentSubmissionController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserController;
use App\Models\Appointment;
use App\Models\ConversationMessage;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

// Accessible routes when logged out
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('post.register');

    Route::prefix('forgot-password')->name('forgot-password.')->group(function() {

        Route::get('step-one', [ForgotPasswordController::class, 'stepOne'])->name('step-one');
        Route::post('step-one', [ForgotPasswordController::class, 'postStepOne'])->name('post.step-one');
        
        Route::get('step-two', [ForgotPasswordController::class, 'stepTwo'])->name('step-two');
        Route::post('step-two', [ForgotPasswordController::class, 'postStepTwo'])->name('post.step-two');

        Route::get('step-three', [ForgotPasswordController::class, 'stepThree'])->name('step-three');
        Route::post('step-three', [ForgotPasswordController::class, 'postStepThree'])->name('post.step-three');

    });
});

// Accessible routes when logged in as any role
Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class)->only('index');

    Route::prefix('appointments')->name('appointments.')->group(function() {

        Route::get('/requests/print', [AppointmentRequestController::class, 'print'])->name('print');
        Route::resource('requests', AppointmentRequestController::class);
        
    });

    //appointments api
    Route::get('/appointments/get', [AppointmentController::class, 'get']);
    Route::resource('appointments', AppointmentController::class);

    Route::get('reports/print', [ReportController::class, 'print'])->name('reports.print');
    Route::resource('reports', ReportController::class);

    Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->name('submission');
    Route::post('/submissions/{submission}/check', [SubmissionController::class, 'check'])->name('submission.check');

    Route::resource('tracking', TrackingController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('chatbot')->name('chatbot.')->group(function () {
        Route::post('/send', [ConversationMessageController::class, 'sendMessage'])->name('send');
    });
    Route::resource('chatbot', ChatbotController::class);

    Route::get('students/data/{id}', function ($id) {
        $tasks = new Task();
        $student = Student::with('tasks')->where('user_id', $id)->first();
        $tasks = $student->tasks;

        return response()->json([
            "data" => $tasks->all()
        ]);
    });
    
});



// Accessible routes when logged in as an admin
Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
});

// Accessible routes when logged in as a faculty
Route::middleware(['auth', 'isEmployee'])->group(function() {
    Route::put('/dashboard/{studentFile}', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::resource('admin-roles', AdminRoleController::class);
    Route::get('admin-roles/data/{id}', function ($id) {
        $tasks = new Task();
        $student = Student::with('tasks')->where('user_id', $id)->first();
        $tasks = $student->tasks;

        return response()->json([
            "data" => $tasks->all()
        ]);
    });
    Route::prefix('admin-roles')->name('admin-roles.')->group(function() {
        Route::get('/{role}/students', [StudentListController::class, 'index'])->name('students.index');
    });

    Route::resource('admin-roles', AdminRoleController::class);
});

// Accessible routes when logged in as a student
Route::middleware(['auth', 'isStudent'])->group(function() {
    Route::resource('home', StudentDashboardController::class);
    Route::resource('profile', ProfileController::class);

    Route::prefix('panel-members')->name('panel-members.')->group(function() {
        Route::get('/{role}/submissions/submit/{type}', [StudentSubmissionController::class, 'create'])->name('submissions.create');
        Route::post('/{role}/submissions/submit/', [StudentSubmissionController::class, 'store'])->name('submissions.store');
        Route::get('/{role}/submissions', [StudentSubmissionController::class, 'index'])->name('submissions.index');
    });

    Route::resource('panel-members', PanelMemberController::class);
});

