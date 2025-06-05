<?php

namespace App\Filament\Widgets;

use App\Models\TelaahanStaff;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TelaahanStaffTerbaru extends BaseWidget
{
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(TelaahanStaff::orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('nomor')
                    ->label('Nomor')
                    ->description(
                        fn(TelaahanStaff $record): string =>
                        Carbon::parse($record->tanggal)->translatedFormat('l, d F Y')
                    ),

                TextColumn::make('jenisPermintaan.nama')
                    ->label('Jenis Permintaan'),
            ])->defaultPaginationPageOption(5)->paginated([5]);
    }

    public static function canView(): bool
    {
        // Periksa apakah pengguna memiliki role 'Admin'
        return Auth::user()->hasRole('Admin');
    }
}
