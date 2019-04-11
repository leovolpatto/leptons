<?php

use Illuminate\Http\Request;

Route::get('devices/{deviceId}/commands', 'DevicesCommandsController@getDeviceCommands');
Route::get('devices/{deviceId}/commands/{id}', 'DevicesCommandsController@getDeviceCommand');
Route::post('devices/{deviceId}/commands', 'DevicesCommandsController@createCommand');
Route::put('devices/{deviceId}/commands/{id}', 'DevicesCommandsController@confirmCommandExecution');

Route::get('devices/{id}', 'DevicesController@getDevice');
Route::get('devices', 'DevicesController@getDevices');
Route::post('devices', 'DevicesController@postDevice');
Route::delete('devices/{id}', 'DevicesController@deleteDevice');

Route::get('devices/{deviceId}/ports-configs', 'DevicePortsConfigController@getDeviceConfig');
Route::post('devices/{deviceId}/ports-configs', 'DevicePortsConfigController@postDevicePortConfig');
Route::delete('devices/{deviceId}/ports-configs', 'DevicePortsConfigController@deleteDevicePortConfigs');