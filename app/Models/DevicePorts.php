<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class DevicePorts extends Model
{
    public $table = 'devices_ports';
    const PORT_DIGITAL = 1;
    const PORT_ANALOGIC = 2;

    public $fillable = [
    ];
    
     protected $visible = ['device_id', 'port_id', 'type', 'allow_reading', 'allow_writing'];

    /**
     * @var array
     */
    protected $casts = [
        'device_id' => 'string',
        'port_id' => 'integer',
        'type' => 'string',
        'allow_reading' => 'boolean',
        'allow_writing' => 'boolean'
    ];
}
