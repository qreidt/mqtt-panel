<?php

namespace App\Filament\Resources\Mqtt\ApiTokenResource\Pages;

use App\Filament\Resources\Mqtt\ApiTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApiTokens extends ListRecords
{
    protected static string $resource = ApiTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
