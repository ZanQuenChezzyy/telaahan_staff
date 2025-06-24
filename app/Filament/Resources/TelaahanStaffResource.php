<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TelaahanStaffExporter;
use App\Filament\Resources\TelaahanStaffResource\Pages;
use App\Filament\Resources\TelaahanStaffResource\RelationManagers;
use App\Models\TelaahanStaff;
use App\Models\Unit;
use Carbon\Carbon;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Support\Enums\IconPosition;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class TelaahanStaffResource extends Resource
{
    protected static ?string $model = TelaahanStaff::class;
    protected static ?string $label = 'Telaahan Staff';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    public static function getNavigationBadge(): ?string
    {
        // Cek apakah pengguna adalah admin (unit_id === 1)
        if (Auth::user()->unit_id === 1) {
            return static::getModel()::count();
        }

        // Jika bukan admin, tidak menampilkan badge
        return null;
    }
    public static function getNavigationBadgeColor(): ?string
    {
        // Cek apakah pengguna adalah admin (unit_id === 1)
        if (Auth::user()->unit_id === 1) {
            return static::getModel()::count() < 10 ? 'warning' : 'primary';
        }

        // Jika bukan admin, tidak menampilkan badge warna
        return null;
    }
    protected static ?string $navigationBadgeTooltip = 'Total Telaahan Staff';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Tujuan')
                        ->label('Tujuan')
                        ->description('Tujuan Telaahan Satff')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('nomor')
                                        ->label('Nomor Dokumen Telaahan Staff')
                                        ->placeholder('Contoh: XXX.X/XXX/X/TAHUN')
                                        ->helperText(new HtmlString('Isi nomor dokumen sesuai <strong>format</strong> yang berlaku.'))
                                        ->minLength(3)
                                        ->maxLength(30)
                                        ->required(),

                                    TextInput::make('kepada')
                                        ->label('Pihak Tujuan')
                                        ->placeholder('Contoh: Direktur RSUD Taman Husada Bontang')
                                        ->helperText(new HtmlString('Isi dengan nama <strong>jabatan atau pihak</strong> tujuan dokumen ini.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('perihal')
                                        ->label('Perihal')
                                        ->placeholder('Contoh: Permohonan Permintaan Barang')
                                        ->helperText(new HtmlString('Isi dengan <strong>ringkaskan dokumen</strong> dalam satu kalimat.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('dari')
                                        ->label('Kepala Bidang dan Unit Pengusul')
                                        ->placeholder('Contoh: Kabid Pelayanan Penunjang')
                                        ->helperText(new HtmlString('Isi dengan <strong>jabatan kepala bidang</strong> beserta <strong>unit terkait</strong>.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('nama_kabid')
                                        ->label('Nama Kepala Bidang (Kabid)')
                                        ->placeholder('Contoh: Sri Warsuni Almas, S.Tr, Rad., M.Kes')
                                        ->helperText(new HtmlString('Isi <strong>nama lengkap</strong> beserta <strong>gelar</strong> kepala bidang dari unit terkait.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('nip_kabid')
                                        ->label('NIP Kepala Bidang (Kabid)')
                                        ->placeholder('Contoh: 19XXXXXXXXX')
                                        ->helperText(new HtmlString('Isi <strong>Nomor Induk Pegawai (NIP)</strong> kepala bidang.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->minValue(1)
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('nama_wadir')
                                        ->label('Nama Wakil Direktur (Wadir)')
                                        ->placeholder('Contoh: Dr. Vincent')
                                        ->helperText(new HtmlString('Isi <strong>nama lengkap</strong> beserta <strong>gelar</strong> wakil direktur yang <strong>mengetahui</strong> dokumen ini.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('nip_wadir')
                                        ->label('NIP Wakil Direktur (Wadir)')
                                        ->placeholder('Contoh: 19XXXXXXXXX')
                                        ->helperText(new HtmlString('Isi <strong>Nomor Induk Pegawai (NIP)</strong> Wakil Direktur.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    TextInput::make('wadir')
                                        ->label('Bagian Wakil Direktur (Wadir)')
                                        ->placeholder('Contoh: Wadir Pelayanan Kesehatan')
                                        ->helperText(new HtmlString('Isi sesuai <strong>bagian</strong> Wakil Direktur.'))
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    DatePicker::make('tanggal')
                                        ->label('Tanggal Dokumen')
                                        ->placeholder('Pilih Tanggal Dokumen')
                                        ->helperText(new HtmlString('Pilih <strong>Tanggal</strong> Pembuatan Dokumen Ini.'))
                                        ->native(false)
                                        ->required(),

                                    Select::make('status')
                                        ->label('Status Telaahan Staff')
                                        ->placeholder('Pilih Status')
                                        ->options([
                                            0 => 'Menunggu',
                                            1 => 'Diterima',
                                            2 => 'Ditolak'
                                        ])
                                        ->preload()
                                        ->searchable()
                                        ->native(false)
                                        ->required()
                                        ->default(function (callable $get) {
                                            // Jika unit_id user adalah 1, set status default ke 'Menunggu' (0)
                                            return Auth::user()->unit_id == 1 ? 0 : 0;
                                        })
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn() => Auth::user()->unit_id !== 1), // Menonaktifkan status jika unit_id bukan 1

                                    Select::make('unit_id')
                                        ->label('Unit')
                                        ->placeholder('Pilih Unit')
                                        ->relationship('unit', 'nama') // Relasi dengan tabel unit
                                        ->preload()
                                        ->searchable()
                                        ->native(false)
                                        ->dehydratedWhenHidden()
                                        ->default(function (callable $get) {
                                            // Set default unit_id sesuai dengan unit yang dimiliki user
                                            return Auth::user()->unit_id;
                                        })
                                        ->required()
                                        ->hidden(function () {
                                            // Menyembunyikan field jika unit_id user selain 1
                                            return Auth::user()->unit_id !== 1;
                                        })
                                ])
                        ]),
                    Step::make('Isi')
                        ->label('Isi')
                        ->description('Isi Telaahan Staff')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Textarea::make('persoalan')
                                        ->label('Persoalan')
                                        ->placeholder('Masukkan Persoalan Telaahan Staff')
                                        ->minLength(20)
                                        ->rows(2)
                                        ->autoSize()
                                        ->required(),

                                    Textarea::make('peranggapan')
                                        ->label('Peranggapan')
                                        ->placeholder('Masukkan Peranggapan Telaahan Staff')
                                        ->minLength(20)
                                        ->rows(2)
                                        ->autoSize()
                                        ->required(),

                                    Textarea::make('fakta')
                                        ->label('Fakta Yang Mempengaruhi')
                                        ->placeholder('Masukkan Fakta Telaahan Staff')
                                        ->minLength(20)
                                        ->rows(2)
                                        ->autoSize()
                                        ->required(),

                                    Textarea::make('analisa')
                                        ->label('Analisa')
                                        ->placeholder('Masukkan Analisa Telaahan Staff')
                                        ->minLength(20)
                                        ->rows(2)
                                        ->autoSize()
                                        ->required(),

                                    Textarea::make('saran')
                                        ->label('Saran')
                                        ->placeholder('Masukkan Saran Telaahan Staff')
                                        ->minLength(20)
                                        ->rows(3)
                                        ->autoSize()
                                        ->columnSpanFull()
                                        ->required(),
                                ])
                        ]),
                    Step::make('Permintaan')
                        ->label('Permohonan & Lampiran')
                        ->description('Data Permohonan Telaahan Staff')
                        ->schema([
                            Textarea::make('kesimpulan')
                                ->label('Kesimpulan')
                                ->placeholder('Masukkan Kesimpulan Telaahan Staff')
                                ->minLength(20)
                                ->rows(2)
                                ->autoSize()
                                ->required(),

                            Select::make('jenis_permintaan_id')
                                ->label('Jenis Permintaan')
                                ->placeholder('Pilih Jenis Permintaan')
                                ->relationship('jenisPermintaan', 'nama', function ($query) {
                                    $query->orderBy('id', 'asc');
                                })
                                ->preload()
                                ->searchable()
                                ->native(false)
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    // Logika untuk menentukan tindakan berdasarkan pilihan jenis_permintaan_id
                                    if ($state == 1) {
                                        // Tampilkan permintaan_barang
                                        $set('permintaan_barang', []); // Kosongkan data sebelumnya
                                    } elseif ($state == 2) {
                                        // Tampilkan pemeliharaan
                                        $set('pemeliharaan', []);
                                    } elseif ($state == 3) {
                                        // Tampilkan lainnya
                                        $set('lainnya', []);
                                    } else {
                                        // Sembunyikan semua
                                        $set('permintaan_barang', null);
                                        $set('pemeliharaan', null);
                                        $set('lainnya', null);
                                    }
                                }),

                            // Repeater untuk Permintaan Barang
                            Repeater::make('permintaan_barang')
                                ->label('Permintaan Barang')
                                ->relationship('permintaanBarang') // Relasi untuk tabel permintaan_barang
                                ->schema([
                                    TextInput::make('nama')
                                        ->label('Nama Barang')
                                        ->placeholder('Masukkan Nama Barang')
                                        ->minLength(3)
                                        ->maxLength(45)
                                        ->required(),

                                    TextInput::make('kuantitas')
                                        ->label('Kuantitas')
                                        ->placeholder('Masukkan Kuantitas Barang')
                                        ->numeric()
                                        ->minValue(1)
                                        ->maxValue(999)
                                        ->required(),

                                    TextInput::make('harga')
                                        ->label('Harga Satuan')
                                        ->placeholder('Masukkan Harga Satuan Barang')
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->suffix('.00')
                                        ->mask(RawJs::make('$money($input)'))
                                        ->stripCharacters(',')
                                        ->hidden(fn() => Auth::user()->unit_id !== 1)
                                        ->minValue(1000)
                                        ->columnSpanFull(),
                                ])
                                ->columns(2)
                                ->hidden(fn(callable $get) => $get('jenis_permintaan_id') != 1), // Hanya tampil jika jenis_permintaan_id = 1

                            // Repeater untuk Pemeliharaan
                            Repeater::make('pemeliharaan')
                                ->label('Pemeliharaan')
                                ->relationship('pemeliharaan') // Relasi untuk tabel pemeliharaan
                                ->schema([
                                    Textarea::make('deskripsi')
                                        ->label('Deskripsi Pemeliharaan')
                                        ->placeholder('Masukkan Deskripsi')
                                        ->rows(1)
                                        ->autosize()
                                        ->required(),

                                    TextInput::make('harga')
                                        ->label('Harga Satuan')
                                        ->placeholder('Masukkan Harga Satuan Barang')
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->suffix('.00')
                                        ->mask(RawJs::make('$money($input)'))
                                        ->stripCharacters(',')
                                        ->hidden(fn() => Auth::user()->unit_id !== 1)
                                        ->minValue(1000),
                                ])
                                ->hidden(fn(callable $get) => $get('jenis_permintaan_id') != 2), // Hanya tampil jika jenis_permintaan_id = 2

                            // Repeater untuk Permintaan Lainnya
                            Repeater::make('lainnya')
                                ->label('Permintaan Lainnya')
                                ->relationship('lainnya') // Relasi untuk tabel lainnya
                                ->schema([
                                    Textarea::make('deskripsi')
                                        ->label('Deskripsi Permintaan Lainnya')
                                        ->placeholder('Masukkan Deskripsi')
                                        ->rows(1)
                                        ->autosize()
                                        ->required(),

                                    TextInput::make('harga')
                                        ->label('Harga Satuan')
                                        ->placeholder('Masukkan Harga Satuan Barang')
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->suffix('.00')
                                        ->mask(RawJs::make('$money($input)'))
                                        ->stripCharacters(',')
                                        ->hidden(fn() => Auth::user()->unit_id !== 1)
                                        ->minValue(1000),
                                ])
                                ->hidden(fn(callable $get) => $get('jenis_permintaan_id') != 3),

                            Repeater::make('Lampiran')
                                ->relationship('lampiran')
                                ->schema([
                                    TextInput::make('keterangan')
                                        ->label('Keterangan')
                                        ->placeholder('Masukkan Keterangan')
                                        ->minLength(3)
                                        ->maxLength(100)
                                        ->required(),

                                    FileUpload::make('nama_file')
                                        ->label('Unggah Lampiran Telaahan Staff')
                                        ->visibility('public')
                                        ->image()
                                        ->imageEditor()
                                        ->uploadingMessage('Mengunggah Lampiran...')
                                        ->preserveFilenames()
                                        ->required()
                                ]),

                            Grid::make(2)
                                ->schema([
                                    TextInput::make('total_satuan_harga')
                                        ->label('Total Satuan Harga')
                                        ->placeholder('Total Satuan Harga Akan Terisi Otomatis')
                                        ->default(0)
                                        ->numeric()
                                        ->hidden()
                                        ->prefix('IDR')
                                        ->suffix('.00')
                                        ->dehydratedWhenHidden()
                                        ->columnSpanFull(),
                                ])
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor')
                    ->label('Nomor')
                    ->description(
                        fn(TelaahanStaff $record): string =>
                        Carbon::parse($record->tanggal)->translatedFormat('l, d F Y')
                    )
                    ->searchable(),

                TextColumn::make('jenisPermintaan.nama')
                    ->label('Jenis Permintaan')
                    ->sortable(),

                // Kondisi Kolom Status Berdasarkan unit_id
                Auth::user()->unit_id === 1
                ? SelectColumn::make('status')
                    ->label('Status Telaahan Staff')
                    ->options([
                        0 => 'Menunggu',
                        1 => 'Diterima',
                        2 => 'Ditolak',
                    ])
                    ->selectablePlaceholder(false)
                    ->searchable()
                    ->sortable()
                : TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 1, // Diterima
                        'warning' => 0, // Menunggu
                        'danger' => 2,  // Ditolak
                    ])
                    ->formatStateUsing(fn(int $state): string => match ($state) {
                        0 => 'Menunggu',
                        1 => 'Diterima',
                        2 => 'Ditolak',
                        default => 'Tidak Diketahui',
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_satuan_harga')
                    ->label('Total Satuan Harga')
                    ->numeric()
                    ->prefix('Rp ')
                    ->suffix('.00')
                    ->default('0')
                    ->hidden(fn() => Auth::user()->unit_id !== 1)
            ])
            ->filters([
                Auth::user()->unit_id === 1
                ? SelectFilter::make('unit_id')
                    ->label('Unit')
                    ->options(function () {
                        $options = [];

                        // Jika pengguna bukan admin, hanya unit milik pengguna yang bisa dilihat
                        if (Auth::user()->unit_id != 1) {
                            // Dapatkan unit pengguna melalui relasi
                            $unit = Auth::user()->unit;
                            if ($unit) {
                                // Tampilkan unit pengguna
                                $options[$unit->id] = 'Unit Anda: ' . $unit->nama;
                            }
                        } else {
                            // Jika pengguna admin, tampilkan semua unit
                            $options = Unit::all()->pluck('nama', 'id')->toArray();
                        }

                        return $options;
                    })
                    ->native(false)
                : SelectFilter::make('unit_id')
                    ->label('Unit')
                    ->options(function () {
                        $options = [];

                        // If the user is not an admin, filter by their unit_id
                        if (Auth::user()->unit_id != 1) {
                            // Get the user's unit using the relationship
                            $unit = Auth::user()->unit;  // This uses the Eloquent relationship
                            if ($unit) {
                                // Use the unit's name as the label
                                $options[$unit->id] = 'Unit Anda: ' . $unit->nama; // 'nama' is the unit's name
                            }
                        } else {
                            // If the user is an admin, show all units
                            $options = Unit::all()->pluck('nama', 'id')->toArray();
                        }

                        return $options;
                    })
                    ->native(false)
                    ->query(fn($query) => $query->when(Auth::user()->unit_id != 1, fn($query) => $query->where('unit_id', Auth::user()->unit_id))),

                SelectFilter::make('jenis_permintaan_id')
                    ->label('Jenis Permintaaan')
                    ->relationship('jenisPermintaan', 'nama', function ($query) {
                        $query->orderBy('id', 'asc');
                    })
                    ->preload()
                    ->searchable()
                    ->native(false),

                DateRangeFilter::make('created_at')
                    ->label('Tanggal')
                    ->placeholder('Pilih Rentang Tanggal')
                    ->minDate(Carbon::now()->subMonth())
                    ->maxDate(Carbon::now()->addMonth()),
            ])
            ->actions([
                Action::make('print')
                    ->label('Cetak')
                    ->url(fn(TelaahanStaff $record): string => route('telaahanStaff.print', $record))
                    ->button()
                    ->icon('heroicon-m-document-text')
                    ->iconPosition(IconPosition::After)
                    ->labeledFrom('md')
                    ->openUrlInNewTab(),

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    ExportAction::make()
                        ->exporter(TelaahanStaffExporter::class)
                        ->formats([
                            ExportFormat::Xlsx,
                        ]),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTelaahanStaff::route('/'),
        ];
    }
}
