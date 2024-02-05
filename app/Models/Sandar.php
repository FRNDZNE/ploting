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

    // public function getStartAttribute()
    // {
    //     $start = $this->attributes['start'];
    //         $parse = Carbon::parse($start);
    //         $date = $parse->translatedFormat('l, d F Y');
    //         $time = $parse->translatedFormat('G:i');

    //         $result = $date . ' Jam '. $time;
    //         return $result;
    // }
    // public function getFinishAttribute()
    // {
    //     $finish = $this->attributes['finish'];
    //     $parse = Carbon::parse($finish);
    //     $date = $parse->translatedFormat('l, d F Y');
    //     $time = $parse->translatedFormat('G:i');

    //     $result = $date . ' Jam '. $time;
    //     return $result;
    //     // return Carbon::parse($this->attributes['finish'])->translatedFormat('l, d F Y G:i') . ' Pukul ' . Carbon::parse($this->attributes['finish'])->translatedFormat('G:i');
    // }
}
