<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SkemaModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'skema';
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

    public function kodeUnits()
    {
        return $this->hasMany(SkemaDetailModel::class, 'skema_ref', 'ref');
    }

    public function details()
    {
        return $this->hasMany(
            SkemaDetailModel::class,
            'skema_ref',
            'ref'
        );
    }

    public function kegiatans()
    {
        return $this->belongsToMany(
            KegiatanModel::class,
            'kegiatan_skema',
            'skema_ref',
            'kegiatan_ref'
        );
    }
}
