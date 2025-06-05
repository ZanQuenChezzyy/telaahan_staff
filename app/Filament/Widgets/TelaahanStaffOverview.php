<?php

namespace App\Filament\Widgets;

use App\Models\JenisPermintaan;
use App\Models\TelaahanStaff;
use App\Models\Unit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class TelaahanStaffOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        // Data saat ini
        $totalTelaahanStaff = TelaahanStaff::count();
        $jumlahStatusDiterima = TelaahanStaff::where('status', '1')->count();
        $jumlahStatusDitolak = TelaahanStaff::where('status', '2')->count();
        $totalHargaDiterima = TelaahanStaff::where('status', '1')->sum('total_satuan_harga');

        // Data sebelumnya (misalnya, bulan lalu)
        $bulanLalu = now()->subMonth();
        $totalTelaahanStaffSebelumnya = TelaahanStaff::whereMonth('created_at', $bulanLalu->month)->count();
        $jumlahStatusDiterimaSebelumnya = TelaahanStaff::where('status', '1')
            ->whereMonth('created_at', $bulanLalu->month)
            ->count();
        $jumlahStatusDitolakSebelumnya = TelaahanStaff::where('status', '2')
            ->whereMonth('created_at', $bulanLalu->month)
            ->count();
        $totalHargaDiterimaSebelumnya = TelaahanStaff::where('status', '1')
            ->whereMonth('created_at', $bulanLalu->month)
            ->sum('total_satuan_harga');

        return [
            // Total TelaahanStaff
            Stat::make('Total Data Telaahan Staff', $totalTelaahanStaff)
                ->description(
                    $this->generateDescription($totalTelaahanStaff, $totalTelaahanStaffSebelumnya)
                )
                ->descriptionIcon(
                    $this->generateDescriptionIcon($totalTelaahanStaff, $totalTelaahanStaffSebelumnya)
                )
                ->color($this->generateColor($totalTelaahanStaff, $totalTelaahanStaffSebelumnya))
                ->extraAttributes([
                    'style' => $totalTelaahanStaff >= 10_000_000 ? 'font-size: 0.9rem;' : 'font-size: 1rem;',
                ])
                ->chart([$totalTelaahanStaff, $totalTelaahanStaffSebelumnya]),

            // Jumlah Telaahan Staff Diterima
            Stat::make('Jumlah Telaahan Staff Diterima', $jumlahStatusDiterima)
                ->description(
                    $this->generateDescription($jumlahStatusDiterima, $jumlahStatusDiterimaSebelumnya)
                )
                ->descriptionIcon(
                    $this->generateDescriptionIcon($jumlahStatusDiterima, $jumlahStatusDiterimaSebelumnya)
                )
                ->color($this->generateColor($jumlahStatusDiterima, $jumlahStatusDiterimaSebelumnya))
                ->extraAttributes([
                    'style' => $jumlahStatusDiterima >= 10_000_000 ? 'font-size: 0.9rem;' : 'font-size: 1rem;',
                ])
                ->chart([$jumlahStatusDiterima, $jumlahStatusDiterimaSebelumnya]),

            // Jumlah Telaahan Staff Ditolak
            Stat::make('Jumlah Telaahan Staff Ditolak', $jumlahStatusDitolak)
                ->description(
                    $this->generateDescription($jumlahStatusDitolak, $jumlahStatusDitolakSebelumnya)
                )
                ->descriptionIcon(
                    $this->generateDescriptionIcon($jumlahStatusDitolak, $jumlahStatusDitolakSebelumnya)
                )
                ->color($this->generateColor($jumlahStatusDitolak, $jumlahStatusDitolakSebelumnya))
                ->extraAttributes([
                    'style' => $jumlahStatusDitolak >= 10_000_000 ? 'font-size: 0.9rem;' : 'font-size: 1rem;',
                ])
                ->chart([$jumlahStatusDitolak, $jumlahStatusDitolakSebelumnya]),

            // Total Harga Diterima
            Stat::make('Total Harga Diterima', 'Rp ' . $this->formatNumberShort($totalHargaDiterima))
                ->description(
                    $this->generateDescription($totalHargaDiterima, $totalHargaDiterimaSebelumnya)
                )
                ->descriptionIcon(
                    $this->generateDescriptionIcon($totalHargaDiterima, $totalHargaDiterimaSebelumnya)
                )
                ->color($this->generateColor($totalHargaDiterima, $totalHargaDiterimaSebelumnya))
                ->extraAttributes([
                    'style' => $totalHargaDiterima >= 10_000_000 ? 'font-size: 0.9rem;' : 'font-size: 1rem;',
                ])
                ->chart([$totalHargaDiterima, $totalHargaDiterimaSebelumnya]),
        ];
    }
    /**
     * Format angka menjadi bentuk singkat (dengan akhiran K, M, B).
     */
    private function formatNumberShort($number): string
    {
        if ($number >= 1_000_000_000) {
            return round($number / 1_000_000_000, 1) . ' M'; // Miliar
        } elseif ($number >= 1_000_000) {
            return round($number / 1_000_000, 1) . ' JT'; // Jutaan
        } elseif ($number >= 1_000) {
            return round($number / 1_000, 1) . ' RB'; // Ribuan
        }

        return (string) $number;
    }

    /**
     * Generate the description text based on the comparison.
     */
    private function generateDescription($current, $previous): string
    {
        $difference = $current - $previous;
        $percentageChange = $previous > 0 ? round(($difference / $previous) * 100, 1) : 100;

        if ($difference > 0) {
            return "{$percentageChange}% Meningkat dari bulan lalu";
        } elseif ($difference < 0) {
            return abs($percentageChange) . "% Menurun dari bulan lalu";
        }

        return "Tidak Ada Peningkatan";
    }

    /**
     * Generate the description icon based on the comparison.
     */
    private function generateDescriptionIcon($current, $previous): string
    {
        return $current > $previous ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
    }

    /**
     * Generate the color based on the comparison.
     */
    private function generateColor($current, $previous): string
    {
        return $current > $previous ? 'success' : ($current < $previous ? 'danger' : 'gray');
    }

    public static function canView(): bool
    {
        // Periksa apakah pengguna memiliki role 'Admin'
        return Auth::user()->hasRole('Admin');
    }
}
