<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
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

    public function index()
    {
        $gaji = Gaji::with(['karyawan.jabatan'])->get();
        // Convert numeric month to month name for each record
        $gaji->each(function($item) {
            $bulanNum = date('m', strtotime($item->tanggal_gaji));
            $item->bulan = array_search($bulanNum, $this->bulanList);
        });
        return view('gaji.index', compact('gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::with('jabatan')->where('status', 'aktif')->get();
        return view('gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string|in:' . implode(',', array_keys($this->bulanList)),
            'tahun' => 'required|numeric',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
            'keterangan' => 'required|in:Success,Delayed'
        ]);

        $karyawan = Karyawan::with('jabatan')->find($request->karyawan_id);
        
        // Verify that the submitted salary matches the position's salary
        if ($karyawan->jabatan->gaji_pokok != $request->gaji_pokok || 
            $karyawan->jabatan->tunjangan != $request->tunjangan) {
            return back()
                ->withInput()
                ->withErrors(['gaji_pokok' => 'Nominal gaji dan tunjangan harus sesuai dengan jabatan karyawan']);
        }

        // Convert month name to number for storage
        $bulanNum = $this->bulanList[$request->bulan];
        $tanggal_gaji = date('Y-m-d', strtotime($request->tahun . '-' . $bulanNum . '-01'));
        
        $data = [
            'karyawan_id' => $request->karyawan_id,
            'tanggal_gaji' => $tanggal_gaji,
            'gaji_pokok' => $karyawan->jabatan->gaji_pokok,
            'tunjangan' => $karyawan->jabatan->tunjangan,
            'potongan' => $request->potongan,
            'total_gaji' => $karyawan->jabatan->gaji_pokok + $karyawan->jabatan->tunjangan - $request->potongan,
            'keterangan' => $request->keterangan
        ];

        Gaji::create($data);
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil ditambahkan');
    }

    public function edit(Gaji $gaji)
    {
        $karyawan = Karyawan::with('jabatan')->where('status', 'aktif')->get();
        // Convert numeric month to month name
        $bulanNum = date('m', strtotime($gaji->tanggal_gaji));
        $gaji->bulan = array_search($bulanNum, $this->bulanList);
        $gaji->tahun = date('Y', strtotime($gaji->tanggal_gaji));
        
        return view('gaji.edit', compact('gaji', 'karyawan'));
    }

    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string|in:' . implode(',', array_keys($this->bulanList)),
            'tahun' => 'required|numeric',
            'potongan' => 'required|numeric|min:0',
            'keterangan' => 'required|in:Success,Delayed'
        ]);

        $karyawan = Karyawan::with('jabatan')->find($request->karyawan_id);
        
        // Convert month name to number for storage
        $bulanNum = $this->bulanList[$request->bulan];
        $tanggal_gaji = date('Y-m-d', strtotime($request->tahun . '-' . $bulanNum . '-01'));
        
        $data = [
            'karyawan_id' => $request->karyawan_id,
            'tanggal_gaji' => $tanggal_gaji,
            'gaji_pokok' => $karyawan->jabatan->gaji_pokok,
            'tunjangan' => $karyawan->jabatan->tunjangan,
            'potongan' => $request->potongan,
            'total_gaji' => $karyawan->jabatan->gaji_pokok + $karyawan->jabatan->tunjangan - $request->potongan,
            'keterangan' => $request->keterangan
        ];

        $gaji->update($data);
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui');
    }

    public function destroy(Gaji $gaji)
    {
        $gaji->delete();
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus');
    }
}
