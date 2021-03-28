<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Kelas;
use App\Tugas;
use App\Materi;
use App\Matkul;
use App\Dosen;
use PDF;
use App\TugasMahasiswa;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'dosen') {
            $today = date('Y-m-d H:i:s');
            $tugas = Tugas::where('tanggal_deadline', '<', $today)->update(['status_tugas' => 0]);
            $jawaban = TugasMahasiswa::where('status', 0)->orderBy('created_at', 'desc')->get();

            $tugas = Tugas::where('user_dsn_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('tugas.index', ['tugas' => $tugas, 'jawaban' => $jawaban]);
        } else {
            $today = date('Y-m-d H:i:s');
            $tugas = Tugas::where('tanggal_deadline', '<', $today)->update(['status_tugas' => 0]);

            $tugas = Tugas::where('status_tugas', 1)->orderBy('created_at', 'desc')->get();

            return view('tugasmahasiswa.index', ['tugas' => $tugas]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        // dd($dosen);
        $matkul = DB::table('dosen_matkul')
            ->join('matkul', 'dosen_matkul.matkul_id', '=', 'matkul.id')
            ->select('dosen_matkul.matkul_id', 'matkul.nama', 'matkul.id')
            ->where('dosen_id', $dosen->id)
            ->groupBy('matkul_id')->get();

        return view('tugas.tambahtugas', ['dosen' => $dosen, 'kelas' => $kelas, 'matkul' => $matkul]);
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
                'txtmatkul' => 'required',
                'txtkelas' => 'required',
                'txttgl_deadline' => 'required',
                'txtjudul' => 'required',
                'txtsoal' => 'required',
                // 'txtsemester' => 'required',
            ],
            [
                'txtmatkul.required' => 'Matakuliah Harus Di Isi',
                'txtkelas.required' => 'Kelas Harus Di Isi',
                'txtjudul.required' => 'Judul tidak boleh kosong',
                'txtsoal.required' => 'Soal tidak boleh kosong',
                // 'txtsemester.required' => 'Semester tidak boleh kosong',
                'txttgl_deadline.required' => 'Pilih tanggal deadline',
            ]
        );


        foreach ($request->txtkelas as $kelas) {
            $tugas = Tugas::create([
                'matkul_id' => $request->txtmatkul,
                'kelas_id' => $kelas,
                'tanggal_deadline' => $request->txttgl_deadline,
                'judul_tugas' => $request->txtjudul,
                'soal_tugas' => $request->txtsoal,
                'user_dsn_id' => $request->txtdosen_id,
                'tipe' => $request->txttipe,
                'status_tugas' => 1,
            ]);
        }
        $tugas->save();

        return redirect('/tugas')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tugas $tugas)
    {
        //lihat detail tugas
        $jawaban = DB::table('jawaban')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        $kelas = DB::table('kelas')->get();
        $matkul = DB::table('matkul')->get();
        $tugas = Tugas::find($tugas->id);
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('tugas.detail', compact('tugas', 'matkul', 'kelas', 'jawaban', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tugas)
    {

        $kelas = DB::table('kelas')->get();
        $dosen = Dosen::find(Auth::user()->dosen->id);
        $matkul = Matkul::orderBy('semester', 'asc')->get();
        // $dosen = Dosen::Where('user_id', Auth::user()->id)->get();
        $tugas = Tugas::find($tugas->id);
        // dd($dosen->nama);
        return view('tugas.edit', ['dosen' => $dosen, 'matkul' => $matkul, 'kelas' => $kelas, 'tugas' => $tugas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas)
    {
        // dd($request->txtkelas);
        $request->validate(
            [
                'txtmatkul' => 'required',
                'txtkelas' => 'required',
                // 'txtsemester' => 'required',
                'txttgl_deadline' => 'required',
                'txtsoal' => 'required',
                'txtjudul' => 'required',
            ],
            [
                'txtmatkul.required' => 'Matakuliah Harus Diisi',
                'txtkelas.required' => 'Kelas Harus Diisi',
                // 'txtsemester.required' => 'Semester Harus Diisi',
                'txtsoal.required' => 'Soal Tidak Boleh Kosong',
                'txtjudul.required' => 'Judul Tidak Boleh Kosong',
                'txttgl_deadline.required' => 'Silahkan tentukan batas pengerjaan',
            ]
        );

        $tugas = Tugas::find($tugas->id);
        $tugas->matkul_id = $request->txtmatkul;
        // $tugas->semester = $request->txtsemester;
        $tugas->kelas_id = $request->txtkelas;
        $tugas->tanggal_deadline = $request->txttgl_deadline;
        $tugas->soal_tugas = $request->txtsoal;
        $tugas->judul_tugas = $request->txtjudul;

        if ('txttgl_deadline' != $tugas->tanggal_deadline && 'txttgl_deadline' > $tugas->tanggal_deadline) {
            $tugas->status_tugas = 1;
        }

        $tugas->save();
        // dd($request->all());
        return redirect('/tugas')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas)
    {

        tugas::destroy($tugas->id);

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function destroymateri(Materi $materi)
    {

        materi::destroy($materi->id);

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function createUpload(Dosen $dosen)
    {
        // dd($dosen);

        $dosen = Dosen::find($dosen->id);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        // dd($dosen);
        $matkul = DB::table('dosen_matkul')
            ->join('matkul', 'dosen_matkul.matkul_id', '=', 'matkul.id')
            ->select('dosen_matkul.matkul_id', 'matkul.nama', 'matkul.id')
            ->where('dosen_id', $dosen->id)
            ->groupBy('matkul_id')->get();

        return view('tugas.uploadtugas', ['dosen' => $dosen, 'matkul' => $matkul, 'kelas' => $kelas]);
    }

    public function uploadfile(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'txtmatkul' => 'required',
                'txtkelas' => 'required',
                // 'txtsemester' => 'required',
                'txttgl_deadline' => 'required',
                'txtjudul_tugas' => 'required',
                'txtuploadtugas' =>  'required|file|mimes:jpg,png,jpeg,pdf,doc,docx|max:2048',
            ],
            [
                'txtmatkul.required' => 'Matakuliah tidak boleh kosong',
                'txtkelas.required' => 'Kelas tidak boleh kosong',
                // 'txtsemester.required' => 'Semester tidak boleh kosong',
                'txtjudul_tugas.required' => 'Judul tidak boleh kosong',
                'txtuploadtugas.required' => 'File tidak boleh kosong',
                'txtuploadtugas.mimes' => 'Format file harus pdf,doc.',
                'txtuploadtugas.max' => 'File max:2048',
                'txttgl_deadline.required' => 'Deadline tidak boleh kosong',
            ]
        );

        foreach ($request->txtkelas as $kelas) {
            $tugas = Tugas::create([
                'matkul_id' => $request->txtmatkul,
                'kelas_id' => $kelas,
                'tanggal_deadline' => $request->txttgl_deadline,
                'judul_tugas' => $request->txtjudul_tugas,
                'user_dsn_id' => $request->txtdosen_id,
                'soal_tugas' => $request->txtuploadtugas,
                'tipe' => $request->txttipe,
                'status_tugas' => 1,
            ]);
        }

        if ($request->hasFile('txtuploadtugas')) {
            $request->file('txtuploadtugas')->move('file_tugas/', $request->file('txtuploadtugas')->getClientOriginalName());
            $tugas->soal_tugas = $request->file('txtuploadtugas')->getClientOriginalName();
            $tugas->save();
        }

        $tugas->save();
        // dd($request->all());

        return redirect('/tugas')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function editfile(Tugas $tugas)
    {
        $kelas = DB::table('kelas')->get();
        $matkul = DB::table('matkul')->get();
        $tugas = Tugas::find($tugas->id);
        // $kelas = Kelas::table('nama_kelas', 'id')->get();
        return view('tugas.editfiletugas', compact('tugas', 'matkul', 'kelas'));
    }

    public function updatefile(Request $request, Tugas $tugas)
    {
        $request->validate(
            [
                'txtmatkul' => 'required',
                'txtkelas' => 'required',
                'txtjudul_tugas' => 'required',
                'txttgl_deadline' => 'required',
                'txtuploadtugas' =>  'file|mimes:jpg,png,jpeg,pdf,doc,docx|max:2048',
            ],
            [
                'txtmatkul.required' => 'Matakuliah tidak boleh kosong',
                'txtkelas.required' => 'Kelas tidak boleh kosong',
                'txtjudul_tugas.required' => 'Judul tidak boleh kosong',
                'txtuploadtugas.required' => 'File tidak boleh kosong',
                'txtuploadtugas.mimes' => 'Format file harus pdf,doc.',
                'txttgl_deadline.required' => 'Silahkan tentukan batas pengerjaan',
                'txttgl_deadline.max' => 'Ukuran max 2 mb',
            ]
        );

        $tugas = Tugas::find($tugas->id);
        $tugas->matkul_id = $request->txtmatkul;
        $tugas->kelas_id = $request->txtkelas;
        $tugas->tanggal_deadline = $request->txttgl_deadline;
        $tugas->judul_tugas = $request->txtjudul_tugas;
        $tugas->status_tugas = 1;

        $tugas->save();

        if ($request->hasFile('txtuploadtugas')) {
            $request->file('txtuploadtugas')->move('file_tugas/', $request->file('txtuploadtugas')->getClientOriginalName());
            $tugas->soal_tugas = $request->file('txtuploadtugas')->getClientOriginalName();
            $tugas->save();
        } else  if ('txttgl_deadline' != $tugas->tanggal_deadline && 'txttgl_deadline' > $tugas->tanggal_deadline) {
            $tugas->status_tugas = 1;
        }
        $tugas->save();

        // if ('txttgl_deadline' != $tugas->tanggal_deadline && 'txttgl_deadline' > $tugas->tanggal_deadline) {
        //     $tugas->status_tugas = 1;
        // }
        // dd($request->all());
        return redirect('/tugas')->with('success', 'Data berhasil diubah');
    }

    public function daftarMahasiswa(Tugas $tugas)
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('nama', 'asc')->get();
        $user = DB::table('users')->get();
        $kelas = DB::table('kelas')->get();
        $matkul = DB::table('matkul')->get();
        $tugas = Tugas::find($tugas->id);
        $jawaban = TugasMahasiswa::withTrashed()->where('tugas_id', $tugas->id)->orderBy('created_at', 'desc')->get();

        // dd($jawaban->jawaban);
        // return view('tugas.daftarmahasiswa', ['jawaban' => $jawaban], ['users' => $user]);
        return view('tugas.daftarmahasiswa', compact('jawaban', 'user', 'tugas'));
    }

    public function jawabanMahasiswa($id)
    {
        $jawaban = TugasMahasiswa::where('id', $id)->where('status', 0)->update(['status' => 1]);
        $jawaban = TugasMahasiswa::withTrashed()->find($id);
        $jawaban->status = 1;
        $jawaban->save();
        // if ($jawaban == true) {
        // }
        // $jawaban = TugasMahasiswa::withTrashed()->get();

        // dd($jawaban->jawaban);
        return view('tugas.jawaban', compact('jawaban'));
    }

    public function jawabanpdf(Tugas $tugas)
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('nama', 'asc')->get();
        $user = DB::table('users')->get();
        $kelas = DB::table('kelas')->get();
        $matkul = DB::table('matkul')->get();
        $tugas = Tugas::find($tugas->id);
        $jawaban = TugasMahasiswa::withTrashed()->where('tugas_id', $tugas->id)->orderBy('created_at', 'desc')->get();
        // dd($jawaban);
        $user = DB::table('users')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
            ->select('tugas.*', 'jawaban.*', 'mahasiswa.*')
            ->where('mahasiswa.kelas_id', '=', 1)
            ->where('jawaban.tugas_id', '=', $tugas->id)
            ->get();
        $jumA = count($user);

        $user = DB::table('users')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
            ->select('tugas.*', 'jawaban.*', 'mahasiswa.*')
            ->where('mahasiswa.kelas_id', '=', 2)
            ->where('jawaban.tugas_id', '=', $tugas->id)
            ->get();
        $jumB = count($user);

        $user = DB::table('users')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
            ->select('tugas.*', 'jawaban.*', 'mahasiswa.*')
            ->where('mahasiswa.kelas_id', '=', 3)
            ->where('jawaban.tugas_id', '=', $tugas->id)
            ->get();
        $jumC = count($user);

        $user = DB::table('users')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
            ->select('tugas.*', 'jawaban.*', 'mahasiswa.*')
            ->where('mahasiswa.kelas_id', '=', 4)
            ->where('jawaban.tugas_id', '=', $tugas->id)
            ->get();
        $jumD = count($user);

        // dd($jum);
        $pdf = PDF::loadView('export.jawabanpdf', compact('jawaban', 'user', 'tugas', 'jumA', 'jumB', 'jumC', 'jumD'));
        // ->setPaper('a4', 'landscape');
        return $pdf->stream('jawaban.pdf');

        // return view('export.jawabanpdf', compact('jawaban', 'user', 'tugas'));
    }

    public function matakuliah(Dosen $dosen)
    {
        $dosen = Dosen::find(Auth::user()->dosen->id);
        // $matkul = Matkul::orderBy('semester', 'asc')->get();
        // $dosen = Dosen::find($dosen->id);
        $matkul = Matkul::orderBy('semester', 'asc')->get();
        $kelas = DB::table('dosen_matkul')
            ->join('matkul', 'dosen_matkul.matkul_id', '=', 'matkul.id')
            ->join('kelas', 'dosen_matkul.kelas_id', '=', 'kelas.id')
            ->select('dosen_matkul.*', 'matkul.id', 'matkul.semester', 'matkul.nama', 'kelas.nama_kelas')
            ->where('dosen_id', $dosen->id)
            ->orderBy('matkul_id', 'desc')->orderBy('kelas_id', 'asc')
            ->get();
        // dd($dosen);
        return view('tugas.matakuliah', ['dosen' => $dosen, 'matkul' => $matkul, 'kelas' => $kelas]);
    }

    public function tugas(Matkul $matkul)
    {
        // dd($matkul->id);
        $today = date('Y-m-d H:i:s');
        $tugas = Tugas::where('tanggal_deadline', '<', $today)->update(['status_tugas' => 0]);
        $jawaban = TugasMahasiswa::where('status', 0)->orderBy('created_at', 'desc')->get();

        $matkul = Matkul::find($matkul->id);
        $tugas = Tugas::where('matkul_id', $matkul->id)->orderBy('created_at', 'desc')->get();
        // dd($tugas);

        // $tugas = Tugas::where('user_dsn_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('tugas.tugaspermatkul', ['tugas' => $tugas, 'jawaban' => $jawaban]);
    }

    public function tugasMahasiswa()
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('nama', 'asc')->get();
        $kelas = DB::table('kelas')->get();
        $tugas = DB::table('tugas')->where('user_dsn_id', Auth::user()->id)->get('id');
        // $jwb = $tugas->jawaban->get();
        $jawaban = TugasMahasiswa::where('tugas_id', $tugas->id)->orderBy('created_at', 'desc')->get();
        dd($jawaban);
        // return view('tugas.daftarmahasiswa', ['jawaban' => $jawaban], ['users' => $user]);
        return view('tugas.tugasMahasiswa', compact('tugas'));
    }

    public function materi(Matkul $matkul)
    {
        // $materi = Materi::find($matkul->id);
        $materi = Materi::where('matkul_id', $matkul->id)->get();
        // dd($materi);
        return view('tugas.materi', compact('matkul', 'materi'));
    }

    public function formtambahmateri(Matkul $matkul)
    {
        $matkul = Matkul::find($matkul->id);
        return view('tugas.tambahmateri', compact('matkul'));
        // return view('tugas.tambahmateri');
    }

    public function uploadmateri(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'txtmateri' => 'required|max:20000'
        ]);

        if ($request->hasFile('txtmateri')) {
            $files = $request->file('txtmateri');
            foreach ($files as $file) {
                $file->move('file_materi/', $file->getClientOriginalName());
                Materi::create([
                    'dosen_id' => $request->txtdosen_id,
                    'matkul_id' => $request->txtmatkul_id,
                    'materi' => $file->getClientOriginalName()
                ]);
            }
        }
        return redirect('/dashboard')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function downloadmateri(Materi $materi)
    {
        $materi = Materi::find($materi->id);
        // dd($materi->materi);
        return Storage::download('file_materi/', $materi->materi);
    }
}
