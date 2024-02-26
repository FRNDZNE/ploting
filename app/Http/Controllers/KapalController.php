<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kapal;
use Image;

class KapalController extends Controller
{

    // get method
    public function index()
    {
        $isDeleted = false;
        $data = Kapal::all();
        return view('admin.kapal.index',compact('isDeleted','data'));
    }

    public function history()
    {
        $isDeleted = true;
        $data = Kapal::onlyTrashed()->get();
        return view('admin.kapal.index',compact('isDeleted','data'));
    }

    public function create()
    {
        $isCreate = true;
        return view('admin.kapal.form',compact('isCreate'));
    }

    public function edit($id)
    {
        $isCreate = false;
        $data = Kapal::where('id',$id)->first();
        return view('admin.kapal.form',compact('data','isCreate'));
    }

    // Post Method

    public function store(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'nama' => ucfirst('nama'),
            'panjang' => ucfirst('panjang'),
            'foto' => ucfirst('foto'),
        ];

        $request->validate([
            'nama' => 'required',
            'panjang' => 'required',
            'foto' => 'required',
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
        $kapal->save();

        return redirect()->route('admin.kapal.index')->with('success','Berhasil Menambah Kapal');
    }

    public function update($id, Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'nama' => ucfirst('nama'),
            'panjang' => ucfirst('panjang'),
        ];

        $request->validate([
            'nama' => 'required',
            'panjang' => 'required',
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
        $kapal->save();
        
        return redirect()->route('admin.kapal.index')->with('success','Berhasil Update Kapal');
    }

    public function delete($id)
    {
        Kapal::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Kapal');
    }

    public function restore($id)
    {
        Kapal::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Berhasil Restore Kapal');
    }

    public function destroy($id)
    {
        $kapal = Kapal::withTrashed()->where('id',$id)->first();
        if (file_exists($kapal->foto)) {
            unlink($kapal->foto);
        }
        $kapal->forceDelete();
        return redirect()->back()->with('success','Berhasil Hapus Permanen Kapal');
    }
}
