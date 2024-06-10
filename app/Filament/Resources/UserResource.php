<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Helper\Role;
use App\Models\Poli;
use App\Models\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $pluralModelLabel = 'Doctor';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('role')->options([
                    Role::DOCTOR => 'Doctor',
                ])->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('password')->password()->required(),

                // doctor field
                Forms\Components\Select::make('id_poli')
                    ->label('Poli')
                    ->options(Poli::all()->pluck('nama', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('no_hp')->required(),
                Forms\Components\TextInput::make('alamat')->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        $currentUser = auth()->user();

        if ($currentUser->role === Role::DOCTOR) {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('name'),
                    Tables\Columns\TextColumn::make('email'),
                    Tables\Columns\TextColumn::make('role'),
                    Tables\Columns\TextColumn::make('dokter.alamat')
                        ->label('Address'),
                    Tables\Columns\TextColumn::make('dokter.no_hp')
                        ->label('Phone Number'),
                    Tables\Columns\TextColumn::make('dokter.poli.nama'),
                ])
                ->filters([
                    Tables\Filters\QueryBuilder::make()
                        ->query(function ($query) use ($currentUser) {
                            return $query->where('role', '=', Role::DOCTOR)
                                ->where('id', '=', $currentUser->id);
                        })
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
        } else {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('name'),
                    Tables\Columns\TextColumn::make('email'),
                    Tables\Columns\TextColumn::make('role'),
                    Tables\Columns\TextColumn::make('dokter.alamat')
                        ->label('Address'),
                    Tables\Columns\TextColumn::make('dokter.no_hp')
                        ->label('Phone Number'),
                    Tables\Columns\TextColumn::make('dokter.poli.nama'),
                ])
                ->filters([
                    Tables\Filters\QueryBuilder::make()
                        ->query(function ($query) {
                            return $query->where('role', '=', Role::DOCTOR);
                        })
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
