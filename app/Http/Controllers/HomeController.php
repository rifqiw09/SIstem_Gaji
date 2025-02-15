<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Gaji;

class HomeController extends Controller
{
    private $bulanList = [
        'Januari' => '01',
        'Februari' => '02',
        'Maret' => '03',
        'April' => '04',
        'Mei' => '05',
        'Juni' => '06',
        'Juli' => '07',
        'Agustus' => '08',
        'September' => '09',
        'Oktober' => '10',
        'November' => '11',
        'Desember' => '12'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jabatan = Jabatan::latest()->take(5)->get();
        $karyawan = Karyawan::with('jabatan')->latest()->take(5)->get();
        $gaji = Gaji::with(['karyawan.jabatan'])
                    ->latest()
                    ->take(5)
                    ->get();

        // Convert numeric month to month name for each gaji record
        $gaji->each(function($item) {
            $bulanNum = date('m', strtotime($item->tanggal_gaji));
            $item->bulan = array_search($bulanNum, $this->bulanList);
            $item->tahun = date('Y', strtotime($item->tanggal_gaji));
        });

        return view('home', compact('jabatan', 'karyawan', 'gaji'));
    }
}
