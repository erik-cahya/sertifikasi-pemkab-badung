<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LSPModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'lsp';
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ref', 'ref');
    }


    // public function kegiatanDetails()
    // {
    //     return $this->hasMany(
    //         KegiatanDetailModel::class,
    //         'lsp_ref',
    //         'ref'
    //     );
    // }

    public function skemas()
    {
        return $this->hasMany(SkemaModel::class, 'lsp_ref', 'ref');
    }


    public function kodeUnits()
    {
        return $this->hasManyThrough(
            SkemaDetailModel::class,
            SkemaModel::class,
            'lsp_ref',     // FK di skema
            'skema_ref',   // FK di kode_unit
            'ref',
            'ref'
        );
    }



    protected static function booted()
    {
        static::deleting(function ($lsp) {
            if ($lsp->user) {
                $lsp->user->delete();
            }
        });
    }
}
