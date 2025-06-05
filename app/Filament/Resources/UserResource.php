<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $label = 'Daftar Pengguna';
    protected static ?string $navigationGroup = 'Kelola Pengguna';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() < 10 ? 'warning' : 'primary';
    }
    protected static ?string $navigationBadgeTooltip = 'Total Pengguna';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Pengguna')
                    ->placeholder('Masukkan Nama Pengguna')
                    ->maxLength(45)
                    ->required(),

                TextInput::make('email')
                    ->label('Email Pengguna')
                    ->placeholder('Masukkan Email Pengguna')
                    ->maxLength(45)
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->placeholder('Masukkan Password Pengguna')
                    ->password()
                    ->required()
                    ->maxLength(45),

                Select::make('unit_id')
                    ->label('Unit Pengguna')
                    ->placeholder('Pilih Unit Pengguna')
                    ->relationship('unit', 'nama')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->searchable(),

                Tables\Columns\TextColumn::make('unit.nama')
                    ->label('Nama Unit')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
