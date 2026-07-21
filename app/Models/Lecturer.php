<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'telepon',
        'program_studi',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public static function programStudiOptions(): array
    {
        return [
            'Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Sipil',
            'Manajemen',
            'Akuntansi',
            'Hukum',
            'Kedokteran',
            'Psikologi',
        ];
    }
}
