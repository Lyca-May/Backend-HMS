<?php

use App\Http\Resources\VisitResource;
use App\Models\Visit;
use App\Http\Controllers\VisitController;
use App\Http\Resources\ConferenceResource;
use App\Models\Conference;
use App\Http\Controllers\ConferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;

// Public Routes


//For Bookings
Route::get('/visits', function(){
    $completedVisits = DB::table('visits')
                    ->where('status', 'confirmed')
                    ->get();
return response()->json($completedVisits);
    // return VisitResource::collection(Visit::all());
});
Route::get('/visits/{id}', function($id){
    return new VisitResource(Visit::findOrFail($id));
});
Route::post('/visitscreate', [VisitController::class, 'store']);
Route::put('/visitsupdate/{id}', [VisitController::class, 'update'] );
Route::put('/data/{id}', [VisitController::class, 'updateStatus'] );
Route::put('/visits/{id}', [VisitController::class, 'addReason']);


//For Appointments
Route::get('/fetchappoint', function(){
    return ConferenceResource::collection(Conference::all());
});
Route::get('/appoint/{id}', function($id){
    return new ConferenceResource(Conference::findOrFail($id));
});
Route::post('/appoints', [ConferenceController::class, 'store']);
Route::put('/updateappoint/{id}', [ConferenceController::class, 'update'] );
// Route::put('/updateappoint/{id}}', function(Request $request, $id) {
//     $visit = Conference::findOrFail($id);
//     $visit->fullname = $request->input('fullname');
//     $visit->address = $request->input('address');
//     $visit->phoneno = $request->input('phoneno');
//     $visit->date_of_appoint = $request->input('date_of_appoint');
//     $visit->session = $request->input('session');
//     $visit->no_of_participantss = $request->input('no_of_participantss');
//     $visit->name_of_institution = $request->input('name_of_institution');
//     $visit->save();
//     return response()->json(['message' => 'User updated successfully']);
// });

//Authentication
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/userdata', [UserController::class, 'index']);
Route::post('/send-reset-password-email', [PasswordResetController::class, 'send_reset_password_email']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset']);
Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');


// Protected Routes
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/loggeduser', [UserController::class, 'logged_user']);
    Route::post('/changepassword', [UserController::class, 'change_password']); 
});