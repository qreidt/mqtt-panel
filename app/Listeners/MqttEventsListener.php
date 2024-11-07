<?php

namespace App\Listeners;

use App\Events\MqttPacketReceived;
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
    public function handle(MqttPacketReceived $event): void
    {
        Log::info("Mqtt Packet Received", (array) $event);
    }
}
