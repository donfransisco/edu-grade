<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'program_studi',
        'angkatan',
        'email',
        'telepon',
        'alamat',
        'foto',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
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
