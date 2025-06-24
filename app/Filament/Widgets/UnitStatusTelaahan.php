<?php

namespace App\Filament\Widgets;

use App\Models\TelaahanStaff;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class UnitStatusTelaahan extends ChartWidget
{
    protected static ?string $heading = 'Status Telaahan';
    protected static ?string $maxHeight = '300px';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $unitId = Auth::user()->unit_id;

        $disetujui = TelaahanStaff::where('unit_id', $unitId)->where('status', 1)->count();
        $ditolak = TelaahanStaff::where('unit_id', $unitId)->where('status', 0)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Status',
                    'data' => [$disetujui, $ditolak],
                    'backgroundColor' => ['#22c55e', '#ef4444'],
                ],
            ],
            'labels' => ['Disetujui', 'Ditolak'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public static function canView(): bool
    {
        return Auth::user()->hasRole('User');
    }
}
