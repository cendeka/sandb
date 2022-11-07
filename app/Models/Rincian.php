<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    use HasFactory;

    protected $table = 'db_paket';

    protected $guarded = [];

    public function setAspirasiAttribute($value)
    {
        $this->attributes['aspirasi'] = $value ?? 0;
    }

    /**
     * Get the user associated with the Paket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, 'id', 'pekerjaan_id');
    }

    /**
     * Get the user associated with the Output
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function output()
    {
        return $this->hasMany(Output::class, 'pekerjaan_id', 'pekerjaan_id');
    }
}
