<?php

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

Route::auth(['register' => false]);
Route::get('/', function () {
    return view('main');
});
// Dashboard Routes
Route::get('welcome', 'HomeController@welcome')->name('welcome');
Route::get('home', 'HomeController@index')->name('home');
Route::get('billing', 'HomeController@billing')->name('admin.billing');
Route::get('addNotes', 'HomeController@addNotes')->name('addNotes');
Route::get('biller','BillerController@home')->name('biller.dashboard');
Route::get('biller/bill_payed/{visit_id}', 'BillerController@payed')->name('bill.payed');

// Live Chat routes
Route::get('patient/liveChat','ConversationController@index')->name('patient.liveChat');
Route::post('patient/liveChat','ConversationController@manageChat');
Route::post('patient/liveChat/store','ConversationController@store')->name('conversations.store');

/*
 *  User Routes
 */
Route::get('users', 'UserController@viewAll')->name('users.index');
Route::get('users/create', 'UserController@createUser')->name('users.create');
Route::post('users', 'UserController@addUser')->name('users.store');
Route::get('users/{id}', 'UserController@getUser')->name('users.show');
Route::patch('users/{id}', 'UserController@updateUser')->name('users.update');
Route::delete('users/{id}', 'UserController@deleteUser')->name('users.destroy');
/*
 *  Patient Routes
 */
Route::get('patients', 'PatientController@viewAll')->name('patients.index');
Route::get('tele_medicine/patients', 'PatientController@tele_medicine')->name('patients.teleMed');
Route::get('patients/create', 'PatientController@createPatient')->name('patients.create');
Route::post('patients', 'PatientController@addPatient')->name('patients.store');
Route::get('patients/{id}', 'PatientController@getPatient')->name('patients.show');
Route::patch('patients/{id}', 'PatientController@updatePatient')->name('patients.update');
Route::delete('patients/{id}', 'PatientController@deletePatient')->name('patients.destroy');
/*
 *  Patient visits Routes
 */
Route::get('visits', 'PatientVisitController@allVisits')->name('visits.all');
Route::get('visits/today', 'PatientVisitController@todayVisits')->name('visits.today');
Route::get('patients/{patient}/visits', 'PatientVisitController@patientVisits')->name('visits.index');
Route::get('patients/{patient_id}/visits/create', 'PatientVisitController@showVisitForm')->name('visits.create');
Route::post('patients/{patient_id}/visit', 'PatientVisitController@createVisit')->name('visits.store');
Route::get('visits/{visit}/details', 'PatientVisitController@patientVisitsDetails')->name('visits.show');
Route::get('visits/{visit}/print', 'PatientVisitController@print')->name('visits.print');
Route::get('visits/{visit}/readytodischarge', 'PatientVisitController@readytodischarge')->name('visits.readytodischarge');
Route::get('visits/{visit}/signed', 'PatientVisitController@signed')->name('visits.signed');
Route::get('visits/{visit}/discharge', 'PatientVisitController@dischargePatient')->name('visits.discharge');

/*
 *  Tele-Medicine Routes
 */

Route::get('appointments', 'PatientAppointmentController@index')->name('appointments.index');
Route::get('appointments/today', 'PatientAppointmentController@today')->name('appointments.today');
Route::get('patients/{patient}/appointments/create', 'PatientAppointmentController@create')->name('appointments.create');
Route::post('patients/{patient}/appointments/', 'PatientAppointmentController@store')->name('appointments.store');
Route::get('patients/{patient}/appointments/attend', 'PatientAppointmentController@attendPatient')->name('appointments.attend');

/*
 *  VitalSigns Routes
 */

Route::get('visits/{visit_id}/vitalSign/create', 'PatientVitalSignController@showCreateForm')->name('vitalSigns.create');
Route::post('visit/{visit_id}/vitalSign', 'PatientVitalSignController@createVitalSign')->name('vitalSigns.store');
Route::patch('vitalSign/{vitalSign_id}', 'PatientVitalSignController@updateVitalSign')->name('vitalSigns.update');

/*
 *  Note Routes
 */

Route::get('visits/{visit_id}/notes/create', 'VisitNoteController@showCreateForm')->name('notes.create');
Route::post('visits/{visit}/notes', 'VisitNoteController@createNote')->name('notes.store');
Route::get('visits/{visit}/edit', 'VisitNoteController@editNote')->name('notes.edit');
Route::patch('visits/{visit}/notes/{note_id}', 'VisitNoteController@updateNote')->name('notes.update');

/*
 *  Other Routes
 */

Route::post('visits/{visit_id}/review', 'PatientDocumentationController@storeReviews')->name('reviews.store');
Route::post('visits/{visit_id}/exams', 'PatientDocumentationController@storeExams')->name('patient.exams.store');

/*
 *  Tests Routes
 */
Route::get('tests', 'TestController@viewAll')->name('tests.index');
Route::get('tests/create', 'TestController@createTest')->name('tests.create');
Route::get('tests/{id}', 'TestController@getTest')->name('tests.show');
Route::post('tests', 'TestController@addTest')->name('tests.store');
Route::patch('tests/{id}', 'TestController@updateTest')->name('tests.update');
Route::delete('tests/{id}', 'TestController@deleteTest')->name('tests.destroy');
/*
 *  Treatments Routes
 */
