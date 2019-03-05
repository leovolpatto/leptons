<?php

use Illuminate\Http\Request;

Route::get('actions', 'ActionsController@getActions');
Route::post('actions', 'ActionsController@createAction');
Route::put('actions/{id}', 'ActionsController@updateAction');