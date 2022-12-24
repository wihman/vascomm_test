<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'kode_vendor',
        'nama_vendor',
        'id_jenis_vendor',
        'keterangan'
    ];

    public function get_jenis_vendor()
    {
        return $this->belongsTo('App\JenisVendor', 'id_jenis_vendor', 'kode_jenis_vendor');
    }
}
