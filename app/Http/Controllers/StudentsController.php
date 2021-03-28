<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        //compact('students'); karna nama tabel dan variabel $studenst sama
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //tampilkan form tambah data
        return view('students.tambahdata');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi agar form tidak kosong
        $request->validate([
            'nama' => 'required',
            'npm' => 'required | 10',
        ]);

        //tambah data proses
        //buat object Student
        $student = new Student;

        //nama didatabase = namadiform
        $student->npm = $request->txtnpm;
        $student->nama = $request->txtnama;
        $student->email = $request->txtemail;
        $student->jurusan = $request->txtjurusan;

        // Student::create([
        //     'npm' => $request->txtnpm,
        //     'nama' => $request->txtnama,
        //     'email' => $request->txtemail,
        //     'jurusan' => $request->txtjurusan
        // ]);
        //atau 
        // Student::create($request->all());

        $student->save(); //kemudian simpan
        return redirect('/students')->with('status', 'Data Berhasil Ditambahkan'); //kembali ke halaman daftar mahasiswa
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //untuk menampilkan detail (compact('student') = dari parameter diatas)
        return view('students.detail', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //untuk menampikan form edit
        return view('students.editdata', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //validasi agar form tidak kosong
        $request->validate([
            'nama' => 'required',
            'npm' => 'required | 10',
        ]);

        //untuk mengubah data
        Student::where('id', $student->id)
            ->update([
                'npm' => $request->txtnpm,
                'nama' => $request->txtnama,
                'email' => $request->txtemail,
                'jurusan' => $request->txtjurusan
            ]);

        return redirect('/students')->with('status', 'Data Berhasil Diubah'); //kembali ke halaman daftar mahasiswa
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //hapus data detail
        Student::destroy($student->id);

        return redirect('/students')->with('status', 'Data Berhasil Dihapus'); //kembali ke halaman daftar mahasiswa

    }
}
