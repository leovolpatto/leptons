<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Command extends Model
{
    public $table = 'commands';

    public $fillable = [
    ];
    
     protected $visible = ['id', 'action'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'action' => 'string',
        'date' => 'datetime',
        'pending' => 'boolean'
    ];    
}
