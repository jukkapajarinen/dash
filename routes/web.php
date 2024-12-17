<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');
