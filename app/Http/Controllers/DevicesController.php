<?php

namespace App\Http\Controllers;

use Response;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class DevicesController extends Controller{
    
    public function getDevices(){
        $devices = \App\Models\Device::orderBy('name')->get();
        return $this->sendOkResponse($devices);
    }
    
    public function getDevice(string $id){
        $device = \App\Models\Device::where('id', $id)->get();
        if(count($device) == 0){
            return $this->sendNotFoundResponse($id);
        }
        
        return $this->sendOkResponse($device);
    }
    
    public function deleteDevice($id) {
        $device = \App\Models\Device::where('id', $id)->first();
        if($device == null){
            return $this->sendNotFoundResponse("$id not found");
        }
        
        $device->delete();
        return $this->sendOkResponse('');
    }
    
    public function postDevice(Request $request){
        if(\App\Models\Device::where('id', $request->input('id'))->first() != null){
            return $this->sendBadRequestResponse($request->input('id') . " already exists");
        }
        
        $device = new \App\Models\Device();
        $device->id = $request->input('id');
        $device->account_id = $request->input('account_id') ?? null;
        $device->active = $request->input('active');
        $device->name = $request->input('name') ?? $device->id;
        $device->description = $request->input('description') ?? "Novo Dispositivo";
        
        if($device->save()){
            return $this->sendCreatedResponse($device);
        }
        
        return $this->sendBadRequestResponse($device);
    }
}