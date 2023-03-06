<?php
namespace App\Imports;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'name'     => $row[0],
            'username'     => $row[1],
            'email'     => $row[2],
            'user_id'     => $row[3],
            'nisn'     => $row[4],
            'nis'     => $row[5],
            'kelas_id'     => $row[6],
            'alamat'    => $row[7],
            'no_hp'    => $row[8],
            'foto'    => $row[9],
            'password' => Hash::make($row[10]),

        ]);
    }
}
