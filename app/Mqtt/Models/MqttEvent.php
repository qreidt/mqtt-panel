<?php

namespace App\Mqtt\Models;

use App\Mqtt\Enums\MqttEventType;
use Illuminate\Database\Eloquent\Model;

class MqttEvent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'type',
        'data',
        'timestamp',
    ];

    protected $casts = [
        'type' => MqttEventType::class,
        'data' => 'array',
        'timestamp' => 'timestamp'
    ];
}
