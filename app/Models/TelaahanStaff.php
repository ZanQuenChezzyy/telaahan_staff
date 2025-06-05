<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelaahanStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_permintaan_id',
        'unit_id',
        'kepada',
        'dari',
        'tanggal',
        'nomor',
        'perihal',
        'persoalan',
        'peranggapan',
        'fakta',
        'analisa',
        'kesimpulan',
        'saran',
        'status',
        'total_satuan_harga',
        'wadir',
        'nama_kabid',
        'nip_kabid',
        'nama_wadir',
        'nip_wadir',
    ];

    public function jenisPermintaan(): BelongsTo
    {
        return $this->belongsTo(JenisPermintaan::class, 'jenis_permintaan_id', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function permintaanBarang(): HasMany
    {
        return $this->hasMany(PermintaanBarang::class);
    }

    public function pemeliharaan(): HasMany
    {
        return $this->hasMany(Pemeliharaan::class);
    }

    public function lainnya(): HasMany
    {
        return $this->hasMany(Lainnya::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(Lampiran::class);
    }
}
