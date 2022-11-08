<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $table = 'db_output';

    protected $fillable = ['pekerjaan_id', 'komponen', 'volume', 'satuan', 'output'];

    /**
     * Get all of the comments for the Output
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function realisasi_output()
    {
        return $this->hasMany(OutputRealisasi::class, 'output_id', 'id');
    }

    /**
     * Get the rincian associated with the Rincian
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function rincian()
    {
        return $this->hasMany(Rincian::class, 'pekerjaan_id', 'pekerjaan_id');
    }

    /**
     * Get the user that owns the Output
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id', 'pekerjaan_id');
    }

}
