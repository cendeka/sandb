<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'db_desa';

    /**
     * Get the kec associated with the Desa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kec()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kec_id');
    }

    /**
     * Get all of the kegiatan for the Desa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan()
    {
        return $this->hasMany(Pekerjaan::class, 'desa_id', 'id');
    }

}
