<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sandar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $data = Sandar::select(DB::raw('*, date(start) as mulai'))
        // ->with('kapal')->get();

        // $dateRange = [];

        // for ($i = 6; $i >= 0; $i--) {
        //     $dateRange[] = now()->addDay($i)->toDateString();
        // }

        // $final = [
        //     'data' => $data,
        //     'date_range' => $dateRange
        // ];
        // if (request()->boolean('json')) {
        //     return $final;
        // }
        // $loginPage = false;
        $data = Sandar::select(DB::raw('*, date(start) as mulai, date(finish) as selesai'))
            ->with('kapal')
            ->where('finish', '>', now())
            ->get();

        $dateRange = [];

        for ($i = 5; $i >= 0; $i--) {
            $dateRange[] = now()->addDay($i)->toDateString();
        }

        $final = [
            'data' => $data,
            'date_range' => $dateRange,
        ];

        if (request()->boolean('json')) {
            # code...
            return $final;
        }   
        return view('welcome', $final);
    }
}
