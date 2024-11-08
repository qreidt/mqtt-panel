<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEvent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherMqttEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public MqttEvent $type,
        public array $data
    )
    {
        //
    }
}
