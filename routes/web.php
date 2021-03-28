<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/about', function () {
//     $nama = 'Tiara Yulinda';
//     return view('about', ['nama' => $nama]);
// });

// Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');

Route::get('/dynamic_dependent', 'DynamicDependent@index');
Route::post('dynamic_dependent/fetch', 'DynamicDependent@fetch')->name('dynamicdependent.fetch');

Route::get('/', 'AuthController@login');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@logout');
Route::get('/gantipassword', 'AuthController@gantipasswordform');
Route::post('/gantipassword', 'AuthController@gantipassword');
// Route::patch('/ubahpassword', 'AuthController@ubahpassword');

Route::group(['middleware' => ['auth', 'checkRole:mahasiswa']], function () {
    Route::get('/tugasmahasiswa', 'TugasMahasiswaController@index');
    Route::get('/tugasmahasiswa/jawaban', 'TugasMahasiswaController@jawaban');
    Route::get('/tugasmahasiswa/{tugas}', 'TugasMahasiswaController@show');
    Route::delete('/tugasmahasiswa/{jawaban}/hapus', 'TugasMahasiswaController@destroy');
    Route::get('/tugasmahasiswa/{tugas}/kerjakantugas', 'TugasMahasiswaController@create');
    Route::get('/tugasmahasiswa/{tugas}/uploadjawaban', 'TugasMahasiswaController@createUpload');
    Route::post('/tugasmahasiswa/kirimjawaban', 'TugasMahasiswaController@store');
    Route::post('/tugasmahasiswa/upload', 'TugasMahasiswaController@uploadfile');
    Route::get('/tugasmahasiswa/{jawaban}/lihatjawaban', 'TugasMahasiswaController@lihatjawaban');
    Route::get('/profile/{mahasiswa}/editprofile', 'AuthController@editprofile');
    Route::patch('/profile/{mahasiswa}/updateprofile', 'AuthController@updateprofile');
    Route::get('/dosen/{user}/tugas', 'TugasMahasiswaController@tugasDosen');
    Route::get('/materi', 'TugasMahasiswaController@matkul');
    Route::get('/tugasmahasiswa/{matkul}/dosen', 'TugasMahasiswaController@dosen');
    Route::get('/dosen/{matkul}/{dosen}/materi', 'TugasMahasiswaController@materi');
});

