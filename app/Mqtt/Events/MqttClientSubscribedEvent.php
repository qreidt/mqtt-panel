<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Models\MqttEvent;
use App\Mqtt\Models\MqttProcessedPacket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Validator;

class MqttClientSubscribedEvent implements ProcessableMqttEvent
{

    public function __construct(
        public string $client_id,
        public string $topic_name,
        public int $qos,
        public int $timestamp,
    )
    {

    }

    public static function fromArray(array $data): static
    {
        $validated = Validator::validate($data, [
            'id' => ['required', 'string'],
            'topic_name' => ['required', 'string'],
            'qos' => ['required', 'integer'],
            'timestamp' => ['required', 'integer'],
        ]);

        return new static(
            client_id: $validated['id'],
            topic_name: $validated['topic_name'],
            qos: $validated['qos'],
            timestamp: $validated['timestamp'],
        );
    }

    public function persist(): void
    {
        MqttEvent::create([
            'client_id' => $this->client_id,
            'type' => MqttEventType::MqttClientSubscribed,
            'data' => (array) $this,
            'timestamp' => $this->timestamp,
        ]);
    }
}
