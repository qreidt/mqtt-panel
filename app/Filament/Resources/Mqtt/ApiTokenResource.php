<?php

namespace App\Filament\Resources\Mqtt;

use App\Filament\Resources\Mqtt;
use App\Models\ApiToken;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ApiTokenResource extends Resource
{
    protected static ?string $model = ApiToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->columnSpan(2)
                    ->autocomplete(false),

                TextInput::make('key')
                    ->label('API KEY')
                    ->default(Str::random(24))
                    ->autocomplete(false),

                TextInput::make('secret')
                    ->label('API SECRET')
                    ->default(Str::random(32))
                    ->autocomplete(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('key')
                    ->label('API KEY'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Mqtt\ApiTokenResource\Pages\ListApiTokens::route('/'),
        ];
    }
}
