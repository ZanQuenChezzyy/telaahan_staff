<?php

namespace App\Filament\Widgets;

use App\Models\TelaahanStaff;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class UnitTelaahanPerBulan extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Telaahan per Bulan';
    protected static ?string $maxHeight = '300px';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $unitId = Auth::user()->unit_id;

        $monthlyCounts = TelaahanStaff::where('unit_id', $unitId)
            ->whereYear('tanggal', now()->year)
            ->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyCounts[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Telaahan',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.4)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public static function canView(): bool
    {
        return Auth::user()->hasRole('User');
    }
}
