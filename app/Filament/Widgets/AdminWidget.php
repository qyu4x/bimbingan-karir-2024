<?php

namespace App\Filament\Widgets;


use App\Helper\Role;
use App\Models\Poli;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Doctor', User::query()->where('role', Role::DOCTOR)->count())
                ->description('Number of Doctors')
                ->descriptionIcon('heroicon-o-user', IconPosition::Before)
                ->color('success'),

            Stat::make('Patient', User::query()->where('role', Role::PATIENT)->count())
                ->description('Number of Patient')
                ->descriptionIcon('heroicon-o-face-smile', IconPosition::Before)
                ->color('warning'),

            Stat::make('Polyclinic ', Poli::query()->count())
                ->description('Number of Polyclinic')
                ->descriptionIcon('heroicon-o-heart', IconPosition::Before)
                ->color('danger'),
        ];
    }
}
