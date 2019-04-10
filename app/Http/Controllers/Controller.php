<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    protected function sendOkResponse($obj){
        return Response::json($obj, 200);
    }
    
    protected function sendNoContentOkResponse($obj){
        return Response::json($obj, 204);
    }
    
    protected function sendCreatedResponse($obj){
        return Response::json($obj, 201);
    }
    
    protected function sendUnauthorizedResponse($obj){
        return Response::json($obj, 401);
    }
    
    protected function sendNotFoundResponse($obj){
        return Response::json($obj, 404);
    }
    
    protected function sendBadRequestResponse($obj){
        return Response::json($obj, 400);
    }
}
