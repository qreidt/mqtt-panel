<?php

namespace App\Listeners;

use App\Events\MqttPacketReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Laravel\Reverb\Events\MessageReceived;

class ReverbListener
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
    public function handle(MessageReceived $event): void
    {
        if (! $event->message || ! json_validate($event->message)) {
            return;
        }

        $message = json_decode($event->message, true);
        if (! $this->isMqttMessage($message)) {
            return;
        }

        Broadcast::event(new MqttPacketReceived($message['data']));
    }

    protected function isMqttMessage(array $message): bool
    {
        // Validate pusher schema
        if (! Arr::has($message, ['event', 'data', 'channel'])) {
            return false;
        }

        if (str_starts_with($message['event'], 'pusher')) {
            return false;
        }

        if ($message['channel'] !== 'mqtt') {
            return false;
        }

        return true;
    }
}
