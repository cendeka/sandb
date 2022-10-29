<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'db_foto';

    protected $fillable = ['pekerjaan_id', 'nama', 'path', 'progress', 'lat', 'long', 'keterangan'];

    /**
     * Get all of the comments for the Foto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'id', 'pekerjaan_id');
    }
}
