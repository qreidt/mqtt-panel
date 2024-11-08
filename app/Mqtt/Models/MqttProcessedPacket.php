<?php

namespace App\Mqtt\Models;

use Illuminate\Database\Eloquent\Model;

class MqttProcessedPacket extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'packet_id',
        'timestamp',
        'packet_id',
        'packet_type',
        'packet_length',
    ];
}
