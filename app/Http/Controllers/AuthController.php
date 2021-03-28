<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\User;
use App\Dosen;
use App\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\User;
// use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'txtusername' => 'required',
                'txtpassword' => 'required',
            ],
            [
                'txtusername.required' => 'Username Harus Di Isi',
                'txtpassword.required' => 'Password Harus Di Isi',
            ]
        );

        $username = $request->txtusername;
        $password = $request->txtpassword;
        if (Auth::attempt(array('username' => $username, 'password' => $password))) {
            return redirect('/dashboard');
            // return ('berhasil');
        } else {
            return redirect()->back()->with('status', 'Username / Password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function gantipasswordform()
    {
        return view('auth.gantipassword');
    }

    public function myprofile()
    {
        if (auth()->user()->mahasiswa) {
            $mahasiswa = auth()->user()->mahasiswa;
            return view('auth.myprofile', compact(['mahasiswa']));
        }
        if (auth()->user()->dosen) {
            $dosen = auth()->user()->dosen;
            return view('auth.profile', compact(['dosen']));
        }
    }

    public function gantipassword(Request $request)
    {
        if (!(Hash::check($request->get('txtpasslama'), Auth::user()->password))) {
            return back()->with('error', 'Password lama salah');
        }
        if (strcmp($request->get('txtpasslama'), $request->get('txtpassbaru')) == 0) {
            return back()->with('error', 'Password baru tidak boleh sama dengan password lama');
        }
        $request->validate(
            [
                'txtpasslama' => 'required',
                'txtpassbaru' => 'required|min:6',
                'txtkonfirmasi' => 'required|same:txtpassbaru'
            ],
            [
                'txtpasslama.required' => 'Password lama tidak boleh kosong',
                'txtpassbaru.required' => 'Password baru tidak boleh kosong',
                'txtpassbaru.min' => 'Password minimal harus 6 karakter',
                'txtkonfirmasi.same' => 'Password tidak cocok dengan password baru',
                'txtkonfirmasi.required' => 'Tidak boleh kosong',
            ]
        );

        $user = Auth::user();
        $user->password = bcrypt($request->get('txtpassbaru'));
        $user->save();
        // dd($request);

        return back()->with('success', 'Password berhasil diganti');
    }

    public function edit(Dosen $dosen)
    {
        $user = User::find($dosen->id);
        return view('auth.editprofile')->with('dosen', $dosen);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate(
            [
                'txtnama' => 'required',
                'txtemail' => 'required',
                'txtalamat' => 'required',
                'txtgender' => 'required',
                'txtagama' => 'required',
                'txttgl_lahir' => 'required',
                'txttempat_lahir' => 'required',
                'fotoprofile' => 'sometimes|image|mimes:jpg,jpeg,png|max:2084',
                'txtno_telpon' => 'required|numeric',
            ],
            [
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
        // $dosen->foto = $request->fotoprofile;
        $dosen->save();

        $user = $dosen->user;
        $user->name = $request->txtnama;
        $user->email = $request->txtemail;
        $user->save();

        if ($request->hasFile('fotoprofile')) {
            $request->file('fotoprofile')->move('images/', $request->file('fotoprofile')->getClientOriginalName());
            $dosen->foto = $request->file('fotoprofile')->getClientOriginalName();
            $dosen->save();
        }
        // dd($request->all());
        return redirect('/myprofile')->with('success', 'Data berhasil diubah');
    }

    public function editprofile(Mahasiswa $mahasiswa)
    {
        $user = User::find($mahasiswa->id);
        return view('auth.editmyprofile', ['mahasiswa' => $mahasiswa]);
        // return view('auth.editmyprofile')->with('mahasiswa', $mahasiswa);
    }

    public function updateprofile(Request $request, Mahasiswa $mahasiswa)
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
                'txtgender.required' => 'Gender tidak boleh kosong',
            ]
        );

        $mahasiswa = Mahasiswa::find($mahasiswa->id);
        $mahasiswa->nama = $request->txtnama;
        $mahasiswa->email = $request->txtemail;
        $mahasiswa->foto = $request->fotoprofile;
        $mahasiswa->alamat = $request->txtalamat;
        $mahasiswa->gender = $request->txtgender;
        $mahasiswa->agama = $request->txtagama;
        $mahasiswa->tempat_lahir = $request->txttempat_lahir;
        $mahasiswa->tgl_lahir = $request->txttgl_lahir;
        $mahasiswa->no_telpon = $request->txtno_telpon;
        $mahasiswa->save();

        $user = $mahasiswa->user;
        $user->name = $request->txtnama;
        $user->email = $request->txtemail;

        if ($request->hasFile('fotoprofile')) {
            $request->file('fotoprofile')->move('images/', $request->file('fotoprofile')->getClientOriginalName());
            $mahasiswa->foto = $request->file('fotoprofile')->getClientOriginalName();
            $mahasiswa->save();
        }
        // dd($request->all());
        return redirect('/myprofile')->with('success', 'Data berhasil diubah');
    }
}
