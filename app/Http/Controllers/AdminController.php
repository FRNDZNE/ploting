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

class AdminController extends Controller
{
    // method get on routes
    public function dashboard()
    {
        $date = now()->toDateString();
        $data['kapal'] = Kapal::all();
        $data['sandar'] = Sandar::where([
            ['start', '<=', $date],
            ['finish' ,'>', $date],
            ['status', 1]
        ])->get();
        $data['rencana'] = Sandar::where('status',0);
        $data['selesai'] = Sandar::where('finished', 1)->get();
        // return $data;
        return view('admin.dashboard',compact('data'));
    }

    public function index()
    {
        $isDeleted = false;
        $data = Kapal::all();
        return view('admin.index',compact('data','isDeleted'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function edit($id)
    {
        $data = Kapal::where('id',$id)->first();
        return view('admin.edit',compact('data'));
    }

    public function detail($id)
    {
        $isDeleted = false;
        $data = Kapal::where('id',$id)->first();
        return view('admin.detail',compact('data','isDeleted'));
    }

    public function history()
    {   
        $isDeleted = true;
        $data = Kapal::onlyTrashed()->get();
        return view('admin.index',compact('data','isDeleted'));
    }

    public function history_detail($id)
    {
        $isDeleted = true;
        $data = Kapal::withTrashed()->where('id',$id)->first();
        return view('admin.detail',compact('data','isDeleted'));
    }
    // post method

    public function store(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'between' => ucwords(':attribute melewati batas dermaga'),
        ];

        $attributes = [
            'nama' => ucfirst('nama'),
            'panjang' => ucfirst('panjang'),
            'foto' => ucfirst('foto'),
            'rangestart' => ucwords('KD meter'),
            'start' => ucwords('tanggal mulai'),
            'finish' => ucwords('tanggal selesai'),
            'status' => ucwords('status'),
        ];

        $request->validate([
            'nama' => 'required',
            'panjang' => 'required',
            'foto' => 'required',
            'rangestart' => 'required|numeric|between:0,820',
            'start' => 'required',
            'finish' => 'required',
            'status' => 'required',
        ], $messages, $attributes);
        $kapal = new Kapal;
        $kapal->nama = $request->nama;
        $kapal->panjang = $request->panjang;
        $file = "uploads/". md5(date('dmyhis')). ".png";
        if ($request->file('foto')) {
            # code...
            Image::make($request->file('foto'))->encode('png',100)->save($file);    
        }else {
            unset($kapal->foto);
        }

        $kapal->foto = $file;
        $kapal->created_by = Auth::user()->name;
        $kapal->save();

        $sandar = new Sandar;
        $sandar->kapal_id = $kapal->id;
        $sandar->rangestart = $request->rangestart;
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->save();

        $bongkar = new Bongkar;
        $bongkar->kapal_id = $kapal->id;
        $bongkar->nama = $request->bongkar;
        $bongkar->jumlah = $request->jlhbongkar;
        $bongkar->satuan = $request->stbongkar;
        $bongkar->save();

        $muat = new Muat;
        $muat->kapal_id =  $kapal->id;
        $muat->nama = $request->muat;
        $muat->jumlah = $request->jlhmuat;
        $muat->satuan = $request->stmuat;
        $muat->save();
        return redirect()->route('admin.index')->with('success','Berhasil Menambah Data');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'between' => ucwords(':attribute melewati batas dermaga'),
        ];

        $attributes = [
            'nama' => ucfirst('nama'),
            'panjang' => ucfirst('panjang'),
            'rangestart' => ucwords('KD meter'),
            'start' => ucwords('tanggal mulai'),
            'finish' => ucwords('tanggal selesai'),
            'status' => ucwords('status'),
        ];

        $request->validate([
            'nama' => 'required',
            'panjang' => 'required',
            'rangestart' => 'required|numeric|between:0,820',
            'start' => 'required',
            'finish' => 'required',
            'status' => 'required',
        ], $messages, $attributes);

        $kapal = Kapal::where('id',$id)->first();
        $kapal->nama = $request->nama;
        $kapal->panjang = $request->panjang;
        if ($request->foto) {
            if (file_exists($kapal->foto)) {
                unlink($kapal->foto);
            }
            $file = "uploads/". md5(date('dmyhis')). ".png";
            Image::make($request->file('foto'))->encode('png',100)->save($file);
            $kapal->foto = $file;
        } else {
            unset($kapal->foto);
        }
        $kapal->created_by = Auth::user()->name;
        $kapal->save();
        
        $sandar = Sandar::where('kapal_id',$id)->first();
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->rangestart = $request->rangestart;
        $sandar->save();

        $bongkar = Bongkar::where('kapal_id',$id)->first();
        $bongkar->kapal_id = $kapal->id;
        $bongkar->nama = $request->bongkar;
        $bongkar->jumlah = $request->jlhbongkar;
        $bongkar->satuan = $request->stbongkar;
        $bongkar->save();

        $muat = Muat::where('kapal_id',$id)->first();
        $muat->kapal_id =  $kapal->id;
        $muat->nama = $request->muat;
        $muat->jumlah = $request->jlhmuat;
        $muat->satuan = $request->stmuat;
        $muat->save();
        
        return redirect()->route('admin.index')->with('success','Berhasil Update Data');

    }

    // Soft Delete jadi foto tidak ikut dihapus
    public function delete($id)
    {
        $kapal = Kapal::find($id);
        $kapal->sandar()->delete();
        $kapal->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data');
    }

    public function restore($id)
    {
        $kapal = Kapal::withTrashed()->find($id);
        $kapal->sandar()->restore();
        $kapal->restore();
        return redirect()->back()->with('success','Data Berhasil Dipulihkan');
    }

    public function destroy($id)
    {
        $kapal = Kapal::withTrashed()->where('id',$id)->first();
        if (file_exists($kapal->foto)) {
            unlink($kapal->foto);
        }
        $kapal->forceDelete();
        return redirect()->back()->with('success','Berhasil Hapus Permanen');
    }

    public function setketerangan(Request $request)
    {
        $keterangan = Sandar::where('kapal_id',$request->id)->first();
        $keterangan->info = $request->keterangan;
        $keterangan->save();
        return redirect()->back()->with('success','Berhasil Mengubah Keterangan');
    }
}
