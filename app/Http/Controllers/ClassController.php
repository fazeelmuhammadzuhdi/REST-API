<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ClassRoom::all();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button class="edit btn btn-sm btn-warning" id="' . $data->id . '" name="edit">Edit</button> ';
                    $button .= ' <button class="hapus btn btn-sm btn-danger" id="' . $data->id . '" name="hapus">Hapus</button> ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);;
        }
        return view('class');
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
        $simpan = ClassRoom::create($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Simpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Simpan'], 400);
        }
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
    public function edit(Request $request)
    {
        $data = ClassRoom::find($request->id);
        return response()->json($data);
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
        $data = ClassRoom::find($request->id);
        $simpan = $data->update($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Update'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Update'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = ClassRoom::findOrFail($request->id);
        $simpan = $data->delete($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Hapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Hapus'], 400);
        }
    }
}
