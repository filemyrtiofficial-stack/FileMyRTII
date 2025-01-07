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

// Route::get('/', function () {
//     return view('welcome');
// });

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

use App\Http\Controllers\Template\SectionController;
use App\Http\Controllers\Template\MenuController;
use App\Http\Controllers\Template\TemplateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\LawyerController;





use App\Mail\MyTestEmail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;


Route::get("test-mail", function(){
	$name = "Test Coder";

    // The email sending is done using the to method on the Mail facade
    if(Mail::to('developmentd299@gmail.com')->send(new App\Mail\MyTestEmail())){
		echo "yes";
	}
	else {
		echo "no";
	}
});

Route::get("subscribe-now", function(){
	$name = "Test Coder";

    // The email sending is done using the to method on the Mail facade
    if(Mail::to('developmentd299@gmail.com')->send(new NewsletterMail())){
		echo "yes";
	}
	else {
		echo "no";
	}
});

// Route::get("test-mailer", function(){
//     Mail::to("developmentd299@gmail.com")->send(new App\Mail\MyTestEmail());
// });

// Route::post('/send-enquiry', [FrontendController::class, 'sendEnquiry'])->name('send-enquiry');
// Route::get('/service/{id}', [FrontendController::class, 'service'])->name('service-page');


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
	Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
		// Route::resource('hospitals', HospitalController::class);  
		// Route::resource('specialities', SpecializationController::class);    
		// Route::resource('doctors', DoctorController::class);    
		// Route::resource('disease', DiseaseController::class);    
		// Route::resource('disease-types', DiseaseTypeController::class);    
		// Route::resource('lab-tests', LabTestController::class);    
		// Route::resource('ambulances', AmbulanceController::class);    
		Route::resource('users', UserController::class);       
		Route::resource('enquiries', EnquiryController::class);       
		// Route::resource('labs', LabController::class);       
		Route::resource('categories', CategoryController::class);   
		Route::get('/blogcomment', [BlogController::class, 'blogCommentList'])->name('blog.comment.list'); 
		Route::resource('blogs', BlogController::class);       
		Route::resource('team-members', TeamMemberController::class);       
		Route::post('/update-menu-node', [MenuController::class, 'updateMenuNode'])->name('menu.MenuNodeStore');
		Route::resource('menu-setting', MenuController::class);    
		
		Route::get('/rtiapplications', [ServiceController::class, 'rtiApplicationsList'])->name('rti.applications.list');

		Route::get('/update-services-section/{services_id}/{section_type}/{id?}', [ServiceController::class, 'getSectionservices'])->name('get-services-section');
		Route::delete('/delete-services-section/{id?}', [ServiceController::class, 'deleteSectionservices'])->name('delete-services-section');

		Route::resource('services', ServiceController::class);  

		Route::get('/update-service-category-section/{service_category_id}/{section_type}/{id?}', [ServiceCategoryController::class, 'getSectionservices'])->name('get-service-category-section');
		Route::delete('/delete-service-category-section/{id?}', [ServiceController::class, 'deleteSectionservices'])->name('delete-service-category-section');
 
		Route::resource('service-category', ServiceCategoryController::class);       
		
		Route::resource('lawyers', LawyerController::class);  
		Route::post('/upload-images', [TemplateController::class, 'uploadImages'])->name('upload-images');
		

		Route::get('/update-page-section/{page_id}/{section_type}/{id?}', [TemplateController::class, 'getSectionPage'])->name('get-page-section');
		Route::delete('/delete-page-section/{id?}', [TemplateController::class, 'deleteSectionPage'])->name('delete-page-section');

		
		Route::post('/update-page-section/{page_id}', [TemplateController::class, 'updateSectionDetails'])->name('update-page-section');
		
		Route::resource('pages', TemplateController::class); 

		Route::get('/template-section-fields/{section_id}', [SectionController::class, 'fieldIndex'])->name('template-section-fields.index');
		Route::get('/template-section-fields/{section_id}/create', [SectionController::class, 'fieldCreate'])->name('template-section-fields.create');
		Route::post('/template-section-fields/{section_id}', [SectionController::class, 'fieldStore'])->name('template-section-fields.store');
		Route::get('/template-section-fields/{section_id}/{id}', [SectionController::class, 'fieldEdit'])->name('template-section-fields.edit');
		Route::delete('/template-section-fields/{id}', [SectionController::class, 'fieldDelete'])->name('template-section-fields.destroy');
		Route::put('/template-section-fields/{id}', [SectionController::class, 'fieldUpdate'])->name('template-section-fields.update');
		Route::get('/get-section', [SectionController::class, 'getSectionHtml'])->name('get-sections');
		
		Route::resource('template-section', SectionController::class); 
		// Route::resource('settings/{type?}', SettingController::class); 
		Route::resource('testimonials', TestimonialController::class); 
		Route::resource('newsletter', NewsletterController::class); 
		Route::resource('roles', RoleController::class); 

		Route::get('/settings/{type?}', [SettingController::class, 'index'])->name('settings.index');
		Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

		
		
		// Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
		// Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
		// Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
		// Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
		// Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
		// Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
		// Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
		// Route::get('/{page}', [PageController::class, 'index'])->name('page');
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	});


	Route::get('google', function(){

		return view('googleAuth');
		
		});
		Route::get('auth/google', [FrontendAuthController::class, 'redirectToGoogle']);
		Route::get('callback', [FrontendAuthController::class, 'handleGoogleCallback']);



Route::post('/subscribe-now', [FrontendController::class, 'sendNewsletter'])->name('subscribe-now');

Route::post('/service-form', [FrontendController::class, 'serviceFormAction'])->name('frontend.service-form');
Route::post('/udpate-payment-success', [FrontendController::class, 'udpatePaymentSuccess'])->name('update.payment.success');
Route::post('/udpate-payment-failed', [FrontendController::class, 'updatePaymentFailure'])->name('update.payment.failed');
Route::get('/apply/{service_slug?}', [FrontendController::class, 'serviceForm'])->name('frontend.service.form');
Route::get('/service/{service_category}/{service_slug?}', [FrontendController::class, 'serviceDetails'])->name('frontend.service');

// Route::get('/service/{service_slug?}', [FrontendController::class, 'serviceDetails'])->name('frontend.service');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog-details');
Route::post('/blog-listing', [FrontendController::class, 'blogListingAPI'])->name('search-blogs');
Route::get('/{slug?}', [FrontendController::class, 'index'])->name('home-page');
Route::post('/contact-us', [FrontendController::class, 'contactusForm'])->name('contact-form');
Route::post('/blog-Comment', [FrontendController::class, 'blogComment'])->name('blog-Comment');





