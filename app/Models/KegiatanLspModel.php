<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanLSPModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'kegiatan_lsp';
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

    public function lsp(): BelongsTo
    {
        return $this->belongsTo(LSPModel::class, 'lsp_ref', 'ref');
    }
}
