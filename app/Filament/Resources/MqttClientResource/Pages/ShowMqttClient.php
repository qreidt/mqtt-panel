<?php

namespace App\Filament\Resources\MqttClientResource\Pages;

use App\Filament\Resources\MqttClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

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
