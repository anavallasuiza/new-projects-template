<?php
if (config('app.debug')) {
    Route::get('/kitchen-sink', ['as' => 'kitchen-sink', 'uses' => function () {
        return view('web.kitchen-sink');
    }]);
}

Route::get('/', ['as' => 'welcome', 'uses' => function () {
    return view('welcome');
}]);
