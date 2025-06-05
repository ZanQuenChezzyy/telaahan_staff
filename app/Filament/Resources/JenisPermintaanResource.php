<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPermintaanResource\Pages;
use App\Filament\Resources\JenisPermintaanResource\RelationManagers;
use App\Models\JenisPermintaan;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisPermintaanResource extends Resource
{
    protected static ?string $model = JenisPermintaan::class;
    protected static ?string $label = 'Jenis Permintaan';
    protected static ?string $navigationGroup = 'Kelola Data';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() < 3 ? 'warning' : 'primary';
    }
    protected static ?string $navigationBadgeTooltip = 'Total Jenis Permintaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Jenis Permintaan')
                    ->placeholder('Masukkan Jenis Permintaan')
                    ->maxLength(45)
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Jenis Permintaan')
                    ->placeholder('Masukkan Deskripsi')
                    ->rows(1)
                    ->autosize()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Jenis Permintaan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJenisPermintaans::route('/'),
        ];
    }
}