Route::group(['middleware' => ['auth', 'checkRole:dosen']], function () {
    Route::get('/tugas/{dosen}/tambah', 'TugasController@create');
    Route::get('/tugas/{tugas}/detail', 'TugasController@daftarMahasiswa');
    Route::get('/tugas/{dosen}/upload', 'TugasController@createUpload');
    Route::post('/tugas/tambahtugas/', 'TugasController@store');
    Route::post('/tugas/uploadtugas', 'TugasController@uploadfile');
    Route::get('/tugas/{tugas}/jawabanpdf', 'TugasController@jawabanpdf');
    Route::delete('/tugas/{tugas}/hapus', 'TugasController@destroy');
    Route::get('/tugas/{tugas}/edit', 'TugasController@edit');
    Route::get('/tugas/{tugas}/editfile', 'TugasController@editfile');
    Route::patch('/tugas/{tugas}/update', 'TugasController@update');
    Route::patch('/tugas/{tugas}/updatefile', 'TugasController@updatefile');
    Route::get('/tugas/{tugas}', 'TugasController@show');
    Route::get('/tugas/{id}/jawaban', 'TugasController@jawabanMahasiswa');
    Route::get('/profile/{dosen}/edit', 'AuthController@edit');
    Route::patch('/profile/{dosen}/update', 'AuthController@update');
    Route::get('/Matakuliah', 'TugasController@matakuliah');
    Route::get('/matkul/{matkul}/tugas', 'TugasController@tugas');
    Route::get('/matkul/{matkul}/materi', 'TugasController@materi');
    Route::get('/tugasMahasiswa', 'TugasController@tugasMahasiswa');
    Route::get('/matkul/{matkul}/tambahmateri', 'TugasController@formtambahmateri');
    Route::post('/uploadmateri', 'TugasController@uploadmateri');
    Route::get('/materi/{materi}/download', 'TugasController@downloadmateri');
    Route::delete('/materi/{materi}/hapus', 'TugasController@destroymateri');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/matakuliah', 'MatakuliahController@index');
    Route::get('/matakuliah/tambah', 'MatakuliahController@create');
    Route::post('/matakuliah/tambahmatkul', 'MatakuliahController@store');
    Route::get('/matakuliah/{matkul}/edit', 'MatakuliahController@edit');
    Route::patch('/matakuliah/{matkul}/update', 'MatakuliahController@update');
    Route::delete('/matakuliah/{matkul}/hapus', 'MatakuliahController@destroy');
    Route::get('/matakuliah/{matkul}/pengajar', 'MatakuliahController@pengajarform');

    Route::get('/dosen', 'DosenController@index');
    Route::get('/dosen/tambahdata', 'DosenController@create');
    Route::post('/dosen/tambah', 'DosenController@store');
    Route::delete('/dosen/{dosen}/hapus', 'DosenController@destroy');
    Route::get('/dosen/{dosen}/edit', 'DosenController@edit');
    Route::patch('/dosen/{dosen}/update', 'DosenController@update');
    Route::get('/dosen/{dosen}/profile', 'DosenController@profile');
    Route::get('/dosen/exportpdf', 'DosenController@exportPdf');
    Route::get('/dosen/{dosen}/matakuliah', 'DosenController@matakuliah');
    Route::get('/dosen/{dosen}/tambahmatakuliah', 'DosenController@tambahmatakuliahform');
    Route::post('/dosen/{dosen}/addmatakuliah', 'DosenController@addmatakuliah');
    Route::get('/dosen/{id}/hapuspelajaran', 'DosenController@hapusmatkul');
    Route::get('/dosen/{id}/editmatakuliah', 'DosenController@editmatkul');

    Route::get('/mahasiswa', 'MahasiswaController@index');
    Route::get('/mahasiswa/tambahdata', 'MahasiswaController@create');
    Route::post('/mahasiswa/tambah', 'MahasiswaController@store');
    Route::get('/mahasiswa/{mahasiswa}/edit', 'MahasiswaController@edit');
    Route::patch('/mahasiswa/{mahasiswa}/update', 'MahasiswaController@update');
    Route::delete('/mahasiswa/{mahasiswa}/hapus', 'MahasiswaController@destroy');
    Route::get('/mahasiswa/{mahasiswa}/profile', 'MahasiswaController@profile');
    Route::get('/mahasiswa/exportexcel', 'MahasiswaController@exportExcel');
    Route::get('/mahasiswa/{id}/exportpdf', 'MahasiswaController@exportPdf');
    Route::get('/mahasiswa/exportpdf', 'MahasiswaController@exportAllPdf');
    Route::get('/mahasiswa/semester', 'MahasiswaController@laporan');

    Route::get('/admin_', 'DashboardController@admin');
    Route::get('/admin_/tambah', 'DashboardController@tambah');
    Route::post('/tambahadmin', 'DashboardController@store');
    Route::get('/admin_/{user}/edit', 'DashboardController@edit');
    Route::patch('/admin_/{user}/update', 'DashboardController@update');
    Route::delete('/admin_/{user}/hapus', 'DashboardController@update');
});

// Route::get('/dashboard', 'DashboardController@index');

Route::group(['middleware' => ['auth', 'checkRole:admin,dosen,mahasiswa']], function () {
    Route::get('/dashboard', 'DashboardController@index');
});

Route::group(['middleware' => ['auth', 'checkRole:mahasiswa,dosen']], function () {
    Route::get('myprofile', 'AuthController@myprofile');
    Route::get('/tugas', 'TugasController@index');
});


Route::get('/students', 'StudentsController@index');
Route::get('/students/tambahdata', 'StudentsController@create');
//{student} dari parameter di controller function show
Route::get('/students/{student}', 'StudentsController@show');
Route::post('/students', 'StudentsController@store'); //post untuk insert data
Route::delete('/students/{student}', 'StudentsController@destroy');
Route::get('/students/{student}/editdata', 'StudentsController@edit');
Route::patch('/students/{student}', 'StudentsController@update');

//jika menggunakan method bawaan laravel
// Route::resource('students', 'StudentsController');
