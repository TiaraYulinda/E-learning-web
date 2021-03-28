<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Dosen;
use App\Matkul;
use App\User;
use App\Semester;
use App\Kelas;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dosen = DB::table('dosen')->get();
        $dosen = \App\Dosen::orderBy('nama', 'asc')->get();
        return view('dosen.index', ['dosen' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.tambahdata');
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
                'txtnidn' => 'required|max:10|min:10|unique:dosen,nidn',
                'txtnama' => 'required',
                'txtemail' => 'required',
                'txtalamat' => 'required',
                'txtgender' => 'required',
                'txtagama' => 'required',
                'txttgl_lahir' => 'required',
                'txttempat_lahir' => 'required',
                'txtno_telpon' => 'required|numeric',
            ],
            [
                'txtnidn.required' => 'NIDN tidak boleh kosong',
                'txtnidn.unique' => 'NIDN sudah ada',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'Email tidak boleh kosong',
                'txtagama.required' => 'Agama tidak boleh kosong',
                'txtalamat.required' => 'Alamat tidak boleh kosong',
                'txtno_telpon.required' => 'No Telpon tidak boleh kosong',
                'txtno_telpon.numeric' => 'No Telpon harus berupa angka',
                'txttgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'txttempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'txtgender.required' => 'Gender tidak boleh kosong',
            ]
        );
        $user = new User([
            'role' => 'dosen',
            'username' => $request->txtnidn,
            'name' => $request->txtnama,
            'email' => $request->txtemail,
            'password' => bcrypt($request->txtnidn),
            'remember_token' => str::random(60),
        ]);
        $user->save();

        $dosen = new Dosen([
            'nidn' => $request->txtnidn,
            'nama' => $request->txtnama,
            'alamat' => $request->txtalamat,
            'gender' => $request->txtgender,
            'agama' => $request->txtagama,
            'tempat_lahir' => $request->txttempat_lahir,
            'tgl_lahir' => $request->txttgl_lahir,
            'email' => $request->txtemail,
            'no_telpon' => $request->txtno_telpon,
            'user_id' => $user->id,
        ]);
        $dosen->save();

        return redirect('/dosen')->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit(Dosen $dosen)
    {
        $user = User::find($dosen->id);
        return view('dosen.edit')->with('dosen', $dosen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate(
            [
                'txtnidn' => 'required|max:10|min:10|unique:dosen,nidn,' . $dosen->id,
                'txtnama' => 'required',
                'txtemail' => 'required',
                'txtalamat' => 'required',
                'txtgender' => 'required',
                'txtagama' => 'required',
                'txttgl_lahir' => 'required',
                'txttempat_lahir' => 'required',
                'txtno_telpon' => 'required|numeric',
                // 'txtpassword' => 'min:6',
            ],
            [
                'txtnidn.required' => 'NIDN tidak boleh kosong',
                'txtnidn.unique' => 'NIDN sudah ada',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'Email tidak boleh kosong',
                'txtagama.required' => 'Agama tidak boleh kosong',
                'txtalamat.required' => 'Alamat tidak boleh kosong',
                'txtno_telpon.required' => 'No Telpon tidak boleh kosong',
                'txtno_telpon.numeric' => 'No Telpon harus berupa angka',
                'txttgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'txttempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'txtgender.required' => 'Gender tidak boleh kosong',
                // 'txtpassword.min' => 'Password min harus 6 karakter',
            ]
        );

        $dosen = Dosen::find($dosen->id);
        $dosen->nidn = $request->txtnidn;
        $dosen->nama = $request->txtnama;
        $dosen->alamat = $request->txtalamat;
        $dosen->gender = $request->txtgender;
        $dosen->agama = $request->txtagama;
        $dosen->tempat_lahir = $request->txttempat_lahir;
        $dosen->tgl_lahir = $request->txttgl_lahir;
        $dosen->email = $request->txtemail;
        $dosen->no_telpon = $request->txtno_telpon;
        $dosen->save();

        $user = User::findOrFail($dosen->user->id);
        $input = $request->all();
        $user->fill([
            'username'           => $request->input('txtnidn'),
            'name'           => $request->input('txtnama'),
            'email'           => $request->input('txtemail'),
            'password' => $request->txtpassword ? bcrypt($request->txtpassword) : $user->password,
        ])->save();

        if ($request->hasFile('fotoprofile')) {
            $request->file('fotoprofile')->move('images/', $request->file('fotoprofile')->getClientOriginalName());
            $dosen->foto = $request->file('fotoprofile')->getClientOriginalName();
            $dosen->save();
        }
        // dd($request->all());
        return redirect('/dosen')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        $dosen->user()->delete();

        Dosen::destroy($dosen->id);
        return redirect('/dosen')->with('success', 'Data Berhasil Dihapus');
    }

    public function profile(Dosen $dosen)
    {
        return view('dosen.profile', compact('dosen'));
    }

    public function exportPdf()
    {
        $dosen = Dosen::orderBy('nidn', 'asc')->get();
        $pdf = PDF::loadView('export.dosenpdf', ['dosen' => $dosen])
            ->setPaper('a4', 'landscape');
        return $pdf->stream('dosen.pdf');
    }

    public function matakuliah(Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        $matkul = Matkul::orderBy('semester', 'asc')->get();
        $kelas = DB::table('dosen_matkul')
            ->join('matkul', 'dosen_matkul.matkul_id', '=', 'matkul.id')
            ->join('kelas', 'dosen_matkul.kelas_id', '=', 'kelas.id')
            ->select('dosen_matkul.*', 'matkul.semester', 'matkul.nama', 'kelas.nama_kelas')
            ->where('dosen_id', $dosen->id)
            ->get();
        // dd($dosen->matkul->kelas->nama_kelas);
        // dd($dosen);
        return view('dosen.matakuliah', ['dosen' => $dosen, 'matkul' => $matkul, 'kelas' => $kelas]);
    }

    public function tambahmatakuliahform(Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        $matkul = Matkul::orderBy('nama', 'asc')->get();
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        //compact('students'); karna nama tabel dan variabel $studenst sama
        return view('dosen.tambahmatakuliah', ['dosen' => $dosen, 'matkul' => $matkul, 'kelas' => $kelas]);
    }

    public function addmatakuliah(Request $request, Dosen $dosen)
    {
        // dd($request->all());
        $request->validate(
            [
                'txtmatkul' => 'required',
                'txtkelas' => 'required',
            ],
            [
                'txtmatkul.required' => 'Mata kuliah tidak boleh kosong',
                'txtkelas.required' => 'Kelas tidak boleh kosong',
            ]
        );
        $dosen = Dosen::find($dosen->id);
        $isi = $dosen->matkul()->where('matkul_id', $request->txtmatkul)->where('kelas_id', $request->txtkelas)->exists();
        if ($isi == true) {
            return redirect()->back()->with('error', 'Mata kuliah dan kelas yang sama sudah ditambahkan');
        }
        // dd($isi);
        foreach ($request->txtkelas as $kelas) {
            $dosen->matkul()->attach($request->txtmatkul, ['kelas_id' => $kelas]);
        }
        return redirect('dosen/' . $dosen->id . '/matakuliah')->with('success', 'Mata kuliah berhasil ditambah');
    }

    public function hapusmatkul($id)
    {
        $user = DB::table('dosen_matkul')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('dosen', 'dosen.id', '=', 'dosen_matkul.dosen_id')
            ->join('matkul', 'matkul.id', '=', 'dosen_matkul.matkul_id')
            ->select('matkul.*', 'dosen_matkul.*')
            ->where('dosen_matkul.id', '=', $id)
            ->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus');
    }

    public function editmatkul($id)
    {
        $user = DB::table('dosen_matkul')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('dosen', 'dosen.id', '=', 'dosen_matkul.dosen_id')
            ->join('matkul', 'matkul.id', '=', 'dosen_matkul.matkul_id')
            ->select('matkul.*', 'dosen_matkul.*')
            ->where('dosen_matkul.id', '=', $id)
            ->get();
        return view('dosen.editmatkul',  compact('user'));
    }
}
