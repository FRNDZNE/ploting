<?php

namespace App\Http\Controllers;

use App\Events\KapalEvent;
use Illuminate\Http\Request;
use App\Models\Kapal;
use App\Models\Sandar;
use App\Models\Bongkar;
use App\Models\Muat;
use Carbon\Carbon;
use Image;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class SandarController extends Controller
{
    // method get on routes
    public function dashboard()
    {
        
        return view('admin.dashboard');
    }

    public function index()
    {
        $isDeleted = false;
        $data = Sandar::with('kapal')->get();

        foreach ($data as $d) {
            $d->mulai = Carbon::parse($d->start)->translatedFormat('l, d F Y H:i');
            $d->selesai = Carbon::parse($d->finish)->translatedFormat('l, d F Y H:i');
        }
        return view('admin.sandar.index',compact('data','isDeleted'));
    }

    public function create()
    {
        $kapal = Kapal::all();
        return view('admin.sandar.create',compact('kapal'));
    }

    public function edit($id)
    {
        $data['kapal'] = Kapal::all();
        $data['sandar'] = Sandar::where('id',$id)->with(['bongkar','muat'])->first();
        return view('admin.sandar.edit',compact('data'));
    }

    public function detail($id)
    {
        $isDeleted = false;
        $data = Sandar::with(['kapal','bongkar','muat'])->where('id',$id)->first();
        if ($data) {
            # code...
            $data->mulai = Carbon::parse($data->start)->translatedFormat('l, d F Y H:i');
            $data->selesai = Carbon::parse($data->finish)->translatedFormat('l, d F Y H:i');
        }
        return view('admin.sandar.detail',compact('data','isDeleted'));
    }

    public function history()
    {   
        $isDeleted = true;
        $data = Sandar::with('kapal')->onlyTrashed()->get();

        foreach ($data as $d) {
            $d->mulai = Carbon::parse($d->start)->translatedFormat('l, d F Y H:i');
            $d->selesai = Carbon::parse($d->finish)->translatedFormat('l, d F Y H:i');
        }
        return view('admin.sandar.index',compact('data','isDeleted'));
    }

    public function history_detail($id)
    {
        
    }
    // post method

    public function store(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'between' => ucwords(':attribute melewati batas dermaga !'),
            'gt' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'kapal_id' => ucwords('Pilihan'),
            'rangestart' => ucwords('KD meter'),
            'start' => ucwords('tanggal mulai'),
            'finish' => ucwords('tanggal selesai'),
            'status' => ucwords('status'),
        ];

        $request->validate([
            'kapal_id' => 'gt:0',
            'rangestart' => 'required|numeric|between:0,820',
            'start' => 'required',
            'finish' => 'required',
            'status' => 'required',
        ], $messages, $attributes);
        
        $sandar = new Sandar;
        $sandar->kapal_id = $request->kapal_id;
        $sandar->rangestart = $request->rangestart;
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->created_by = Auth::user()->name;
        $sandar->save();

        $bongkar = new Bongkar;
        $bongkar->sandar_id = $sandar->id;
        $bongkar->nama = $request->bongkar;
        $bongkar->jumlah = $request->jlhbongkar;
        $bongkar->satuan = $request->stbongkar;
        $bongkar->save();

        $muat = new Muat;
        $muat->sandar_id =  $sandar->id;
        $muat->nama = $request->muat;
        $muat->jumlah = $request->jlhmuat;
        $muat->satuan = $request->stmuat;
        $muat->save();
        return redirect()->route('admin.sandar.index')->with('success','Berhasil Menambah Data');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'between' => ucwords(':attribute melewati batas dermaga'),
        ];

        $attributes = [
            'rangestart' => ucwords('KD meter'),
            'start' => ucwords('tanggal mulai'),
            'finish' => ucwords('tanggal selesai'),
            'status' => ucwords('status'),
        ];

        $request->validate([
            'rangestart' => 'required|numeric|between:0,820',
            'start' => 'required',
            'finish' => 'required',
            'status' => 'required',
        ], $messages, $attributes);

        $sandar = Sandar::where('id',$id)->first();
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->rangestart = $request->rangestart;
        $sandar->created_by = Auth::user()->name;
        $sandar->save();

        $bongkar = Bongkar::where('sandar_id',$id)->first();
        $bongkar->sandar_id = $id;
        $bongkar->nama = $request->bongkar;
        $bongkar->jumlah = $request->jlhbongkar;
        $bongkar->satuan = $request->stbongkar;
        $bongkar->save();

        $muat = Muat::where('sandar_id',$id)->first();
        $muat->sandar_id =  $id;
        $muat->nama = $request->muat;
        $muat->jumlah = $request->jlhmuat;
        $muat->satuan = $request->stmuat;
        $muat->save();
        
        return redirect()->route('admin.sandar.index')->with('success','Berhasil Update Data');

    }

    // Soft Delete jadi foto tidak ikut dihapus
    public function delete($id)
    {
        Sandar::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }

    public function restore($id)
    {
        Sandar::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Data Berhasil Dipulihkan');
    }

    public function destroy($id)
    {
        Sandar::withTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Berhasil Hapus Permanen');
    }

    public function setketerangan(Request $request)
    {
        $keterangan = Sandar::where('id',$request->id)->first();
        $keterangan->info = $request->info;
        $keterangan->save();
        return redirect()->back()->with('success','Berhasil Mengubah Keterangan');
    }
}
