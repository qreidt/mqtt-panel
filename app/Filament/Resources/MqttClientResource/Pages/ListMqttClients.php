<?php

namespace App\Filament\Resources\MqttClientResource\Pages;

use App\Filament\Resources\MqttClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMqttClients extends ListRecords
{
    protected static string $resource = MqttClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
