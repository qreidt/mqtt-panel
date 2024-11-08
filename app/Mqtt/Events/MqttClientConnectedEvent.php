<?php

namespace App\Mqtt\Events;

use App\Mqtt\Enums\MqttEventType;
use App\Mqtt\Models\MqttEvent;
use App\Mqtt\Models\MqttProcessedPacket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Validator;

class MqttClientConnectedEvent implements ProcessableMqttEvent
{

    public function __construct(
        public string $client_id,
        public int $protocol_version,
        public string $username,
        public string $remote_address,
        public int $qos,
        public int $keep_alive,
        public int $timestamp,
    )
    {

    }

    public static function fromArray(array $data): static
    {
        $validated = Validator::validate($data, [
            'id' => ['required', 'string'],
            'protocol_version' => ['required', 'integer'],
            'username' => ['present', 'string'],
            'remote' => ['required', 'string'],
            'qos' => ['required', 'integer'],
            'keep_alive' => ['required', 'integer'],
            'timestamp' => ['required', 'integer'],
        ]);

        return new static(
            client_id: $validated['id'],
            protocol_version: $validated['protocol_version'],
            username: $validated['username'],
            remote_address: $validated['remote'],
            qos: $validated['qos'],
            keep_alive: $validated['keep_alive'],
            timestamp: $validated['timestamp'],
        );
    }

    public function persist(): void
    {
        MqttEvent::create([
            'client_id' => $this->client_id,
            'type' => MqttEventType::MqttClientConnected,
            'data' => (array) $this,
            'timestamp' => $this->timestamp,
        ]);
    }
}
