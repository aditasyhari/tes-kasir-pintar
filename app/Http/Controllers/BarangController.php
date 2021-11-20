<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barang = app('firebase.firestore')->database()->collection('Barang')->documents();
        return view('barang.barang', compact(['barang']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
        ]);

        $barangRef = app('firebase.firestore')->database()->collection('Barang')->newDocument();
        $barangRef->set([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal'    => $request->tanggal,
        ]);     

        return back()->with('status', 'Data berhasil disimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $data = Pangkat::find($id);
        $barang = app('firebase.firestore')->database()->collection('Barang')->document($id)->snapshot();
        // dd($barang->data());
 
        $html = '<div class="form-group">
                    <input type="hidden" class="form-control" name="id" value="'.$barang->id().'" required>
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" id="nama-barang" value="'.$barang->data()["nama_barang"].'" required>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" value="'.$barang->data()["jumlah"].'" required>
                </div>
                <div class="form-group form-check">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="'.$barang->data()["tanggal"].'" required>
                </div>';
 
        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $barang = app('firebase.firestore')->database()->collection('Barang')->document($request->id)
        ->update([
            ['path' => 'nama_barang', 'value' => $request->nama_barang],
            ['path' => 'jumlah', 'value' => $request->jumlah],
            ['path' => 'tanggal', 'value' => $request->tanggal],
        ]);
        return back()->with('status', 'Data berhasil diperbarui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        app('firebase.firestore')->database()->collection('Barang')->document($id)->delete();
        return response()->json(['success'=>'berhasil di hapus']);
        // return back();
    }
}
