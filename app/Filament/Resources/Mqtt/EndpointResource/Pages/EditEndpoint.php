<?php

namespace App\Filament\Resources\Mqtt\EndpointResource\Pages;

use App\Filament\Resources\Mqtt\EndpointResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEndpoint extends EditRecord
{
    protected static string $resource = EndpointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
