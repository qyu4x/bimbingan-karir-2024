<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPeriksaResource\Pages;
use App\Filament\Resources\JadwalPeriksaResource\RelationManagers;
use App\Helper\Role;
use App\Models\JadwalPeriksa;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalPeriksaResource extends Resource
{
    protected static ?string $model = JadwalPeriksa::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $pluralModelLabel = 'Jadwal Periksa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('hari')
                    ->label('Hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ])
                    ->required(),
                TimePicker::make('jadwal_mulai')
                    ->label('Jam Mulai')
                    ->required(),
                TimePicker::make('jadwal_selesai')
                    ->label('Jam Selesai')
                    ->required(),
                Checkbox::make('is_active')->required()->visibleOn(['edit', 'create']),
            ]);
    }

    public static function getDoctorId(): int
    {
        return auth()->user()->dokter->id;
    }

    public static function table(Table $table): Table
    {
        if (auth()->user()->role === Role::ADMIN) {
            return $table
                ->columns([
                    TextColumn::make('dokter.user.name')
                        ->searchable(),
                    TextColumn::make('hari'),
                    TextColumn::make('jadwal_mulai')
                        ->label('Jam Mulai'),
                    TextColumn::make('jadwal_selesai')
                        ->label('Jam Selesai'),
                    CheckboxColumn::make('is_active')->label('Status Jadwal')
                ])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\DeleteBulkAction::make(),
                ]);
        }
        return $table
            ->query(fn() => JadwalPeriksa::where('id_dokter', self::getDoctorId()))
            ->columns([
                TextColumn::make('dokter.user.name'),
                TextColumn::make('hari'),
                TextColumn::make('jadwal_mulai')
                    ->label('Jam Mulai'),
                TextColumn::make('jadwal_selesai')
                    ->label('Jam Selesai'),
                CheckboxColumn::make('is_active')->label('Status Jadwal')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListJadwalPeriksas::route('/'),
            'create' => Pages\CreateJadwalPeriksa::route('/create'),
            'edit' => Pages\EditJadwalPeriksa::route('/{record}/edit'),
        ];
    }
}
