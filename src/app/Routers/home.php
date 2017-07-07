<?php
use App\Controllers\Home;

Route::get('/home', function() {
    (new Home())->index();
});

Route::get('/', function() {
    (new Home())->index();
});