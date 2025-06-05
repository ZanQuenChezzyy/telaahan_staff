<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'telaahan_staff_id',
        'keterangan',
        'nama_file',
    ];

    public function telaahanStaff(): BelongsTo
    {
        return $this->belongsTo(TelaahanStaff::class, 'telaahan_staff_id', 'id');
    }
}
