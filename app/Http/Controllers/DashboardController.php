<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\TugasMahasiswa;
use App\Tugas;
use App\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = DB::table('dosen')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        $matkul = DB::table('matkul')->get();
        $jwb = DB::table('jawaban')->where('user_mhs_id', Auth::user()->id)->where('deleted_at', null)->get();
        $tugas = Tugas::where('user_dsn_id', Auth::user()->id)->get();
        $jawaban = TugasMahasiswa::where('status', 1)->get();
        $count = count($tugas);
        $mhs = count($mahasiswa);
        $dsn = count($dosen);
        $mtk = count($matkul);
        $jawab = count($jwb);
        $user = DB::table('users')
            // ->join('users', 'jawaban.user_mhs_id','=', 'users.id')
            ->join('jawaban', 'users.id', '=', 'jawaban.user_mhs_id')
            ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            ->join('tugas', 'tugas.id', '=', 'jawaban.tugas_id')
            ->select('tugas.*', 'mahasiswa.*', 'jawaban.*')
            ->where('jawaban.status', '=', 0)
            ->where('tugas.user_dsn_id', '=', auth()->user()->id)
            ->get();
        $jum = count($user);
        // dd($jum);
        return view('dashboard.index', compact('dosen', 'mahasiswa', 'jum', 'count', 'mhs', 'dsn', 'mtk', 'jawab'));
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
        $request->validate(
            [
                'txtusername' => 'required|unique:users,username',
                'txtnama' => 'required',
                'txtemail' => 'required',
            ],
            [
                'txtusername.required' => 'Username tidak boleh kosong',
                'txtusername.unique' => 'Username sudah ada',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'E-mail tidak boleh kosong',
            ]
        );

        $user = new User([
            'role' => 'admin',
            'username' => $request->txtusername,
            'name' => $request->txtnama,
            'email' => $request->txtemail,
            'password' => bcrypt($request->txtpassword),
            'remember_token' => str::random(60),
        ]);
        $user->save();

        return redirect('/admin_')->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit(User $user)
    {
        $user = User::find($user->id);
        return view('dashboard.editadmin', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'txtusername' => 'required|unique:users,username,' . $user->id,
                'txtnama' => 'required',
                'txtemail' => 'required',
            ],
            [
                'txtusername.required' => 'Username tidak boleh kosong',
                'txtusername.unique' => 'Username sudah ada',
                'txtnama.required' => 'Nama tidak boleh kosong',
                'txtemail.required' => 'E-mail tidak boleh kosong',
            ]
        );

        $user = User::findOrFail($user->id);
        // $input = $request->all();
        $user->fill([
            'username'      => $request->input('txtusername'),
            'name'           => $request->input('txtnama'),
            'email'           => $request->input('txtemail'),
            'password' => $request->txtpassword ? bcrypt($request->txtpassword) : $user->password,
        ])->save();

        return redirect('/admin_')->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->user()->delete();

        User::destroy($user->id);
        return redirect('/admin_')->with('success', 'Data Berhasil Dihapus');
    }

    public function admin()
    {
        $user = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        // dd($user);
        return view('dashboard.admin', compact('user'));
    }

    public function tambah()
    {
        return view('dashboard.tambahadmin');
    }
}
