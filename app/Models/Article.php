<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'gambar', 'isi', 'tanggal_upload'];

    protected $casts = [
        'tanggal_upload' => 'datetime'
    ];
}