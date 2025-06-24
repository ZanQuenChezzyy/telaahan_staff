<?php

namespace App\Filament\Resources\TelaahanStaffResource\Pages;

use App\Filament\Exports\TelaahanStaffExporter;
use App\Filament\Resources\TelaahanStaffResource;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ManageRecords;

class ManageTelaahanStaff extends ManageRecords
{
    protected static string $resource = TelaahanStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(TelaahanStaffExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                ]),
            Actions\CreateAction::make()
                ->label('Tambah Telaahan Staff'),
        ];
    }
}
