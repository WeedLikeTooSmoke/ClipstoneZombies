<?php

Route::get('/', function () { return view('homepage'); })->name("homepage");
Route::get('/newspaper', function () { return view('newspaper'); })->name("newspaper");
Route::get('/search', function () { return view('search'); })->name("search");
Route::get('/leaderboards', function () { return view('leaderboard'); })->name("leaderboard");
Route::get('/statsleaderboard', function () { return view('statsleaderboard'); })->name("statsleaderboard");
Route::get('/usernames', function () { return view('usernames'); })->name("usernames");
Route::get('/ranks', function () { return view('ranks'); })->name("ranks");
Route::get('/money', function () { return view('money'); })->name("money");
Route::get('/servers', function () { return view('servers'); })->name("servers");
Route::get('/login', function () { return view('login'); })->name("login");
Route::get('/register', function () { return view('register'); })->name("register");
Route::get('/profile/{name}', function () { return view('profile'); })->name("profile");
Route::get('/settings', function () { return view('settings'); })->name("settings");
