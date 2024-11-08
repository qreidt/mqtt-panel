<?php

namespace App\Mqtt\Listeners;

use App\Mqtt\Enums\MqttEvent;
use App\Mqtt\Events\MqttPacketProcessedEvent;
use App\Mqtt\Events\ProcessableMqttEvent;
use App\Mqtt\Events\PusherMqttEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
        try {
            $mqtt_event_class = $this->selectMqttEvent($event->type);
            $processable_mqtt_event = $mqtt_event_class::fromArray($event->data);

            $processable_mqtt_event->persist();
        } catch (ValidationException|\Exception $exception) {
            report($exception);
        }
    }

    /**
     * @param MqttEvent $event_type
     * @return ProcessableMqttEvent|string
     */
    private function selectMqttEvent(MqttEvent $event_type): ProcessableMqttEvent|string
    {
        switch ($event_type) {
            case MqttEvent::MqttPacketProcessed: return MqttPacketProcessedEvent::class;

            default:
                report(new \Exception("Unhandled Pusher MQTT Event [$event_type->value]"));
        }
    }
}
