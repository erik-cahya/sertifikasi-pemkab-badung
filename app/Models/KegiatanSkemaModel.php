<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSkemaModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'kegiatan_skema';
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
    public function lsp()
    {
        return $this->belongsTo(LSPModel::class, 'lsp_ref', 'ref');
    }

    public function skema()
    {
        return $this->belongsTo(SkemaModel::class, 'skema_ref', 'ref');
    }
}
