<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenandatanganModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'penandatangan';
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

    public function kegiatanJadwal(): BelongsTo
    {
        return $this->belongsTo(KegiatanJadwalModel::class, 'kegiatan_jadwal_ref', 'ref');
    }
}
