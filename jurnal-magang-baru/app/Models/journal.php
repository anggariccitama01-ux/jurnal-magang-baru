<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database MySQL
    protected $table = 'journals';

    // Mendaftarkan kolom yang boleh diisi oleh sistem dan user
    protected $fillable = [
        'tanggal',
        'kegiatan',
        'kendala',
        'catatan_pembimbing',
    ];
}
