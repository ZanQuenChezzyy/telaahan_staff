<?php

namespace App\Filament\Resources\TelaahanStaffResource\Pages;

use App\Filament\Resources\TelaahanStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTelaahanStaff extends ManageRecords
{
    protected static string $resource = TelaahanStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Telaahan Staff'),
        ];
    }
}
