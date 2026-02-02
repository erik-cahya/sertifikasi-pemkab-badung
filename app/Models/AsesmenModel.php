<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'asesmen';
    protected $guarded = ['ref'];
    protected $primaryKey = 'ref';
    public $incrementing = false;
    protected $keyType = 'string';

    public function setRefAttribute($value)
    {
        if ($value !== null) {
            $this->attributes['ref'] = strtoupper($value);
        }
    }

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanModel::class, 'kegiatan_ref', 'ref');
    }

    public function kegiatanLsp()
    {
        return $this->belongsTo(KegiatanLSPModel::class, 'kegiatan_lsp_ref', 'ref');
    }

    public function kegiatanJadwal()
    {
        return $this->belongsTo(KegiatanJadwalModel::class, 'kegiatan_jadwal_ref', 'ref');
    }

    public function asesis()
    {
        return $this->hasMany(AsesiModel::class, 'asesmen_ref', 'ref');
    }
}
