<?php

use App\Mail\ContactForm;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Contact form API
Route::post('/contact', function (Request $request) {

    $validation = $request->validate([
        'email' => 'required',
        'phone' => 'required',
        'fullName' => 'required',
        'comments' => 'required',
    ]);
    if (! empty($request->address)) {
        return response()->json(['Successly failed the honeypot']);
    }

    if (! $validation) {
        return response()->json([
            'success' => false,
            'message' => 'API Failed validation',
            // 'errors' => $request->errors()
        ]);
    }

    $email = Email::create([
        'email' => $request->email,
        'fullName' => $request->fullName,
        'phone' => $request->phone,
        'message' => $request->comments,
    ]);

    if ($email) {
        $response = [
            'message' => 'API Success',
            'email' => $request->email,
        ];

        Mail::to('contact@albertacraneservice.com')->send(new ContactForm($request->email, $request->fullName, $request->phone, $request->comments));

        return response(json_encode($response), 200);
    } else {
        return response(json_encode('Error with creating email'), 300);
    }
    // return json_encode($request->email);
});

// Crane Inventory API
// Parts Inventory API
// Equipment Inventory API
