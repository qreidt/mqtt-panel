<?php

namespace App\Mqtt\Listeners;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Events\MqttClientConnectedEvent;
use App\Mqtt\Events\MqttClientDisconnectedEvent;
use App\Mqtt\Events\MqttClientPublishedEvent;
use App\Mqtt\Events\MqttClientSubscribedEvent;
use App\Mqtt\Events\MqttClientUnsubscribedEvent;
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
            Log::error($exception->getMessage());
            report($exception);
        }
    }

    /**
     * @param MqttEventType $event_type
     * @return ProcessableMqttEvent|string
     */
    private function selectMqttEvent(MqttEventType $event_type): ProcessableMqttEvent|string
    {
        switch ($event_type) {
            case MqttEventType::MqttPacketProcessed:    return MqttPacketProcessedEvent::class;
            case MqttEventType::MqttClientConnected:    return MqttClientConnectedEvent::class;
            case MqttEventType::MqttClientDisconnected: return MqttClientDisconnectedEvent::class;
            case MqttEventType::MqttClientSubscribed:   return MqttClientSubscribedEvent::class;
            case MqttEventType::MqttClientUnsubscribed: return MqttClientUnsubscribedEvent::class;
            case MqttEventType::MqttClientPublished:    return MqttClientPublishedEvent::class;

            default:
                report(new \Exception("Unhandled Pusher MQTT Event [$event_type->value]"));
        }
    }
}
