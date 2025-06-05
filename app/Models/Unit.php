<?php

namespace App\Models;

use App\Policies\UnitPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function telaahanStaff(): HasMany
    {
        return $this->hasMany(TelaahanStaff::class);
    }

    protected $policies = [
        Unit::class => UnitPolicy::class,
    ];
}
