<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/admindashboard',function(){
    return view ('admindashboard.index');
})->name('dash');

route::get('/doctors',function(){
    return view ('admindashboard.doctors.index');
})->name('doc');

route::get('/patient',function(){
    return view ('admindashboard.patient.index');
})->name('pat');