<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

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
}
