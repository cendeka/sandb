<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'db_kec';

    /**
     * Get all of the comments for the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function desa()
    {
        return $this->hasMany(Desa::class, 'kec_id', 'id');
    }

    /**
     * Get all of the comments for the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan()
    {
        return $this->hasMany(Pekerjaan::class, 'kecamatan_id', 'id');
    }
}
