<?php

namespace App\Mqtt\Events;

interface ProcessableMqttEvent
{
    public static function fromArray(array $data): static;
    public function persist(): void;
}
