<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('karyawan.index', [
            'karyawan' => Karyawan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KaryawanStoreRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $file = $request->file('photo');
        $fileName = uniqid() . '' . $file->getClientOriginalExtension();
        $file->storeAs('public/photo', $fileName);

        //hanya menyimapan file namanya saja
        $data['photo'] = $fileName;
        Karyawan::create($data);

        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Karyawan::findOrFail($id);
        return view('karyawan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KaryawanStoreRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . ' ' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo/', $fileName);

            Storage::delete('public/photo/' . $request->oldPhoto);
            //hanya menyimapan file namanya saja
            $data['photo'] = $fileName;
        } else {
            $data['photo'] = $request->oldPhoto;
        }

        $data = Karyawan::findOrFail($id)->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Karyawan::findOrFail($id);
        Storage::delete('public/photo/' . $data->photo);
        $data->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Di Hapus');
    }
}
