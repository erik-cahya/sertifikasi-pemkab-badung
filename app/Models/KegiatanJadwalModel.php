<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanJadwalModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'kegiatan_jadwal';
    protected $guarded = ['ref'];

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

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(
            KegiatanModel::class,
            'kegiatan_ref',
            'ref'
        );
    }

    public function lsp(): BelongsTo
    {
        return $this->belongsTo(
            LSPModel::class,
            'lsp_ref',
            'ref'
        );
    }

    public function kegiatanLsp()
    {
        return $this->belongsTo(
            KegiatanLSPModel::class,
            'kegiatan_lsp_ref',
            'ref'
        );
    }
}
