<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'db_pekerjaan';

    protected $fillable = ['id','program_id', 'nama_pekerjaan', 'desa_id', 'kecamatan_id', 'pagu', 'tahun_anggaran', 'sumber_dana'];

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'program_id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function desa()
    {
        return $this->hasOne(Desa::class, 'id', 'desa_id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kec()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kecamatan_id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(Kontrak::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function foto()
    {
        return $this->hasOne(Foto::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get all of the comments for the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tfl()
    {
        return $this->hasOne(Tfl::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get all of the comments for the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function realisasi_output()
    {
        return $this->hasMany(OutputRealisasi::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get the user associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function output()
    {
        return $this->hasMany(Output::class, 'pekerjaan_id', 'id');
    }

    /**
     * Get the rincian associated with the Pekerjaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rincian()
    {
        return $this->hasOne(Rincian::class, 'pekerjaan_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($pekerjaan) { // before delete() method call this
        $pekerjaan->detail()->delete();
            // do the rest of the cleanup...
        });
    }
}
