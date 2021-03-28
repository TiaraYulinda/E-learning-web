<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Exports\MahasiswaExport;
use App\Http\Requests\UserRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


// use App\Student; //untuk model

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //menampilkan semua data mahasiswa
    public function index(Mahasiswa $mahasiswa)
    {


        //pakai eliquo
        $mahasiswa = \App\Mahasiswa::orderBy('semester', 'asc')->orderBy('nama', 'asc')->get();
        // $mahasiswa = Mahasiswa::all(); //Student = model
        //(folder, file), parameter
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kelas = DB::table('kelas')->get();
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('mahasiswa.tambahdata', ['kelas' => $kelas]);
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
                'txtnpm' => 'required|min:10|unique:mahasiswa,npm',
                'txtnama' => 'required',
                'txtemail' => 'required',
                'txtagama' => 'required',
                'txtalamat' => 'required',
                'txttgl_lahir' => 'required',
                'txttempat_lahir' => 'required',
                'txtno_telpon' => 'required|numeric',
                'txtjurusan' => 'required',
                'txtsemester' => 'required',
                'txtgender' => 'required',
            ],
            [
                'txtnpm.required' => 'NPM tidak boleh kosong',
                'txtnpm.unique' => 'NPM sudah ada',
                'txttgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'txttempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'Email tidak boleh kosong',
                'txtagama.required' => 'Agama tidak boleh kosong',
                'txtalamat.required' => 'Alamat tidak boleh kosong',
                'txtno_telpon.required' => 'No Telpon tidak boleh kosong',
                'txtno_telpon.numeric' => 'No Telpon harus berupa angka',
                'txtjurusan.required' => 'Jurusan tidak boleh kosong',
                'txtsemester.required' => 'Semester tidak boleh kosong',
                'txtgender.required' => 'Gender tidak boleh kosong',
            ]
        );
        $user = new User([
            'role' => 'mahasiswa',
            'username' => $request->txtnpm,
            'name' => $request->txtnama,
            'email' => $request->txtemail,
            'password' => bcrypt($request->txtnpm),
            'remember_token' => str::random(60),
        ]);
        $user->save();

        $mahasiswa = new Mahasiswa([
            'npm' => $request->txtnpm,
            'nama' => $request->txtnama,
            'alamat' => $request->txtalamat,
            'gender' => $request->txtgender,
            'agama' => $request->txtagama,
            'tempat_lahir' => $request->txttempat_lahir,
            'tgl_lahir' => $request->txttgl_lahir,
            'email' => $request->txtemail,
            'no_telpon' => $request->txtno_telpon,
            'kelas_id' => $request->txtkelas,
            'jurusan' => $request->txtjurusan,
            'semester' => $request->txtsemester,
            'user_id' => $user->id,
        ]);
        $mahasiswa->save();

        return redirect('/mahasiswa')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //menampilkan detail mahasiswa
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $user = User::find($mahasiswa->id);
        $kelas = DB::table('kelas')->get();
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate(
            [
                'txtnpm' => 'required|min:10|unique:mahasiswa,npm,' . $mahasiswa->id,
                'txtnama' => 'required',
                'txtemail' => 'required',
                'txtagama' => 'required',
                'txtalamat' => 'required',
                'txttgl_lahir' => 'required',
                'txttempat_lahir' => 'required',
                'txtno_telpon' => 'required|numeric',
                'txtjurusan' => 'required',
                'txtsemester' => 'required',
                'txtgender' => 'required',
            ],
            [
                'txtnpm.required' => 'NPM tidak boleh kosong',
                'txtnpm.unique' => 'NPM sudah ada',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'Email tidak boleh kosong',
                'txtagama.required' => 'Agama tidak boleh kosong',
                'txtalamat.required' => 'Alamat tidak boleh kosong',
                'txtno_telpon.required' => 'No Telpon tidak boleh kosong',
                'txtno_telpon.numeric' => 'No Telpon harus berupa angka',
                'txttgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'txttempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'txtjurusan.required' => 'Jurusan tidak boleh kosong',
                'txtsemester.required' => 'Semester tidak boleh kosong',
                'txtgender.required' => 'Gender tidak boleh kosong',
            ]
        );

        $mahasiswa = Mahasiswa::find($mahasiswa->id);
        $mahasiswa->npm = $request->txtnpm;
        $mahasiswa->nama = $request->txtnama;
        $mahasiswa->email = $request->txtemail;
        $mahasiswa->jurusan = $request->txtjurusan;
        $mahasiswa->semester = $request->txtsemester;
        $mahasiswa->alamat = $request->txtalamat;
        $mahasiswa->gender = $request->txtgender;
        $mahasiswa->agama = $request->txtagama;
        $mahasiswa->tempat_lahir = $request->txttempat_lahir;
        $mahasiswa->tgl_lahir = $request->txttgl_lahir;
        $mahasiswa->no_telpon = $request->txtno_telpon;
        $mahasiswa->kelas_id = $request->txtkelas;
        $mahasiswa->save();

        $user = User::findOrFail($mahasiswa->user->id);
        $input = $request->all();
        $user->fill([
            'username'           => $request->input('txtnpm'),
            'name'           => $request->input('txtnama'),
            'email'           => $request->input('txtemail'),
            'password' => $request->txtpassword ? bcrypt($request->txtpassword) : $user->password,
        ])->save();

        // dd($request->all());
        return redirect('/mahasiswa')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($mahasiswa->id);
        $mahasiswa->user()->delete();

        // Mahasiswa::destroy($mahasiswa->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function profile(Mahasiswa $mahasiswa)
    {
        $user = User::find($mahasiswa->id);
        $kelas = DB::table('kelas')->get();
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('mahasiswa.profile', ['mahasiswa' => $mahasiswa, 'kelas' => $kelas]);
        // return view('mahasiswa.profile', compact('mahasiswa'));
    }

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function exportPdf($id)
    {
        $mahasiswa = Mahasiswa::where('semester', $id)
            ->orderBy('kelas_id', 'ASC')->get();
        $pdf = PDF::loadView('export.mahasiswapdf', ['mahasiswa' => $mahasiswa])
            ->setPaper('a4', 'landscape');
        return $pdf->stream('mahasiswa.pdf');
    }

    public function exportAllPdf()
    {
        $mahasiswa = Mahasiswa::orderBy('semester', 'ASC')->orderBy('kelas_id', 'ASC')->orderBy('nama', 'ASC')->get();
        // dd($mahasiswa);
        $pdf = PDF::loadView('export.mahasiswapdf', ['mahasiswa' => $mahasiswa])
            ->setPaper('a4', 'landscape');
        return $pdf->stream('mahasiswa.pdf');
    }

    public function laporan()
    {
        return view('mahasiswa.semester');
    }
}
