<?php

namespace App\Http\Controllers;

use Response;
use App\Models\DevicePorts;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class DevicePortsConfigController extends Controller{
    
    public function getDeviceConfig(string $deviceId){
        $devices = DevicePorts::where('id', $deviceId)->orderBy('port_id')->get();
        return $this->sendOkResponse($devices);
    }
    
    public function deleteDevicePortConfigs(string $deviceId) {
        $configs = DevicePorts::where('id', $deviceId)->get();
        if($device == null){
            return $this->sendNotFoundResponse("$id not found");
        }
        
        foreach($configs as $c){
            $c->delete();
        }
        
        return $this->sendOkResponse('');
    }
    
    public function postDevicePortConfig(string $deviceId, Request $request){
        if(DevicePorts::where([['device_id', $deviceId], ['port_id', $request->input('port_id')]])->first() != null){
            return $this->sendBadRequestResponse($request->input('port_id') . " already configured");
        }
        
        $port = new DevicePorts();
        $port->device_id = $deviceId;
        $port->type = $request->input('type');
        $port->port_id = $request->input('port_id');
        $port->allow_reading = $request->input('allow_reading');
        $port->allow_writing = $request->input('allow_writing');
        
        if($port->save()){
            return $this->sendCreatedResponse($port);
        }
        
        return $this->sendBadRequestResponse($port);
    }
}