<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'jabatan';
    protected $guarded = ['ref'];

    public function uniqueIds()
    {
        return ['ref'];
    }

}
