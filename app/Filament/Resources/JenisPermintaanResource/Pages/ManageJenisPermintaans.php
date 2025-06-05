<?php

namespace App\Filament\Resources\JenisPermintaanResource\Pages;

use App\Filament\Resources\JenisPermintaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisPermintaans extends ManageRecords
{
    protected static string $resource = JenisPermintaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jenis Permintaan'),
        ];
    }
}
