<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'item';
    protected $guarded = ['ref'];
    protected $fillable = [
        'item_kategori',
        'item_nama',
        'created_by',
    ];


    public function uniqueIds()
    {
        return ['ref'];
    }

}
