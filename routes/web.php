<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\SquarePaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\FrontController;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Vehicle;
use App\Models\VehicleType;

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
    $sliders = Slider::orderBy('id','desc')->get();
    $types = VehicleType::with('vehicles')->get();
    $vehicles = Vehicle::all();
    $services = Event::where('type','service')->where('status','ACTIVE')->orderBy('id','asc')->get();
    return view('welcome',compact('sliders','types','vehicles','services'));
})->name('welcome');

Route::get('/thankyou',[FrontController::class, 'ThankYou'])->name('thank-you');

Route::get('/book-now/{step?}',[FrontController::class, 'BookingNew'])->name('book-now');
Route::get('/choose-vehicle',[FrontController::class, 'ChooseVehicle'])->name('book-vehicle');
Route::get('/contact-details',[FrontController::class, 'ContactDetail'])->name('booking-detail');

Route::post('/booking',[FrontController::class, 'booking'])->name('booking');
Route::post('/save-booking', [FrontController::class, 'saveBooking'])->name('savebooking');

Route::get('/payment/{slug}', [FrontController::class, 'Payment'])->name('payment');
Route::get('/make-payment/{slug}', [FrontController::class, 'MakePayment'])->name('make-payment');
Route::get('/payment_status/{slug}', [FrontController::class, 'PaymentStatus'])->name('payment_status');
Route::post('/paypal-payment-process/{slug}', [BookingController::class, 'PaypalPaymentComplete'])->name('paypal-payment-process');

Route::get('/checkout/{slug}', [FrontController::class, 'Checkout'])->name('checkout');

Route::get('/home', [FrontController::class, 'index'])->name('home');

Route::get('/about', [FrontController::class, 'about'])->name('about');

Route::get('/service', [FrontController::class, 'service'])->name('service');
Route::get('/servicehome/{slug?}', [FrontController::class, 'serviceHome'])->name('service-home');

Route::get('/fleet', [FrontController::class, 'fleet'])->name('fleet');
Route::get('/fleet-detail/{slug}', [FrontController::class, 'fleetDetail'])->name('fleet-detail');

Route::get('/event', [FrontController::class, 'event'])->name('event');
Route::get('/events/{slug}', [FrontController::class, 'EventHome'])->name('eventhome');

Route::get('/faq', [FrontController::class, 'faq'])->name('faq');

Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/add-contact-us', [FrontController::class, 'AddContact'])->name('add.contact');

Route::post('/get-vehicles-ajax',[FrontController::class, 'getVehicles'])->name('get-vehicles');
Route::post('/ajax-login',[FrontController::class,'AjaxLogin'])->name('login.post');
Route::post('/ajax-registration', [FrontController::class, 'AjaxRegister'])->name('register.post'); 

Route::post('/payment-square', [SquarePaymentController::class, 'initiatePayment'])->name('payment.initiate');

