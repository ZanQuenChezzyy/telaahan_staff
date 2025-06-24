<?php

namespace App\Filament\Widgets;

use App\Models\TelaahanStaff;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UnitStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $unitId = Auth::user()->unit_id;

        $totalTelaahan = TelaahanStaff::where('unit_id', $unitId)->count();
        $totalDisetujui = TelaahanStaff::where('unit_id', $unitId)->where('status', 1)->count();
        $totalDitolak = TelaahanStaff::where('unit_id', $unitId)->where('status', 0)->count();

        return [
            Stat::make('Total Telaahan', $totalTelaahan)
                ->description('Jumlah seluruh telaahan dari unit ini')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Disetujui', $totalDisetujui)
                ->description('Telaahan yang disetujui')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Ditolak', $totalDitolak)
                ->description('Telaahan yang ditolak')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }

    public static function canView(): bool
    {
        return Auth::user()->hasRole('User');
    }
}
