<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matkul;
use App\Dosen;
use Illuminate\Support\Facades\DB;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = \App\Matkul::orderBy('semester', 'asc')->orderBy('nama', 'asc')->get();
        return view('matakuliah.index', ['matkul' => $matkul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matkul = DB::table('matkul')->get();
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('matakuliah.tambah', ['matkul' => $matkul]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'txtkode' => 'required',
                'txtmatakuliah' => 'required',
                'txtsemester' => 'required',
            ],
            [
                'txtkode.required' => 'Kode Harus Di Isi',
                'txtmatakuliah.required' => 'Mata kuliah Harus Di Isi',
                'txtsemester.required' => 'Semester Harus Di Isi',
            ]
        );

        $matkul = new Matkul([
            'kode' => $request->txtkode,
            'nama' => $request->txtmatakuliah,
            'semester' => $request->txtsemester,
        ]);
        $matkul->save();

        return redirect('/matakuliah')->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit(Matkul $matkul)
    {
        $matkul = Matkul::find($matkul->id);
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('matakuliah.edit', compact('matkul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matkul $matkul)
    {
        $request->validate(
            [
                'txtkode' => 'required',
                'txtmatakuliah' => 'required',
                'txtsemester' => 'required',
            ],
            [
                'txtkode.required' => 'Kode Tidak Boleh Kosong',
                'txtmatakuliah.required' => 'Mata kuliah Tidak Boleh Kosong',
                'txtsemester.required' => 'Semester Tidak Boleh Kosong',
            ]
        );

        $matkul = Matkul::find($matkul->id);
        $matkul->kode = $request->txtkode;
        $matkul->nama = $request->txtmatakuliah;
        $matkul->semester = $request->txtsemester;
        $matkul->save();

        // dd($request->all());
        return redirect('/matakuliah')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Matkul::destroy($id);
        return redirect('/matakuliah')->with('success', 'Data Berhasil Dihapus');
    }

    public function pengajarform(Matkul $matkul)
    {
        $matkul = Matkul::find($matkul->id);
        $dosen = Dosen::orderBy('nidn', 'asc')->get();
        return view('matakuliah.pengajar', ['matkul' => $matkul, 'dosen' => $dosen, 'dosen' => $dosen]);
    }
}
