<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkemaDetailModel extends Model
{
    use HasFactory, HasUlids;


    protected $table = 'skema_detail';
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

    public function skema()
    {
        return $this->belongsTo(SkemaModel::class, 'skema_ref', 'ref');
    }
}
