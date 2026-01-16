<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TUKModel extends Model
{
    protected $table = 'tuk';
    protected $guarded = ['ref'];


    public function uniqueIds()
    {
        return ['ref'];
    }
}
