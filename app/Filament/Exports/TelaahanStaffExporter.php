<?php

namespace App\Filament\Exports;

use App\Models\TelaahanStaff;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class TelaahanStaffExporter extends Exporter
{
    protected static ?string $model = TelaahanStaff::class;

    protected static int $rowNumber = 0;

    public static function getColumns(): array
    {
        self::$rowNumber = 0;

        return [
            ExportColumn::make('nomor')
                ->label('No')
                ->formatStateUsing(function () {
                    return ++self::$rowNumber;
                }),

            ExportColumn::make('jenisPermintaan.nama')->label('Jenis Permintaan'),
            ExportColumn::make('unit.nama')->label('Unit'),
            ExportColumn::make('kepada')->label('Kepada'),
            ExportColumn::make('dari')->label('Dari'),
            ExportColumn::make('tanggal')
                ->label('Tanggal')
                ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)->format('d/m/Y')),
            ExportColumn::make('nomor')->label('Nomor'),
            ExportColumn::make('perihal')->label('Perihal'),
            ExportColumn::make('persoalan')->label('Persoalan'),
            ExportColumn::make('peranggapan')->label('Peranggapan'),
            ExportColumn::make('fakta')->label('Fakta'),
            ExportColumn::make('analisa')->label('Analisa'),
            ExportColumn::make('kesimpulan')->label('Kesimpulan'),
            ExportColumn::make('saran')->label('Saran'),
            ExportColumn::make('wadir')->label('Wadir'),
            ExportColumn::make('nama_wadir')->label('Nama Wadir'),
            ExportColumn::make('nip_wadir')->label('NIP Wadir'),
            ExportColumn::make('nama_kabid')->label('Nama Kabid'),
            ExportColumn::make('nip_kabid')->label('NIP Kabid'),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn($state) => $state === 1 ? 'Disetujui' : 'Ditolak'),
            ExportColumn::make('total_satuan_harga')
                ->label('Total Anggaran')
                ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ExportColumn::make('created_at')->label('Dibuat Pada'),
            ExportColumn::make('updated_at')->label('Diperbarui Pada'),
        ];
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setFontSize(13)
            ->setFontName('Times New Roman')
            ->setFontColor(Color::WHITE)
            ->setBackgroundColor(Color::rgb(46, 125, 50)) // Hijau tua
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER);
    }

    public function getXlsxCellStyle(): ?Style
    {
        return (new Style())
            ->setFontSize(11)
            ->setFontName('Times New Roman')
            ->setFontColor(Color::BLACK)
            ->setBackgroundColor(Color::rgb(255, 255, 255)) // Putih
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER)
            ->setCellAlignment(CellAlignment::LEFT);
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export selesai: ' . number_format($export->successful_rows) . ' baris berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' baris gagal diekspor.';
        }

        return $body;
    }
}
