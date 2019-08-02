<?php

use Illuminate\Http\Request;
use App\Contact;

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

Route::group(['middleware' => 'api'], function () {
    //fetch all the contacts
    Route::get('contacts', function () {
        return Contact::latest()->orderBy('created_at', 'desc')->get();
    });

    //fetch a single contact
    Route::get('contact/{id}', function ($id) {
        return Contact::findOrFail($id);
    });

    //Add a contact
    Route::post('contact/store', function (Request $request) {
        return Contact::create(['name'=>$request->input(['name']),'email'=>$request->input(['email']),'phone'=>$request->input(['phone'])]);
    });

    //update Contact
    Route::patch('contact/{id}', function(Request $request, $id){
        Contact::findOrFail($id)->update(['name'=>$request->input(['name']),'email'=>$request->input(['email']),'phone'=>$request->input(['phone'])]);
    });

    //delete the contact
    Route::delete('contact/{id}', function ($id) {
        return Contact::destroy($id);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
