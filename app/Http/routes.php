<?php

Route::get('/', function () {
    return view('welcome');
});

if (config('app.debug')) {
    Route::get('/kitchen-sink', function () {
        return view('web.kitchen-sink');
    });
}
