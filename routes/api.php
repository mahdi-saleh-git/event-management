<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('events', EventController::class); //apiResource : to use for api event, will define route without the need for the form 

Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped(['attendee' => 'event']);