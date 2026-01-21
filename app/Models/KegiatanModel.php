<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanModel extends Model
{
    use HasUlids;


    protected $table = 'kegiatan';
    protected $guarded = ['ref'];

    protected $primaryKey = 'ref';
    public $incrementing = false;
    protected $keyType = 'string';


    public function uniqueIds()
    {
        return ['ref'];
    }
    public function setRefAttribute($value)
    {
        if ($value !== null) {
            $this->attributes['ref'] = strtoupper($value);
        }
    }

    public function kegiatanDetail()
    {
        return $this->hasMany(KegiatanJadwalModel::class, 'kegiatan_ref', 'ref');
    }

    public function kegiatanLsp(): HasMany
    {
        return $this->hasMany(
            KegiatanLSPModel::class,
            'kegiatan_ref', // FK di kegiatan_lsp
            'ref'           // PK di kegiatan
        );
    }

    public function detailsGroupedByLsp()
    {
        return $this->hasMany(KegiatanJadwalModel::class, 'kegiatan_ref', 'ref')
            ->selectRaw('kegiatan_ref, lsp_ref, SUM(kuota_lsp) as total_kuota_lsp')
            ->groupBy('kegiatan_ref', 'lsp_ref');
    }

    public function skemas()
    {
        return $this->belongsToMany(
            SkemaModel::class,     // model tujuan
            'kegiatan_skema',      // pivot table
            'kegiatan_ref',        // FK di pivot ke kegiatan
            'skema_ref'            // FK di pivot ke skema
        )->withTimestamps();
    }

    public function skemaPerLsp()
    {
        return $this->hasMany(
            KegiatanSkemaModel::class,
            'kegiatan_ref',
            'ref'
        )
            ->selectRaw('kegiatan_ref, lsp_ref, COUNT(skema_ref) as total_skema')
            ->groupBy('kegiatan_ref', 'lsp_ref');
    }

    public function kuotaPerLsp()
    {
        return $this->hasMany(
            KegiatanLSPModel::class,
            'kegiatan_ref',
            'ref'
        )
            ->selectRaw('kegiatan_ref, lsp_ref, SUM(kuota_lsp) as total_kuota')
            ->groupBy('kegiatan_ref', 'lsp_ref');
    }
}
