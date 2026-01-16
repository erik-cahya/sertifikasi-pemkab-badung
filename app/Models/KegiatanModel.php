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
        return $this->hasMany(KegiatanDetailModel::class, 'kegiatan_ref', 'ref');
    }

    public function details(): HasMany
    {
        return $this->hasMany(
            KegiatanDetailModel::class,
            'kegiatan_ref', // FK di kegiatan_detail
            'ref'           // PK di kegiatan
        );
    }
}
