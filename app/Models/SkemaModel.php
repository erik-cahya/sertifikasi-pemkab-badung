<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SkemaModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'skema';
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

    public function details()
    {
        return $this->hasMany(
            SkemaDetailModel::class,
            'skema_ref',
            'ref'
        );
    }
}
