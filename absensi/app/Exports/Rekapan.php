<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Rekapan implements FromView
{
    public function view(): View
    {
      if ($id_karyawan == 'all') {
        $result = daftarPresensi::
        whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->get()->toArray();
      } else {
        $result = daftarPresensi::
        whereBetween('waktu_absen', array($range1, $range2))
        ->where('id_manajer','=',Auth::User()->id)
        ->where('id_karyawan','=', $id_karyawan)
        ->get()->toArray();
      }
      
        return view('pdf.rekapan', [
            'rekapan' => $result
        ]);
    }
}
