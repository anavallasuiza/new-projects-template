<?php
if (config('app.debug')) {
    Route::get('/kitchen-sink', function () {
        return view('web.kitchen-sink');
    });
}
