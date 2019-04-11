<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Command extends Model
{
    const COMMAND_TYPE_DIGITAL = 0;
    const COMMAND_TYPE_ANALOGIC = 1;    
    const COMMAND_ACTION_ACTIVATION = 1; //ativacao
    const COMMAND_ACTION_DEACTIVATION = 0; //desativacao
    
    public $table = 'commands';

    public $fillable = [
    ];
    
     protected $visible = ['id', 'pin', 'type', 'action', 'name', 'pending'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pin' => 'integer',
        'type' => 'integer',
        'action' => 'integer',
        'name' => 'string',
        'date' => 'datetime',
        'pending' => 'boolean'
    ];    
}
