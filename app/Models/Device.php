<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Device extends Model
{
    public $table = 'devices';
    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
    ];
    
     protected $visible = ['id', 'active', 'name', 'description'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'active' => 'boolean',
        'name' => 'string',
        'description' => 'string'
    ];    
}
