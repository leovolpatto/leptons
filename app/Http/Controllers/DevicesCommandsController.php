<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Command;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

final class DevicesCommandsController extends Controller
{
    private $validTypes = array();
    private $actionTypes = array();
    
    public function __construct() {
        $this->validTypes[] = Command::COMMAND_TYPE_ANALOGIC;
        $this->validTypes[] = Command::COMMAND_TYPE_DIGITAL;
        
        $this->actionTypes[] = Command::COMMAND_ACTION_ACTIVATION;
        $this->actionTypes[] = Command::COMMAND_ACTION_DEACTIVATION;
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function getDeviceCommands(string $deviceId)
    {        
        $actions = new QueuedCommands();
        
        $step = 2;
        $currentStep = 0;
        do{
            if($currentStep == $step){
                break;
            }
            
            if($currentStep > 0){
                sleep(1);
            }
            
            $actions->commands = Command::where([['device_id', $deviceId], ['pending', true]])->orderBy('id')->first();
            $currentStep ++;
            
        }while($actions->commands == null);
        
        if($actions->commands === null){
            return $this->sendNoContentOkResponse([]);
        }
        
        return $this->sendOkResponse($actions);
    }
    
    public function createCommand(string $deviceId, Request $request){
        $input = $request->input();
        
        if(!$request->has('type') || !$request->has('action') || !$request->has('pin')){
            return $this->sendBadRequestResponse('type, action and pin must be informed');
        }
                
        if(!in_array($input['type'], $this->validTypes)){
            return $this->sendBadRequestResponse("Invalid type");
        }
        if(!in_array($input['action'], $this->actionTypes)){
            return $this->sendBadRequestResponse("Invalid action");
        }
        
        $a = new  Command();
        $a->device_id = $deviceId;
        $a->action = $input['action'];
        $a->pin = $input['pin'];
        $a->type = $input['type'];
        $a->name = $input['name'];
        $a->date = new \DateTime();
        $a->pending = true;
        try{
            $a->save();
            return $this->sendCreatedResponse($a);
        }
        catch(\Exception $exp){
            if(isset($exp->errorInfo)){
                if(isset($exp->errorInfo[1]) && $exp->errorInfo[1] == 1452){
                    return $this->sendBadRequestResponse("Device $deviceId is not authorized");
                }
                return $this->sendBadRequestResponse($exp->errorInfo);
            }
            
            return $this->sendBadRequestResponse($exp);
        }
    }
    
    public function confirmCommandExecution($deviceId, $id, Request $request){
        $input = $request->input();
        $action = Command::where([['device_id', $deviceId], ['id', $id]])->first();
        
        if($action == null){
            return $this->sendNotFoundResponse("Command $id not found");
        }
        
        $action->pending = false;
        $action->save();
        return $this->sendOkResponse($action);
    }

}

class QueuedCommands{
    public $commands = array();
}