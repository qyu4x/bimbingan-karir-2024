<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliResource\Pages;
use App\Filament\Resources\PoliResource\RelationManagers;
use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliResource extends Resource
{
    protected static ?string $model = Poli::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $pluralModelLabel = 'Poli';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('keterangan')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('keterangan'),
                TextColumn::make('created_at')
                    ->label('Created On')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPolis::route('/'),
            'create' => Pages\CreatePoli::route('/create'),
            'edit' => Pages\EditPoli::route('/{record}/edit'),
        ];
    }
}