Auth::routes(); 


Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function()
{
    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
    //admin-user routes
    Route::get('admin-user',[UserController::class,'AdminIndex'])->name('admin.admin-user');
    Route::post('admin-add-user',[UserController::class,'AddAdminUser'])->name('admin.admin-add-user')->middleware('is_admin');
    Route::get('admin-edit-user/{slug}',[UserController::class,'EditAdminUser'])->name('admin.admin-edit-user')->middleware('is_admin');
    Route::post('admin-update-user/{slug}',[UserController::class,'UpdateAdminUser'])->name('admin.admin-update-user')->middleware('is_admin');
    Route::get('admin-delete-user/{slug}',[UserController::class,'DeleteAdminUser'])->name('admin.admin-delete-user')->middleware('is_admin');

    Route::get('user',[UserController::class,'Index'])->name('admin.user');
    Route::get('edit-user/{slug}',[UserController::class,'Edit'])->name('admin.edit-user');
    Route::post('update-user/{slug}',[UserController::class,'Update'])->name('admin.update-user');
    Route::get('delete-user/{slug}',[UserController::class,'Delete'])->name('admin.delete-user');

    //vehicle-type routes
    Route::get('vehicle-type',[VehicleController::class,'VehicleType'])->name('admin.vehicle_type');
    Route::post('add-vehicle-type',[VehicleController::class,'AddVehicleType'])->name('admin.add_vehicle_type');
    Route::get('edit-vehicle-type/{id}',[VehicleController::class,'EditVehicleType'])->name('admin.add_vehicle_type');
    Route::post('update-vehicle-type/{id}',[VehicleController::class,'UpdateVehicleType'])->name('admin.add_vehicle_type');
    Route::get('delete-vehicle-type/{id}',[VehicleController::class,'DeleteVehicleType'])->name('admin.delete_vehicle_type');
    //vehicle-attribute routes
    Route::get('vehicle-attribute',[VehicleController::class,'VehicleAttribute'])->name('admin.vehicle_attribute');
    Route::post('add-vehicle-attribute',[VehicleController::class,'AddVehicleAttribute'])->name('admin.add_vehicle_attribute');
    Route::get('edit-vehicle-attribute/{id}',[VehicleController::class,'EditVehicleAttribute'])->name('admin.edit_vehicle_attribute');
    Route::post('update-vehicle-attribute/{id}',[VehicleController::class,'UpdateVehicleAttribute'])->name('admin.update_vehicle_attribute');
    Route::get('delete-vehicle-attribute/{id}',[VehicleController::class,'DeleteVehicleAttribute'])->name('admin.delete_vehicle_attribute');
    //vehicle routes
    Route::get('vehicle',[VehicleController::class,'Vehicle'])->name('admin.vehicle');
    Route::get('add-vehicle',[VehicleController::class,'AddVehicle'])->name('admin.add_vehicle');
    Route::post('add-vehicle',[VehicleController::class,'AddVehicleStore'])->name('admin.add_new_vehicle');
    Route::get('edit-vehicle/{slug}',[VehicleController::class,'EditVehicle'])->name('admin.edit_vehicle');
    Route::post('update-vehicle/{slug}',[VehicleController::class,'UpdateVehicle'])->name('admin.update_vehicle');
    Route::get('delete-vehicle/{slug}',[VehicleController::class,'DeleteVehicle'])->name('admin.delete_vehicle');
    Route::get('delete-vehicle-image/{id}/{vehicle_id}',[VehicleController::class,'DeleteVehicleImage'])->name('admin.delete_vehicle_image');

    //Slider Master routes
    Route::get('slider-master',[SettingController::class,'SliderMaster'])->name('admin.slider_master');
    Route::post('add-slider-master',[SettingController::class,'AddSliderMaster'])->name('admin.add_slider_master');
    Route::get('edit-slider-master/{id}',[SettingController::class,'EditSliderMaster'])->name('admin.edit_slider_master');
    Route::post('update-slider-master/{id}',[SettingController::class,'UpdateSliderMaster'])->name('admin.update_slider_master');
    Route::get('delete-slider-master/{id}',[SettingController::class,'DeleteSliderMaster'])->name('admin.delete_slider_master');
    
    Route::get('service-master',[ServiceController::class,'Services'])->name('admin.service-master');
    Route::post('add-service-master',[ServiceController::class,'AddService'])->name('admin.add-service-master');
    Route::get('edit-service-master/{slug}',[ServiceController::class,'EditService'])->name('admin.edit-service-master');
    Route::post('update-service-master/{slug}',[ServiceController::class,'UpdateService'])->name('admin.update-service-master');
    Route::get('delete-service-master/{slug}',[ServiceController::class,'DeleteService'])->name('admin.delete-service-master');
    Route::get('service-sequence/{slug}/{sno}',[ServiceController::class,'ChangeServiceSNo'])->name('admin.service-sequence');

    Route::get('contacts',[ContactController::class,'Contact'])->name('admin.contacts');
    Route::get('view-contacts/{id}',[ContactController::class,'ViewContact'])->name('admin.view-message');
    Route::get('delete-contact/{id}',[ContactController::class,'DeleteContact'])->name('admin.delete-message');

    Route::get('bookings',[BookingController::class,'Bookings'])->name('admin.bookings');
    Route::get('view-bookings/{id}',[BookingController::class,'ViewBookings'])->name('admin.view-bookings');
    Route::get('delete-bookings/{id}',[BookingController::class,'DeleteBooking'])->name('admin.delete-bookings');
    Route::get('generate-pdf/{id?}', [BookingController::class, 'generatePDF'])->name('admin.generate-pdf');
    Route::post('change-booking-status/{slug}', [BookingController::class, 'ChangeBookingStatus'])->name('admin.change-booking-status');
    Route::post('generate-invoice', [BookingController::class, 'GenerateInvoice'])->name('admin.generate-invoice');

    Route::get('invoices',[InvoiceController::class,'Index'])->name('admin.invoices');
    Route::get('invoice-detail/{id}',[InvoiceController::class,'Detail'])->name('admin.invoice-detail');
    Route::get('delete-invoices/{id}',[InvoiceController::class,'Delete'])->name('admin.delete-invoices');
    Route::get('generate-invoice/{id?}', [InvoiceController::class, 'ViewPdf'])->name('admin.generate-invoice');

    Route::get('event-master',[ServiceController::class,'Events'])->name('admin.event-master');
    Route::post('add-event-master',[ServiceController::class,'AddEvents'])->name('admin.add-event-master');
    Route::get('edit-event-master/{slug}',[ServiceController::class,'EditEvent'])->name('admin.edit-event-master');
    Route::post('update-event-master/{slug}',[ServiceController::class,'UpdateEvent'])->name('admin.update-event-master');
    Route::get('delete-event-master/{slug}',[ServiceController::class,'DeleteEvent'])->name('admin.delete-event-master');

    Route::get('event-quote',[QuoteController::class,'Quote'])->name('admin.quotes');
    Route::get('edit-quote/{slug}',[QuoteController::class,'EditQuote'])->name('admin.edit-quote');
    Route::post('update-quote/{slug}',[QuoteController::class,'UpdateQuote'])->name('admin.update-quote');
    Route::get('delete-quote/{slug}',[QuoteController::class,'DeleteQuote'])->name('admin.delete-quote');

    Route::get('faq',[FAQController::class,'Faq'])->name('admin.faq');
    Route::get('add-faq',[FAQController::class,'AddFaq'])->name('admin.add-faq');
    Route::post('add-faq-save',[FAQController::class,'AddFaqSave'])->name('admin.add-faq-save');
    Route::get('edit-faq/{slug}',[FAQController::class,'EditFaq'])->name('admin.edit-faq');
    Route::post('update-faq/{slug}',[FAQController::class,'UpdateFaq'])->name('admin.update-faq');
    Route::get('delete-faq/{slug}',[FAQController::class,'DeleteFaq'])->name('admin.delete-faq');
    Route::get('faq-sequence/{slug}/{sno}',[FAQController::class,'ChangefaqSNo'])->name('admin.faq-sequence');
});


