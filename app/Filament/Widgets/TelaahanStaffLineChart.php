<?php

namespace App\Filament\Widgets;

use App\Models\TelaahanStaff;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class TelaahanStaffLineChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Statistik Data Telahaan Staff';
    protected function getData(): array
    {
        // Menentukan tanggal 6 bulan yang lalu
        $MonthAgo = Carbon::now()->subMonths(6);

        // Query untuk mendapatkan data tren per bulan (terakhir 6 bulan)
        $data = TelaahanStaff::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, count(*) as total')
            ->where('created_at', '>=', $MonthAgo)  // Filter berdasarkan tanggal
            ->groupBy('year', 'month')  // Mengelompokkan berdasarkan tahun dan bulan
            ->get()
            ->toArray();

        // Mengonversi data untuk ChartJS
        $labels = array_map(function ($item) {
            // Menggunakan Carbon untuk memformat bulan dan tahun
            return Carbon::createFromFormat('Y-m', $item['year'] . '-' . $item['month'])->translatedFormat('M Y');
        }, $data);

        $values = array_column($data, 'total');

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Telaahan Staff',
                    'data' => $values,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public static function canView(): bool
    {
        // Periksa apakah pengguna memiliki role 'Admin'
        return Auth::user()->hasRole('Admin');
    }
}
