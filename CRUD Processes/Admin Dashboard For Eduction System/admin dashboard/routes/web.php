<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeesinvoicesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrarController;
use App\Http\Controllers\PaymentstudentController;
use App\Http\Controllers\ProcessingfeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReceiptstudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Attendance;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use Psy\ExecutionLoop\ProcessForker;

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

require __DIR__ . '/auth.php';
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------
// Route::get("/",[RegisteredUserController::class,"create"]);     
// Route::get("/",[HomeController::class,"index"])->name("selection");             
// Route::get("/dashboard", [HomeController::class, "dashboard"])->name("dashboard");    
// Route::group(["namespace" => "Auth"], function () {
//   Route::get("/login/{type}", [LoginController::class, "loginForm"])->middleware("guest")->name("login.show");
//   Route::post("/login", [LoginController::class, "login"])->name("login");
//   Route::get("logout/{type}",[LoginController::class,"logout"])->name("logout");     
// }); 
//-------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------  
Route::get('/', function () {
  return view('welcome');
});        
Route::group(
  [
    'prefix' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', "auth:web"]
  ],
  function () {
    Route::get("/dashboard", function () {
      return View("dashboard");
    })->name("dashboard");
    Route::middleware('auth')->group(function () {
      Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
      Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
      Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(GradeController::class)->group(function () {
      Route::get("gradesList", "gradesList")->name("gradesList");
      Route::post("gradeStore", "gradeStore")->name("Gradestore");
      Route::post("gradeUpdate", "gradeUpdate")->name("gradeUpdate");
      Route::post("deleteGrade", "deleteGrade")->name("deleteGrade");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(ClassroomController::class)->group(function () {
      Route::get("classroomList", "classroomList")->name("classroomList");
      Route::post("classroomStore", "classroomStore")->name("Classstore");
      Route::post("classroomUpdate", "classroomUpdate")->name("classroomUpdate");
      Route::post("deleteClassroom", "deleteClassroom")->name("deleteClassroom");
      Route::post("deleteAllSelectedClassrooms", "deleteAllSelectedClassrooms")->name("deleteAllSelectedClassrooms");
      Route::post("classroomSearch", "classroomSearch")->name("classroomSearch");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------       
    Route::controller(SectionController::class)->group(function () {
      Route::get("sectionsList", "sectionsList")->name("sections");
      Route::get("classes/{id}", "classes");
      Route::post("SectionStore", "SectionStore")->name("SectionStore");
      Route::post("sectionUpdate", "sectionUpdate")->name("sectionUpdate");
      Route::post("deleteSection", "deleteSection")->name("deleteSection");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::view("parentsInfo", "livewire/parentsInfo")->name("add_parent");
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(TeacherController::class)->group(function () {
      Route::get("teachersList", "teachersList")->name("teachersList");
      Route::get("addTeacher", "addTeacher")->name("addTeacher");
      Route::post("teacherStore", "teacherStore")->name("teacherStore");
      Route::get("teacherEdit/{id}", "teacherEdit")->name("teacherEdit");
      Route::post("teacherUpdate", "teacherUpdate")->name("teacherUpdate");
      Route::post("teacherDelete", "teacherDelete")->name("teacherDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    Route::controller(StudentController::class)->group(function () {
      Route::get("createStudent", "createStudent")->name("createStudent");
      Route::get("Get_classrooms/{id}", "Get_classrooms");
      Route::get("Get_Sections/{id}", "Get_Sections");
      Route::post("studentStore", "studentStore")->name("studentStore");
      Route::get("studentList", "studentList")->name("studentList");
      Route::get("studentEdit/{id}", "studentEdit")->name("studentEdit");
      Route::post("studentUpdate", "studentUpdate")->name("studentUpdate");
      Route::post("studentDelete", "studentDelete")->name("studentDelete");
      Route::get("showStudentDetails/{id}", "showStudentDetails")->name("showStudentDetails");
      Route::post("uploadAttachments", "uploadAttachments")->name("uploadAttachments");
      Route::get("downloadAttachment/{studentName}/{fileName}", "downloadAttachment")->name("downloadAttachment");
      Route::post("deleteAttchment", "deleteAttchment")->name("deleteAttchment");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------     
    Route::controller(PromotionController::class)->group(function () {
      Route::get("index", "index")->name("index");
      Route::post("promotionStore", "promotionStore")->name("promotionStore");
      Route::get("promotionsDisplay", "promotionsDisplay")->name("promotionsDisplay");
      Route::post("promotionsDeleteAll", "promotionsDeleteAll")->name("promotionsDeleteAll");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    Route::controller(GraduateController::class)->group(function () {
      Route::get("createGraduate", "createGraduate")->name("createGraduate");
      Route::post("graduateSoftDeletes", "graduateSoftDeletes")->name("graduateSoftDeletes");
      Route::get("graduateIndex", "graduateIndex")->name("graduateIndex");
      Route::post("graduateRestore", "graduateRestore")->name("graduateRestore");
      Route::post("graduateDelete", "graduateDelete")->name("graduateDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(FeeController::class)->group(function () {
      Route::get("feesIndex", "feesIndex")->name("feesIndex");
      Route::get("feesAdd", "feesAdd")->name("feesAdd");
      Route::post("feesStore", "feesStore")->name("feesStore");
      Route::get("feesEdit/{id}", "feesEdit")->name("feesEdit");
      Route::post("feesUpdate", "feesUpdate")->name("feesUpdate");
      Route::post("feesDelete", "feesDelete")->name("feesDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(FeesinvoicesController::class)->group(function () {
      Route::get("feesInvoicesIndex", "feesInvoicesIndex")->name("feesInvoicesIndex");
      Route::get("feesInvoicesAdd/{id}", "feesInvoicesAdd")->name("feesInvoicesAdd");
      Route::post("feesInvoivesStore", "feesInvoivesStore")->name("feesInvoivesStore");
      Route::get("feesInvoicesEdit/{id}", "feesInvoicesEdit")->name("feesInvoicesEdit");
      Route::post("feesInvoicesUpdate", "feesInvoicesUpdate")->name("feesInvoicesUpdate");
      Route::post("feesInvoicesDelete", "feesInvoicesDelete")->name("feesInvoicesDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(ReceiptstudentController::class)->group(function () {
      Route::get("studentAddReciept/{id}", "studentAddReciept")->name("studentAddReciept");
      Route::post("studentRecieptStore", "studentRecieptStore")->name("studentRecieptStore");
      Route::get("studentRecieptIndex", "studentRecieptIndex")->name("studentRecieptIndex");
      Route::get("studentRecieptEdit/{id}", "studentRecieptEdit")->name("studentRecieptEdit");
      Route::post("studentRecieptUpdate", "studentRecieptUpdate")->name("studentRecieptUpdate");
      Route::post("studentRecieptDelete", "studentRecieptDelete")->name("studentRecieptDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    Route::controller(ProcessingfeeController::class)->group(function () {
      Route::get("processingFeesAdd/{id}", "processingFeesAdd")->name("processingFeesAdd");
      Route::post("precessingFeesStore", "precessingFeesStore")->name("precessingFeesStore");
      Route::get("processingFeesIndex", "processingFeesIndex")->name("processingFeesIndex");
      Route::get("processingFeesEdit/{id}", "processingFeesEdit")->name("processingFeesEdit");
      Route::post("processingFeesUpdate", "processingFeesUpdate")->name("processingFeesUpdate");
      Route::post("processingFeesDelete", "processingFeesDelete")->name("processingFeesDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------  
    Route::controller(PaymentstudentController::class)->group(function () {
      Route::get("paymentStudentAdd/{id}", "paymentStudentAdd")->name("paymentStudentAdd");
      Route::post("paymentStudentStore", "paymentStudentStore")->name("paymentStudentStore");
      Route::get("paymentStudentIndex", "paymentStudentIndex")->name("paymentStudentIndex");
      Route::get("paymentStudentEdit/{id}", "paymentStudentEdit")->name("paymentStudentEdit");
      Route::post("paymentStudentUpdate", "paymentStudentUpdate")->name("paymentStudentUpdate");
      Route::post("paymentStudentDelete", "paymentStudentDelete")->name("paymentStudentDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(AttendanceController::class)->group(function () {
      Route::get("attendanceGradesList", "attendanceGradesList")->name("attendanceGradesList");
      Route::get("attendanceAdd/{id}", "attendanceAdd")->name("attendanceAdd");
      Route::post("attendanceStore", "attendanceStore")->name("attendanceStore");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------------------------------------
    Route::controller(SubjectController::class)->group(function () {
      Route::get("subjectsIndex", "subjectsIndex")->name("subjectsIndex");
      Route::get("subjectCreate", "subjectCreate")->name("subjectCreate");
      Route::post("subjectsStore", "subjectsStore")->name("subjectsStore");
      Route::get("subjectEdit/{id}", "subjectEdit")->name("subjectEdit");
      Route::post("subjectUpdate", "subjectUpdate")->name("subjectUpdate");
      Route::post("subjectDelete", "subjectDelete")->name("subjectDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::controller(ExamController::class)->group(function () {
      Route::get("examsIndex", "examsIndex")->name("examsIndex");
      Route::get("examsCreate", "examsCreate")->name("examsCreate");
      Route::post("examsStore", "examsStore")->name("examsStore");
      Route::get("examEdit/{id}", "examEdit")->name("examEdit");
      Route::post("examUpdate", "examUpdate")->name("examUpdate");
      Route::post("examDelete", "examDelete")->name("examDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::controller(QuizController::class)->group(function () {
      Route::get("quizIndex", "quizIndex")->name("quizIndex");
      Route::get("quizCreate", "quizCreate")->name("quizCreate");
      Route::post("quizStore", "quizStore")->name("quizStore");
      Route::get("quizEdit/{id}", "quizEdit")->name("quizEdit");
      Route::post("quizUpdate", "quizUpdate")->name("quizUpdate");
      Route::post("quizDelete", "quizDelete")->name("quizDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::controller(QuestionController::class)->group(function () {
      Route::get("questionsList", "questionsList")->name("questionsList");
      Route::get("questionCreate", "questionCreate")->name("questionCreate");
      Route::post("questionStore", "questionStore")->name("questionStore");
      Route::get("questionEdit/{id}", "questionEdit")->name("questionEdit");
      Route::post("questionUpdate", "questionUpdate")->name("questionUpdate");
      Route::post("questionDelete", "questionDelete")->name("questionDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::controller(LibrarController::class)->group(function () {
      Route::get("libraryIndex", "libraryIndex")->name("libraryIndex");
      Route::get("libraryAdd", "libraryAdd")->name("libraryAdd");
      Route::post("libraryStore", "libraryStore")->name("libraryStore");
      Route::get("libraryDownload/{id}", "libraryDownload")->name("libraryDownload");
      Route::get("libraryEdit/{id}", "libraryEdit")->name("libraryEdit");
      Route::post("libraryUpdate", "libraryUpdate")->name("libraryUpdate");
      Route::post("libraryDelete", "libraryDelete")->name("libraryDelete");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
    Route::controller(SettingController::class)->group(function () {
      Route::get("settingIndex", "settingIndex")->name("settingIndex");
      Route::post("settingupdate", "settingupdate")->name("settingupdate");
    });
    //-------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------- 
  }
);
