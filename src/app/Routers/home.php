<?php
use App\Controllers\Home;

Route::get('/home/{id}', function($id) {
    (new Home())->index($id);
});

Route::get('/', function() {
    (new Home())->index();
});