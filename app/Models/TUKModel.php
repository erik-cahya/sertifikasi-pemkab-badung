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
    protected $primaryKey = 'ref';
    public $incrementing = false;
    protected $keyType = 'string';
    // protected $fillable = [
    //     'lsp_ref',
    //     'tuk_nama',
    //     'tuk_alamat',
    //     'tuk_email',
    //     'tuk_telp',
    //     'tuk_cp_nama',
    //     'tuk_cp_email',
    //     'tuk_cp_telp',
    //     'tuk_verif',
    // ];


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
