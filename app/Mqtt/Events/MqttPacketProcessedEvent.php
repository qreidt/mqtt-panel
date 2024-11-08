<?php

namespace App\Mqtt\Events;

use App\Mqtt\Models\MqttProcessedPacket;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Validator;

class MqttPacketProcessedEvent implements ProcessableMqttEvent
{
    use Dispatchable;

    public function __construct(
        public string $client_id,
        public int $packet_id,
        public int $packet_type,
        public int $packet_length,
        public int $timestamp,
    )
    {

    }

    public static function fromArray(array $data): static
    {
        $validated = Validator::validate($data, [
            'id' => ['required', 'string'],
            'packet_id' => ['required', 'integer'],
            'packet_type' => ['required', 'integer', 'min:1', 'max:14'],
            'packet_length' => ['required', 'integer'],
            'timestamp' => ['required', 'integer'],
        ]);

        return new static(
            client_id: $validated['id'],
            packet_id: $validated['packet_id'],
            packet_type: $validated['packet_type'],
            packet_length: $validated['packet_length'],
            timestamp: $validated['timestamp'],
        );
    }

    public function persist(): void
    {
        MqttProcessedPacket::create([
            'client_id' => $this->client_id,
            'packet_id' => $this->packet_id,
            'packet_type' => $this->packet_type,
            'packet_length' => $this->packet_length,
            'timestamp' => $this->timestamp,
        ]);
    }
}
