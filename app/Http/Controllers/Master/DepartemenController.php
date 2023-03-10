<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departemen;
use App\Models\Divisi;

class DepartemenController extends Controller
{
    public function index(){
        $departemens = Departemen::OrderBy('nama_departemen', 'ASC')->get();
        $divisis = Divisi::OrderBy('nama_divisi', 'ASC')->get();
        return view('master.departemen', compact('departemens','divisis'));
    }

    public function store(Request $request){
        $departemen = new Departemen;
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->kode_departemen = $request->kode_departemen;
        $departemen->divisi_id      = $request->divisi_id;
        $departemen->status         = $request->status;
        $departemen->save();

        return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $departemen = Departemen::find($id);
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->kode_departemen = $request->kode_departemen;
        $departemen->divisi_id       = $request->divisi_id;
        $departemen->status = $request->status;
        $departemen->save();

        return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil diupdate');
    }

    // public function destroy($id){
    //     $departemen = Departemen::find($id);
    //     $departemen->delete();

    //     return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil dihapus');
    // }
}
