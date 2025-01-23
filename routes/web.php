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
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;






use App\Mail\MyTestEmail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use App\Models\RtiApplication;

Route::get("test-mail", function(){
	$data = RtiApplication::where(['application_no' => '2024122287'])->first();
	return view('frontend.profile.rti-file', compact('data'));
// 	header("Content-type: application/vnd.ms-word");
//   header("Content-Disposition: attachment;Filename=document_name.doc");    
//   echo '<html>
// 	<body>
// 		<h2 style="color:rgb(50,150,200);">How to use Text Color?</h2>
// 		<h3 style="color:rgba(220,30,100,1);"> 1. Add a style attribute to the text element you want to colorize or use internal CSS.</h3>
// 		<h4 style="color:#1A8D7E"> 2. Specify the color using RGB, RGBA or HEX code.</h4>
// 	</body>
// </html>';
//   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
//   echo "<body>";
//   echo "<b>My first document</b><br>";
//   echo "<b style='color:rgba(220,30,100,1);'>hello1</b>";

//   echo "</body>";
//   echo "</html>";


	// $name = "Test Coder";

    // // The email sending is done using the to method on the Mail facade
    // if(Mail::to('developmentd299@gmail.com')->send(new App\Mail\MyTestEmail())){
	// 	echo "yes";
	// }
	// else {
	// 	echo "no";
	// }
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


	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	// Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/upload-images', [TemplateController::class, 'uploadImages'])->name('upload-images');
	Route::get('/preview-document/{document?}', [TemplateController::class, 'previewDocument'])->name('preview-document');

	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
		Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
		 
		Route::resource('users', UserController::class);       
		Route::resource('enquiries', EnquiryController::class);       
		Route::resource('categories', CategoryController::class);   
		Route::get('/blogcomment', [BlogController::class, 'blogCommentList'])->name('blog.comment.list'); 
		Route::resource('blogs', BlogController::class);       
		Route::resource('team-members', TeamMemberController::class);       
		Route::post('/update-menu-node', [MenuController::class, 'updateMenuNode'])->name('menu.MenuNodeStore');
		Route::resource('menu-setting', MenuController::class);    
		
		Route::post('/assign-lawyer/{id}', [ServiceController::class, 'assignLawyer'])->name('rti.applications.assign.lawyer');
		Route::get('/rtiapplications', [ServiceController::class, 'rtiApplicationsList'])->name('rti.applications.list');
		Route::get('/rtiapplications/{id?}', [ServiceController::class, 'view'])->name('rtiapplication.view');

		Route::get('/update-services-section/{services_id}/{section_type}/{id?}', [ServiceController::class, 'getSectionservices'])->name('get-services-section');
		Route::delete('/delete-services-section/{id?}', [ServiceController::class, 'deleteSectionservices'])->name('delete-services-section');

		Route::resource('services', ServiceController::class);  

		Route::get('/update-service-category-section/{service_category_id}/{section_type}/{id?}', [ServiceCategoryController::class, 'getSectionservices'])->name('get-service-category-section');
		Route::delete('/delete-service-category-section/{id?}', [ServiceController::class, 'deleteSectionservices'])->name('delete-service-category-section');
 
		Route::resource('service-category', ServiceCategoryController::class);       
		
		Route::resource('lawyers', LawyerController::class);  
		Route::resource('customers', CustomerController::class);  

		

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

		
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	});


	Route::get('google', function(){

	return view('googleAuth');
	
	});
	Route::get('auth/google', [FrontendAuthController::class, 'redirectToGoogle'])->name("auth.google");
	Route::get('callback', [FrontendAuthController::class, 'handleGoogleCallback']);
	Route::post('customer-signin', [FrontendAuthController::class, 'customerLogin'])->name('customer.login');
	Route::post('customer-logout', [FrontendAuthController::class, 'logout'])->name('customer.logout');
	Route::post('customer-register', [FrontendAuthController::class, 'register'])->name('customer.register');

	Route::post('forgot-password', [FrontendAuthController::class, 'forgotPassword'])->name('customer.forgot-password');
	Route::get('reset-password/{email}/{date}', [FrontendAuthController::class, 'resetPassword'])->name('customer.reset-password');
	Route::post('update-password', [FrontendAuthController::class, 'updatePassword'])->name('customer.update-password');
	Route::post('change-password', [FrontendAuthController::class, 'changePassword'])->name('customer.change-password');


	
	
Route::get('my-rti/{application_no?}', [FrontendCustomerController::class, 'myRti'])->name('my-rti');
	
Route::post('approve-rti/{application_no?}', [FrontendCustomerController::class, 'approvedARTI'])->name('approve-rti');
	

	

Route::post('/subscribe-now', [FrontendController::class, 'sendNewsletter'])->name('subscribe-now');

Route::post('/service-form', [FrontendController::class, 'serviceFormAction'])->name('frontend.service-form');
Route::post('/thank-you', [FrontendController::class, 'udpatePaymentSuccess'])->name('update.payment.success');
Route::post('/udpate-payment-failed', [FrontendController::class, 'updatePaymentFailure'])->name('update.payment.failed');
Route::get('/apply/{service_category}/{service_slug?}', [FrontendController::class, 'serviceForm'])->name('frontend.service.form');
Route::get('/service/{service_category}/{service_slug?}', [FrontendController::class, 'serviceDetails'])->name('frontend.service');
Route::get('/thank-you', [FrontendController::class, 'udpatePaymentSuccess'])->name('update.payment.success1	');

// Route::get('/service/{service_slug?}', [FrontendController::class, 'serviceDetails'])->name('frontend.service');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog-details');
Route::post('/blog-listing', [FrontendController::class, 'blogListingAPI'])->name('search-blogs');
Route::get('/{slug?}', [FrontendController::class, 'index'])->name('home-page');
Route::post('/contact-us', [FrontendController::class, 'contactusForm'])->name('contact-form');
Route::post('/blog-Comment', [FrontendController::class, 'blogComment'])->name('blog-Comment');







