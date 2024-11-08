<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEventType;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherMqttEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public MqttEventType $type,
        public array         $data
    )
    {
        //
    }
}
