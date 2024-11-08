<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Models\MqttEvent;
use App\Mqtt\Models\MqttProcessedPacket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Validator;

class MqttClientPublishedEvent implements ProcessableMqttEvent
{

    public function __construct(
        public string $client_id,
        public string $topic_name,
        public string $payload,
        public int $qos,
        public bool $retain,
        public bool $is_json,
        public int $timestamp,
    )
    {

    }

    public static function fromArray(array $data): static
    {
        $validated = Validator::validate($data, [
            'id' => ['required', 'string'],
            'topic_name' => ['required', 'string'],
            'payload' => ['present', 'string'],
            'qos' => ['required', 'integer'],
            'retain' => ['required', 'bool'],
            'timestamp' => ['required', 'integer'],
        ]);

        return new static(
            client_id: $validated['id'],
            topic_name: $validated['topic_name'],
            payload: $validated['payload'],
            qos: $validated['qos'],
            retain: $validated['retain'],
            is_json: json_validate($validated['payload']),
            timestamp: $validated['timestamp'],
        );
    }

    public function persist(): void
    {
        MqttEvent::create([
            'client_id' => $this->client_id,
            'type' => MqttEventType::MqttClientPublished,
            'data' => (array) $this,
            'timestamp' => $this->timestamp,
        ]);
    }
}
