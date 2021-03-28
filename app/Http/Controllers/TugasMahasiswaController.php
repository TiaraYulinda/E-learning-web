<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tugas;
use App\Mahasiswa;
use App\Dosen;
use App\User;
use App\Materi;
use App\Matkul;
use App\TugasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
// use Nexmo\Laravel\Facade\Nexmo;

class TugasMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d H:i:s');
        $tugas = Tugas::where('tanggal_deadline', '<', $today)->update(['status_tugas' => 0]);

        $tugas = Tugas::where('status_tugas', 1)->orderBy('created_at', 'desc')->get();

        return view('tugasmahasiswa.index', ['tugas' => $tugas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tugas $tugas)
    {
        $isi = TugasMahasiswa::where('tugas_id', $tugas->id)->where('user_mhs_id', auth()->user()->id)->exists();
        if ($isi == true) {
            return redirect()->back()->with('status', 'Tugas sudah di jawab, Silahkan lihat jawaban');
        }

        $mahasiswa = DB::table('mahasiswa')->get();
        $tugas = Tugas::find($tugas->id);

        return view('tugasmahasiswa.kerjakantugas', compact('tugas', 'mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'txtjawaban' => 'required',
                'txtjudul' => 'required',
            ],
            [
                'txtjawaban.required' => 'Jawaban Tidak Boleh Kosong',
                'txtjudul.required' => 'Judul Tidak Boleh Kosong',
            ]
        );

        $jawaban = new TugasMahasiswa([
            'tugas_id' => $request->txttugas_id,
            'user_mhs_id' => $request->txtmahasiswa_id,
            'jawaban' => $request->txtjawaban,
            'judul' => $request->txtjudul,
            'tipe' => $request->txttipe,
        ]);
        // dd($request->all());
        $jawaban->save();

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $tugas = Tugas::where('id', $request->txttugas_id)->first();
        $dosen = Dosen::where('user_id', $tugas->user_dsn_id)->first();

        $response = Curl::to('https://panel.rapiwha.com/send_message.php')
            ->withData(array(
                'apikey' => 'V5LQA7QW626F8XMEOIKP',
                'number' => $dosen->no_telpon,
                'text' => "Hallo, Mahasiswa bernama $mahasiswa->nama npm $mahasiswa->npm telah mengisi tugas $tugas->judul, segera cek e-learning https://e-learning",
            ))
            ->post();

        return redirect('/tugasmahasiswa')->with('success', 'Jawaban Sudah Terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tugas $tugas)
    {
        // $isi = TugasMahasiswa::where('tugas_id', $tugas)->where('user_mhs_id', auth()->user()->id)->exists();
        $kelas = DB::table('kelas')->get();
        $dosen = DB::table('dosen')->get();
        $matkul = DB::table('matkul')->get();
        $tugas = Tugas::find($tugas->id);
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('tugasmahasiswa.detail', compact('tugas', 'matkul', 'kelas', 'dosen'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TugasMahasiswa::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function jawaban()
    {
        $kelas = DB::table('kelas')->get();
        $users = DB::table('users')->get();
        $matkul = DB::table('matkul')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        // $tugas = DB::table('tugas')->get();
        $jawaban = TugasMahasiswa::where('user_mhs_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        // $d = $jawaban->tugas()->withTrashed()->get();
        // dd($d);
        return view('tugasmahasiswa.jawaban', compact('mahasiswa', 'matkul', 'kelas', 'users', 'jawaban'));
    }

    public function lihatjawaban(TugasMahasiswa $jawaban)
    {
        // $tugas = DB::table('tugas_essay')->get();
        $jawaban = TugasMahasiswa::find($jawaban->id);
        // dd($tugasMahasiswa->all());

        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('tugasmahasiswa.lihatjawaban', compact('jawaban'));
    }

    public function createUpload(Tugas $tugas)
    {
        $isi = TugasMahasiswa::where('tugas_id', $tugas->id)->where('user_mhs_id', auth()->user()->id)->exists();
        if ($isi == true) {
            return redirect()->back()->with('info', 'Tugas sudah di jawab, Silahkan lihat jawaban');
        }

        $mahasiswa = DB::table('mahasiswa')->get();
        $tugas = Tugas::find($tugas->id);

        return view('tugasmahasiswa.uploadjawaban', compact('tugas', 'mahasiswa'));
    }

    public function uploadfile(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'txtfilejawaban' => 'required|file|mimes:jpeg,png,jpg,pdf,docx|max:2048',
                'txtjudul' => 'required',
            ],
            [
                'txtfilejawaban.required' => 'File tidak boleh kosong',
                'txtuploadtugas.mimes' => 'Format file harus pdf,doc.',
                'txtuploadtugas.max' => 'Ukuran file max:2048',
                'txtjudul.required' => 'Judul Tidak Boleh Kosong',

            ]
        );

        $upload_jawaban = new TugasMahasiswa([
            'tugas_id' => $request->txttugas_id,
            'user_mhs_id' => $request->txtmahasiswa_id,
            'jawaban' => $request->txtfilejawaban,
            'judul' => $request->txtjudul,
            'tipe' => $request->txttipe,
        ]);
        $upload_jawaban->save();

        if ($request->hasFile('txtfilejawaban')) {
            $request->file('txtfilejawaban')->move('file_jawaban/', $request->file('txtfilejawaban')->getClientOriginalName());
            $upload_jawaban->jawaban = $request->file('txtfilejawaban')->getClientOriginalName();
            $upload_jawaban->save();
        }

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $tugas = Tugas::where('id', $request->txttugas_id)->first();
        $dosen = Dosen::where('user_id', $tugas->user_dsn_id)->first();

        $response = Curl::to('https://panel.rapiwha.com/send_message.php')
            ->withData(array(
                'apikey' => 'V5LQA7QW626F8XMEOIKP',
                'number' => $dosen->no_telpon,
                'text' => "Hallo, Mahasiswa bernama $mahasiswa->nama npm $mahasiswa->npm telah mengisi tugas $tugas->judul, segera cek e-learning https://e-learning",
            ))
            ->post();

        return redirect('tugasmahasiswa/jawaban')->with('success', 'Jawaban Berhasil Diupload');
    }

    public function tugasDosen(User $user)
    {
        $today = date('Y-m-d H:i:s');
        $tugas = Tugas::where('tanggal_deadline', '<', $today)->update(['status_tugas' => 0]);

        $tugas = Tugas::where('user_dsn_id', $user->id)->where('status_tugas', 1)->orderBy('created_at', 'desc')->get();
        $dosen = Dosen::where('user_id', $user->id)->first();
        // dd($dosen->nama);
        return view('tugasmahasiswa.tugasDosen', compact('tugas', 'user', 'dosen'));
    }

    public function matkul()
    {
        $matkul = Matkul::orderBy('semester', 'asc')->get();

        return view('tugasmahasiswa.matkul', compact('matkul'));
    }

    public function dosen(Matkul $matkul)
    {
        $matkul = Matkul::find($matkul->id);
        // $dosen = Dosen::get();
        $dosen = DB::table('dosen_matkul')
            ->join('dosen', 'dosen_matkul.dosen_id', '=', 'dosen.id')
            ->select('dosen_matkul.*', 'dosen.nama', 'dosen.nidn')
            ->where('matkul_id', $matkul->id)
            ->groupBy('dosen_id')->get();

        return view('tugasmahasiswa.matkul_dosen', compact('matkul', 'dosen'));
    }

    public function materi(Matkul $matkul, Dosen $dosen)
    {
        $matkul = Matkul::find($matkul->id);
        $dosen = Dosen::find($dosen->id);
        $materi = Materi::where('dosen_id', $dosen->id)->where('matkul_id', $matkul->id)->get();
        // dd($dosen->id);
        return view('tugasmahasiswa.materi', compact('matkul', 'materi'));
    }
}
