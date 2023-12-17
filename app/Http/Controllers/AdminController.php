<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kapal;
use App\Models\Sandar;
use Image;
use File;

class AdminController extends Controller
{
    // method get on routes
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $isDeleted = false;
        $data = Kapal::with('sandar')->get();
        return view('admin.index',compact('data','isDeleted'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function edit($id)
    {
        $data = Kapal::with('sandar')->where('id',$id)->first();
        return view('admin.edit',compact('data'));
    }

    public function detail($id)
    {
        $isDeleted = false;
        $data = Kapal::with('sandar')->where('id',$id)->first();
        return view('admin.detail',compact('data','isDeleted'));
    }

    public function history()
    {   
        $isDeleted = true;
        $data = Kapal::with('sandar')->onlyTrashed()->get();
        return view('admin.index',compact('data','isDeleted'));
    }

    public function history_detail($id)
    {
        $isDeleted = true;
        $data = Kapal::with('sandar')->withTrashed()->where('id',$id)->first();
        return view('admin.detail',compact('data','isDeleted'));
    }
    // post method

    public function store(Request $request)
    {
        $kapal = new Kapal;
        $kapal->nama = $request->nama;
        $kapal->panjang = $request->panjang;
        $file = "uploads/". md5(date('dmyhis')). ".png";
        Image::make($request->file('foto'))->encode('png',100)->save($file);
        $kapal->foto = $file;
        $kapal->save();

        $sandar = new Sandar;
        $sandar->kapal_id = $kapal->id;
        $sandar->rangestart = $request->rangestart;
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->save();

        return redirect()->route('admin.index')->with('success','Berhasil Menambah Data');
    }

    public function update(Request $request, $id)
    {
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
        $kapal->save();
        
        $sandar = Sandar::where('kapal_id',$id)->first();
        $sandar->start = $request->start;
        $sandar->finish = $request->finish;
        $sandar->status = $request->status;
        $sandar->rangestart = $request->rangestart;
        $sandar->save();
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
}
