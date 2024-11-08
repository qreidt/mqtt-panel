<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Models\MqttEvent;
use App\Mqtt\Models\MqttProcessedPacket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Validator;

class MqttClientDisconnectedEvent implements ProcessableMqttEvent
{

    public function __construct(
        public string $client_id,
        public int $timestamp,
    )
    {

    }

    public static function fromArray(array $data): static
    {
        $validated = Validator::validate($data, [
            'id' => ['required', 'string'],
            'timestamp' => ['required', 'integer'],
        ]);

        return new static(
            client_id: $validated['id'],
            timestamp: $validated['timestamp'],
        );
    }

    public function persist(): void
    {
        MqttEvent::create([
            'client_id' => $this->client_id,
            'type' => MqttEventType::MqttClientDisconnected,
            'data' => [],
            'timestamp' => $this->timestamp,
        ]);
    }
}
