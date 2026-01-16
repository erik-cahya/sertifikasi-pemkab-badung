<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LSPModel extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'lsp';
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_ref', 'ref');
    }

    protected static function booted()
    {
        static::deleting(function ($lsp) {
            if ($lsp->user) {
                $lsp->user->delete();
            }
        });
    }
}
