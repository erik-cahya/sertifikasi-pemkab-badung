<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TUKModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'tuk';
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
