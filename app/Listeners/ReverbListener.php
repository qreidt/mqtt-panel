<?php

namespace App\Listeners;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Events\PusherMqttEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Broadcast;
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

        Broadcast::event(new PusherMqttEvent(
            type: MqttEventType::from($message['event']),
            data: $message['data'])
        );
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

        if (! MqttEventType::tryFrom($message['event'])) {
            return false;
        }

        return true;
    }
}
