<?php

namespace App\Filament\Resources\Mqtt;

use App\Filament\Resources\Mqtt;
use App\Filament\Resources\MqttClientResource\Pages;
use App\Mqtt\Models\MqttClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MqttClientResource extends Resource
{
    protected static ?string $model = MqttClient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),

                Forms\Components\TextInput::make('mqtt_id')
                    ->label('MQTT Client ID')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('mqtt_id')
                    ->label('MQTT Client ID'),
            ])
            ->recordUrl(fn($record) => Mqtt\MqttClientResource\Pages\ShowMqttClient::getUrl(compact('record')))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Mqtt\MqttClientResource\Pages\ListMqttClients::route('/'),
            'show' => Mqtt\MqttClientResource\Pages\ShowMqttClient::route('/{record}'),
        ];
    }
}
