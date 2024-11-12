<?php

namespace App\Filament\Resources\Mqtt\MqttClientResource\Pages;

use App\Filament\Resources\Mqtt\MqttClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ShowMqttClient extends ViewRecord
{
    protected static string $resource = MqttClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
