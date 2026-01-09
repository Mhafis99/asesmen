<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\JadwalBimbingan;
use App\Models\JadwalLab;
use App\Models\Absensi;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalKelas = Kelas::count();
        $totalJadwal = JadwalBimbingan::count() + JadwalLab::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalKelas', 'totalJadwal'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function usersCreate()
    {
        $kelas = Kelas::all();
        return view('admin.users.create', compact('kelas'));
    }

    public function usersStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,guru,siswa',
            'status_guru' => 'nullable|in:biasa,pembimbing',
            'nis' => 'nullable|string|max:50',
            'nip' => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    public function usersEdit($id)
    {
        $user = User::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.users.edit', compact('user', 'kelas'));
    }

    public function usersUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,guru,siswa',
            'status_guru' => 'nullable|in:biasa,pembimbing',
            'nis' => 'nullable|string|max:50',
            'nip' => 'nullable|string|max:50',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate');
    }

    public function usersDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    public function kelas()
    {
        $kelas = Kelas::with('siswa')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function kelasCreate()
    {
        return view('admin.kelas.create');
    }

    public function kelasStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        Kelas::create($validated);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function kelasEdit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function kelasUpdate(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        $kelas->update($validated);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diupdate');
    }

    public function kelasDelete($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }

    public function jadwalBimbingan()
    {
        $jadwal = JadwalBimbingan::with(['kelas', 'guru'])->get();
        return view('admin.jadwal-bimbingan.index', compact('jadwal'));
    }

    public function jadwalBimbinganCreate()
    {
        $kelas = Kelas::all();
        $guru = User::where('role', 'guru')->get();
        return view('admin.jadwal-bimbingan.create', compact('kelas', 'guru'));
    }

    public function jadwalBimbinganStore(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        JadwalBimbingan::create($validated);

        return redirect()->route('admin.jadwal-bimbingan')->with('success', 'Jadwal bimbingan berhasil ditambahkan');
    }

    public function jadwalBimbinganDelete($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal-bimbingan')->with('success', 'Jadwal bimbingan berhasil dihapus');
    }

    public function jadwalLab()
    {
        $jadwal = JadwalLab::with(['kelas', 'guru'])->get();
        return view('admin.jadwal-lab.index', compact('jadwal'));
    }

    public function jadwalLabCreate()
    {
        $kelas = Kelas::all();
        $guru = User::where('role', 'guru')->get();
        return view('admin.jadwal-lab.create', compact('kelas', 'guru'));
    }

    public function jadwalLabStore(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        JadwalLab::create($validated);

        return redirect()->route('admin.jadwal-lab')->with('success', 'Jadwal lab berhasil ditambahkan');
    }

    public function jadwalLabDelete($id)
    {
        $jadwal = JadwalLab::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal-lab')->with('success', 'Jadwal lab berhasil dihapus');
    }

    public function absensi()
    {
        $absensi = Absensi::with(['jadwalBimbingan', 'siswa'])->get();
        return view('admin.absensi.index', compact('absensi'));
    }

    public function nilai()
    {
        $nilai = Nilai::with(['siswa', 'jadwalBimbingan', 'guru'])->get();
        return view('admin.nilai.index', compact('nilai'));
    }
}