Route::get('treatments', 'TreatmentController@viewAll')->name('treatments.index');
Route::get('treatments/create', 'TreatmentController@createTreatment')->name('treatments.create');
Route::get('treatments/{id}', 'TreatmentController@getTreatment')->name('treatments.show');
Route::post('treatments', 'TreatmentController@addTreatment')->name('treatments.store');
Route::patch('treatments/{id}', 'TreatmentController@updateTreatment')->name('treatments.update');
Route::delete('treatments/{id}', 'TreatmentController@deleteTreatment')->name('treatments.destroy');
/*
 *  VisitsFees Routes
 */

Route::get('fees', 'VisitsFeeController@viewAll')->name('fees.index');
Route::get('fee/create', 'VisitsFeeController@createFee')->name('fees.create');
Route::post('fee', 'VisitsFeeController@addFee')->name('fees.store');
Route::get('fee/{fee_id}/edit', 'VisitsFeeController@editFee')->name('fees.edit');
Route::patch('fee/{fee_id}', 'VisitsFeeController@updateFee')->name('fees.update');
Route::delete('fee/{fee_id}', 'VisitsFeeController@deleteFee')->name('fees.destroy');
/*
 *  System Reviews Routes
 */

Route::get('systemReviews', 'SystemReviewController@index')->name('systemReviews.index');
Route::get('systemReviews/create', 'SystemReviewController@create')->name('systemReviews.create');
Route::post('systemReviews', 'SystemReviewController@store')->name('systemReviews.store');
Route::get('systemReviews/{id}/edit', 'SystemReviewController@edit')->name('systemReviews.edit');
Route::patch('systemReviews/{id}', 'SystemReviewController@update')->name('systemReviews.update');
Route::delete('systemReviews/{id}', 'SystemReviewController@delete')->name('systemReviews.destroy');

/*
 *
 *sub options
*/
Route::get('systemReviewsSuboption/{id}', 'SystemReviewSuboptionController@index')->name('systemReviewsSuboption.index');
Route::get('systemReviewsSuboption/create/{id}', 'SystemReviewSuboptionController@create')->name('systemReviewsSuboption.create');
Route::post('systemReviewsSuboption', 'SystemReviewSuboptionController@store')->name('systemReviewsSuboption.store');
Route::get('systemReviewsSuboption/{id}/edit', 'SystemReviewSuboptionController@edit')->name('systemReviewsSuboption.edit');
Route::patch('systemReviewsSuboption/{id}', 'SystemReviewSuboptionController@update')->name('systemReviewsSuboption.update');
Route::delete('systemReviewsSuboption/{id}', 'SystemReviewSuboptionController@delete')->name('systemReviewsSuboption.destroy');

/*
/*
 *  Physical Exam
 */

Route::get('physicalExams', 'PhysicalExamController@index')->name('physicalExams.index');
Route::get('physicalExams/create', 'PhysicalExamController@create')->name('physicalExams.create');
Route::post('physicalExams', 'PhysicalExamController@store')->name('physicalExams.store');
Route::get('physicalExams/{id}/edit', 'PhysicalExamController@edit')->name('physicalExams.edit');
Route::patch('physicalExams/{id}', 'PhysicalExamController@update')->name('physicalExams.update');
Route::delete('physicalExams/{id}', 'PhysicalExamController@delete')->name('physicalExams.destroy');

/*
 *  Medication Routes
 */
Route::get('medications', 'MedicationController@index')->name('medications.index');
Route::get('medications/create', 'MedicationController@create')->name('medications.create');
Route::post('medications', 'MedicationController@store')->name('medications.store');
Route::get('medications/{id}/edit', 'MedicationController@edit')->name('medications.edit');
Route::patch('medications/{id}', 'MedicationController@update')->name('medications.update');
Route::delete('medications/{id}', 'MedicationController@delete')->name('medications.destroy');

/*
/*
 *  Admin Dispositions
 */

Route::get('dispositions', 'DispositionController@index')->name('dispositions.index');
Route::get('dispositions/create', 'DispositionController@create')->name('dispositions.create');
Route::post('dispositions', 'DispositionController@store')->name('dispositions.store');
Route::get('dispositions/{id}/edit', 'DispositionController@edit')->name('dispositions.edit');
Route::patch('dispositions/{id}', 'DispositionController@update')->name('dispositions.update');
Route::delete('dispositions/{id}', 'DispositionController@delete')->name('dispositions.destroy');

/*
/*
 *   Diagnosis
 */

Route::get('diagnosis', 'DiagnosisController@index')->name('diagnosis.index');
Route::get('diagnosis/create', 'DiagnosisController@create')->name('diagnosis.create');
Route::post('diagnosis', 'DiagnosisController@store')->name('diagnosis.store');
//Route::get('diagnosis/{id}/edit', 'DiagnosisController@edit')->name('diagnosis.edit');
//Route::patch('diagnosis/{id}', 'DiagnosisController@update')->name('diagnosis.update');
//Route::delete('diagnosis/{id}', 'DiagnosisController@delete')->name('diagnosis.destroy');
