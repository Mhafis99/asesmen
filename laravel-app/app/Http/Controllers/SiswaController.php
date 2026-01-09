<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JadwalBimbingan;
use App\Models\JadwalLab;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $kelasSiswa = $user->kelas()->first();

        if (!$kelasSiswa) {
            return redirect()->back()->with('error', 'Anda belum terdaftar di kelas manapun');
        }

        $jadwalBimbingan = JadwalBimbingan::where('kelas_id', $kelasSiswa->id)
            ->with(['guru', 'absensi' => function ($query) use ($user) {
                $query->where('siswa_id', $user->id);
            }])
            ->get();

        $jadwalLab = JadwalLab::where('kelas_id', $kelasSiswa->id)
            ->with(['guru'])
            ->get();

        $nilaiSiswa = Nilai::where('siswa_id', $user->id)
            ->with(['jadwalBimbingan', 'guru'])
            ->get();

        return view('siswa.dashboard', compact('jadwalBimbingan', 'jadwalLab', 'nilaiSiswa', 'kelasSiswa'));
    }

    public function jadwalBimbingan()
    {
        $user = Auth::user();
        $kelasSiswa = $user->kelas()->first();

        $jadwal = JadwalBimbingan::where('kelas_id', $kelasSiswa->id)
            ->with(['guru', 'absensi' => function ($query) use ($user) {
                $query->where('siswa_id', $user->id);
            }])
            ->get();

        return view('siswa.jadwal-bimbingan.index', compact('jadwal'));
    }

    public function jadwalLab()
    {
        $user = Auth::user();
        $kelasSiswa = $user->kelas()->first();

        $jadwal = JadwalLab::where('kelas_id', $kelasSiswa->id)
            ->with(['guru'])
            ->get();

        return view('siswa.jadwal-lab.index', compact('jadwal'));
    }

    public function nilai()
    {
        $user = Auth::user();
        $nilai = Nilai::where('siswa_id', $user->id)
            ->with(['jadwalBimbingan', 'guru'])
            ->get();

        return view('siswa.nilai.index', compact('nilai'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('siswa.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('siswa.profile')->with('success', 'Profile berhasil diupdate');
    }
}
