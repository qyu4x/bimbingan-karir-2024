<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriksaResource\Pages;
use App\Filament\Resources\PeriksaResource\RelationManagers;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PeriksaResource extends Resource
{
    protected static ?string $model = Periksa::class;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';

    protected static ?string $pluralModelLabel = 'Periksa';

    public static function getDoctorId(): int
    {
        return auth()->user()->dokter->id;
    }

    public static function form(Form $form): Form
    {
        $doctorId = self::getDoctorId();

        $daftarPoli = DaftarPoli::whereHas('jadwal_periksas', function ($query) use ($doctorId) {
            $query->where('id_dokter', $doctorId);
        })->with('pasiens.user')->get();

        $options = $daftarPoli->mapWithKeys(function ($item) {
            return [$item->id => $item->pasiens->user->name];
        });

        return $form
            ->schema([
                Select::make('id_daftar_poli')
                    ->label('Pasien')
                    ->searchable()
                    ->options($options)
                    ->visibleOn(['create'])
                    ->required(),
                DatePicker::make('tanggal_periksa')
                    ->label('Tanggal Periksa')
                    ->required(),
//                Select::make('obats')
//                    ->label('Obat')
//                    ->relationship('obats', 'nama')
//                    ->multiple()
//                    ->searchable()
//                    ->required(),
                Select::make('obats')
                    ->label('Obat')
                    ->options(function (Get $get) {
                        return Obat::all()
                            ->mapWithKeys(function ($obat) {
                                return [$obat->id => "{$obat->nama} - {$obat->kemasan}"];
                            })
                            ->toArray();
                    })
                    ->multiple()
                    ->required(),
                Textarea::make('catatan')
                    ->label('Catatan')
                    ->placeholder('Masukkan catatan anda untuk pasien')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        $doctorId = self::getDoctorId();

        return $table
            ->query(fn() => Periksa::whereHas('daftar_polis.jadwal_periksas', function ($query) use ($doctorId) {
                $query->where('id_dokter', $doctorId);
            }))
            ->columns([
                TextColumn::make('daftar_polis.pasiens.user.name')
                    ->label('Pasien')
                    ->searchable(),
                TextColumn::make('daftar_polis.pasiens.no_rm')
                    ->label('No RM'),
                CheckboxColumn::make('daftar_polis.status_periksa')
                    ->label('Status Periksa'),
                TextColumn::make('daftar_polis.keluhan')
                    ->label('Keluhan'),
                TextColumn::make('obats.nama')
                    ->label('Obat'),
//                    ->valueUsing(function (Periksa $periksa) {
//                        return $periksa->obats->pluck('nama')->implode(', ');
//                    }),
                TextColumn::make('catatan')
                    ->label('Catatan'),
                TextColumn::make('biaya_periksa')
                    ->label('Biaya Periksa'),
                TextColumn::make('tanggal_periksa')
                    ->label('Tanggal Periksa')
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
            'index' => Pages\ListPeriksas::route('/'),
            'create' => Pages\CreatePeriksa::route('/create'),
            'edit' => Pages\EditPeriksa::route('/{record}/edit'),
        ];
    }
}
