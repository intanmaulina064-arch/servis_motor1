<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'no_plat_kendaraan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_plat_kendaraan',
        'id_pelanggan',
        'jenis_kendaraan',
        'no_stnk',
        'tahun_pembuatan',
        'nama_pemilik',
        'warna_kendaraan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function daftarService()
    {
        return $this->hasMany(
            DaftarService::class,
            'no_plat_kendaraan',
            'no_plat_kendaraan'
        );
    }
}