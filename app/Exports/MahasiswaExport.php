<?php

namespace App\Exports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Mahasiswa::all();
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->npm,
            $mahasiswa->nama,
            $mahasiswa->kelas->nama_kelas,
            $mahasiswa->email,
            $mahasiswa->jurusan,
        ];
    }

    public function headings(): array
    {
        return [
            'NPM',
            'Nama',
            'Kelas',
            'E-Mail',
            'Jurusan',
        ];
    }
}
