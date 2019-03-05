<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

final class ActionsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function getActions()
    {        
        $actions = new QueueActions();
        
        $c = new \App\Command();
        $c->command = 'test';
        $c->pending = true;
        $c->date = new \DateTime();
        $c->save();
        
        $actions->actions = \App\Command::where('pending', true)->orderBy('id')->first();
        
        /*
        $step = 50;
        $currentStep = 0;
        do{
            if($currentStep == $step){
                break;
            }
            
            if($currentStep > 0){
                sleep(1);
            }
            
            $actions->actions = \App\Command::where('pending', true)->orderBy('id')->first();
            $currentStep ++;
            
        }while($actions->actions == null);*/
        
        return Response::json($actions, 200);
    }
    
    public function createAction(Request $request){
        $a = new  \App\Command();
        $input = $request->input();
        $a->action = $input['action'];
        $a->pending = true;
        $a->save();
        return Response::json($a, 200);
    }
    
    public function updateAction($id, Request $request){
        $input = $request->input();
        $action = \App\Command::where('id', $id)->first();
        $action->pending = false;
        $action->save();
        return Response::json($action, 200);
    }

}

class QueueActions{
    public $actions = array();
}