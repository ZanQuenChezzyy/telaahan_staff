<?php

namespace App\Models;

use App\Policies\JenisPermintaanPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPermintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function telaahanStaff(): HasMany
    {
        return $this->hasMany(TelaahanStaff::class);
    }

    protected $policies = [
        JenisPermintaan::class => JenisPermintaanPolicy::class,
    ];
}
