<?php

namespace App\Mqtt\Listeners;

use App\Mqtt\Events\MqttPacketReceived;
use App\Mqtt\Events\PusherMqttEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class MqttEventsListener implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PusherMqttEvent $event): void
    {
        switch ($event->type) {
            //
            default:
                report(new \Exception("Unhandled Pusher MQTT Event [$event->type]"));
        }
    }
}
