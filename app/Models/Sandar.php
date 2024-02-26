<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


class Sandar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = ['status' => 'boolean'];

    public function kapal()
    {
        return $this->belongsTo(Kapal::class)->withTrashed();
    }

    public function bongkar()
    {
        return $this->hasOne(Bongkar::class)->withTrashed();
    }

    public function muat()
    {
        return $this->hasOne(Muat::class)->withTrashed();
    }

    
}
