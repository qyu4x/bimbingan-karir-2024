<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarPoliResource\Pages;
use App\Filament\Resources\DaftarPoliResource\RelationManagers;
use App\Helper\Role;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class DaftarPoliResource extends Resource
{
    protected static ?string $model = DaftarPoli::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $pluralModelLabel = 'Daftar Poli';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_poli')
                    ->label('Poli')
                    ->live()
                    ->options(Poli::all()->pluck('nama', 'id')),
                Select::make('id_dokter')
                    ->label('Dokter')
                    ->live()
                    ->reactive()
                    ->options(function (Forms\Get $get) {
                        $idPoli = $get('id_poli');
                        return Dokter::query()
                            ->join('users', 'dokters.id_user', '=', 'users.id')
                            ->where('dokters.id_poli', $idPoli)
                            ->pluck('users.name', 'dokters.id');
                    }),
                Select::make('id_jadwal_periksa')
                    ->label('Jadwal Periksa')
                    ->reactive()
                    ->options(function (Forms\Get $get) {
                        $idDokter = $get('id_dokter');
                        return JadwalPeriksa::query()->where('id_dokter', $idDokter)
                            ->where('is_active', true)
                            ->get()
                            ->mapWithKeys(function ($schedule) {
                                $startTime = date('h:i A', strtotime($schedule->jadwal_mulai));
                                $endTime = date('h:i A', strtotime($schedule->jadwal_selesai));
                                return [$schedule->id => "{$schedule->hari} - Jam {$startTime} - {$endTime}"];
                            });
                    })
                    ->required(),
                Textarea::make('keluhan')
                    ->label('Keluhan')
                    ->placeholder('Masukkan keluhan anda')
                    ->required()
            ]);
    }

    public static function getPatientId(): int
    {
        return auth()->user()->pasien->id;
    }

    public static function table(Table $table): Table
    {
        if (auth()->user()->role === Role::PATIENT) {

        }
        return $table
            ->query(fn() => DaftarPoli::where('id_pasien', self::getPatientId()))
            ->columns([
                TextColumn::make('pasiens.user.name')
                    ->label('Pasien'),
                TextColumn::make('pasiens.no_rm')
                    ->label('No RM'),
                TextColumn::make('keluhan'),
                TextColumn::make('no_antrian')
                    ->label('Nomer Antrian'),
                TextColumn::make('jadwal_periksas.dokter.user.name')
                    ->label('Dokter'),
                TextColumn::make('jadwal_periksas.dokter.poli.nama')
                    ->label('Poli'),
                TextColumn::make('jadwal_periksas.hari')
                    ->label('Hari'),
                TextColumn::make('jadwal_periksas.jadwal_mulai')
                    ->label('Jam Mulai')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)->format('h:i A');
                    }),
                TextColumn::make('jadwal_periksas.jadwal_selesai')
                    ->label('Jam Selesai')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)->format('h:i A');
                    }),

            ])
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
            'index' => Pages\ListDaftarPolis::route('/'),
            'create' => Pages\CreateDaftarPoli::route('/create'),
            'edit' => Pages\EditDaftarPoli::route('/{record}/edit'),
        ];
    }
}
