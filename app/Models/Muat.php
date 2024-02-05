<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Muat extends Model
{
    use HasFactory;
    protected $guarded = [];
    use SoftDeletes;

    public function kapal()
    {
        return $this->belongsTo(Kapal::class)->withTrashed();
    }
}