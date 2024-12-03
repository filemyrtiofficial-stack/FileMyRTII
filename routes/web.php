<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;   
use App\Http\Controllers\ParagraphController;  
use App\Http\Controllers\UserController;  
use App\Http\Controllers\HospitalController;   
use App\Http\Controllers\SpecializationController;            
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DiseaseTypeController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamMemberController;




use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;


Route::get("test-mail", function(){
	$name = "Test Coder";

    // The email sending is done using the to method on the Mail facade
    if(Mail::to('developmentd299@gmail.com')->send(new MyTestEmail())){
		echo "yes";
	}
	else {
		echo "no";
	}
});

Route::get("test-mailer", function(){
    Mail::to("developmentd299@gmail.com")->send(new App\Mail\MyTestEmail());
});

Route::get('/', [FrontendController::class, 'index'])->name('home-page');
Route::post('/send-enquiry', [FrontendController::class, 'sendEnquiry'])->name('send-enquiry');
Route::get('/service/{id}', [FrontendController::class, 'service'])->name('service-page');


// Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
// Route::get('/service', [FrontendController::class, 'service'])->name('service');


// Route::get('/', function(){
// 	return view('coming-soon');
// });
// Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	// Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');

	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
	Route::resource('hospitals', HospitalController::class);  
	Route::resource('specialities', SpecializationController::class);    
	Route::resource('doctors', DoctorController::class);    
	Route::resource('disease', DiseaseController::class);    
	Route::resource('disease-types', DiseaseTypeController::class);    
	Route::resource('lab-tests', LabTestController::class);    
	Route::resource('ambulances', AmbulanceController::class);    
	Route::resource('users', UserController::class);       
	Route::resource('enquiries', EnquiryController::class);       
	Route::resource('categoies', CategoryController::class);    
	Route::resource('blogs', BlogController::class);       
	Route::resource('labs', LabController::class);       
	Route::resource('service-category', ServiceCategoryController::class);       
	Route::resource('team-members', TeamMemberController::class);       

	
	Route::resource('services', ServiceController::class);       
	   
	
	
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

});

