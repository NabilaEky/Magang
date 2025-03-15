<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; // Nama tabel di database

    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'caption',
        'gambar',
    ];
}
