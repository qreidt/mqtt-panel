<?php

namespace App\Filament\Resources\MqttClientResource\Pages;

use App\Filament\Resources\MqttClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMqttClient extends EditRecord
{
    protected static string $resource = MqttClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
