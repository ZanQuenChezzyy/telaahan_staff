<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lainnya extends Model
{
    use HasFactory;

    protected $fillable = [
        'telaahan_staff_id',
        'deskripsi',
        'harga'
    ];

    public function telaahanStaff(): BelongsTo
    {
        return $this->belongsTo(TelaahanStaff::class, 'telaahan_staff_id', 'id');
    }
}
