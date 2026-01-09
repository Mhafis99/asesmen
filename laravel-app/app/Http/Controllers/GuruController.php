<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\JadwalBimbingan;
use App\Models\JadwalLab;
use App\Models\Absensi;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $jadwalBimbingan = JadwalBimbingan::where('guru_id', $user->id)
            ->with(['kelas', 'absensi'])
            ->get();
        $jadwalLab = JadwalLab::where('guru_id', $user->id)
            ->with('kelas')
            ->get();
        $totalSiswa = User::where('role', 'siswa')->count();
        $kelas = Kelas::all();

        return view('guru.dashboard', compact('jadwalBimbingan', 'jadwalLab', 'totalSiswa', 'kelas'));
    }

    public function jadwalBimbingan()
    {
        $user = Auth::user();
        $jadwal = JadwalBimbingan::where('guru_id', $user->id)
            ->with(['kelas', 'absensi'])
            ->get();
        $kelas = Kelas::all();

        return view('guru.jadwal-bimbingan.index', compact('jadwal', 'kelas'));
    }

    public function jadwalBimbinganCreate()
    {
        $kelas = Kelas::all();
        return view('guru.jadwal-bimbingan.create', compact('kelas'));
    }

    public function jadwalBimbinganStore(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        $validated['guru_id'] = Auth::id();

        JadwalBimbingan::create($validated);

        return redirect()->route('guru.jadwal-bimbingan')->with('success', 'Jadwal bimbingan berhasil ditambahkan');
    }

    public function jadwalBimbinganEdit($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $kelas = Kelas::all();

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('guru.jadwal-bimbingan.edit', compact('jadwal', 'kelas'));
    }

    public function jadwalBimbinganUpdate(Request $request, $id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        $jadwal->update($validated);

        return redirect()->route('guru.jadwal-bimbingan')->with('success', 'Jadwal bimbingan berhasil diupdate');
    }

    public function jadwalBimbinganDelete($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $jadwal->delete();

        return redirect()->route('guru.jadwal-bimbingan')->with('success', 'Jadwal bimbingan berhasil dihapus');
    }

    public function jadwalLab()
    {
        $user = Auth::user();
        $jadwal = JadwalLab::where('guru_id', $user->id)
            ->with('kelas')
            ->get();
        $kelas = Kelas::all();

        return view('guru.jadwal-lab.index', compact('jadwal', 'kelas'));
    }

    public function jadwalLabCreate()
    {
        $kelas = Kelas::all();
        return view('guru.jadwal-lab.create', compact('kelas'));
    }

    public function jadwalLabStore(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        $validated['guru_id'] = Auth::id();

        JadwalLab::create($validated);

        return redirect()->route('guru.jadwal-lab')->with('success', 'Jadwal lab berhasil ditambahkan');
    }

    public function jadwalLabEdit($id)
    {
        $jadwal = JadwalLab::findOrFail($id);
        $kelas = Kelas::all();

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('guru.jadwal-lab.edit', compact('jadwal', 'kelas'));
    }

    public function jadwalLabUpdate(Request $request, $id)
    {
        $jadwal = JadwalLab::findOrFail($id);

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'materi' => 'nullable|string|max:255',
        ]);

        $jadwal->update($validated);

        return redirect()->route('guru.jadwal-lab')->with('success', 'Jadwal lab berhasil diupdate');
    }

    public function jadwalLabDelete($id)
    {
        $jadwal = JadwalLab::findOrFail($id);

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $jadwal->delete();

        return redirect()->route('guru.jadwal-lab')->with('success', 'Jadwal lab berhasil dihapus');
    }

    public function absensi()
    {
        $user = Auth::user();
        $jadwal = JadwalBimbingan::where('guru_id', $user->id)->get();
        $absensi = Absensi::whereIn('jadwal_bimbingan_id', $jadwal->pluck('id'))
            ->with(['jadwalBimbingan', 'siswa'])
            ->get();

        return view('guru.absensi.index', compact('absensi', 'jadwal'));
    }

    public function nilai()
    {
        $user = Auth::user();
        $jadwalBimbingan = JadwalBimbingan::where('guru_id', $user->id)->get();
        $nilai = Nilai::whereIn('jadwal_bimbingan_id', $jadwalBimbingan->pluck('id'))
            ->with(['siswa', 'jadwalBimbingan'])
            ->get();

        return view('guru.nilai.index', compact('nilai', 'jadwalBimbingan'));
    }

    public function nilaiCreate($jadwalBimbinganId)
    {
        $jadwal = JadwalBimbingan::findOrFail($jadwalBimbinganId);
        $siswa = User::where('role', 'siswa')->get();

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('guru.nilai.create', compact('jadwal', 'siswa'));
    }

    public function nilaiStore(Request $request, $jadwalBimbinganId)
    {
        $jadwal = JadwalBimbingan::findOrFail($jadwalBimbinganId);

        if ($jadwal->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'nilai_kompetensi' => 'required|integer|min:0|max:100',
            'nilai_sikap' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:500',
            'tanggal_penilaian' => 'required|date',
        ]);

        $validated['jadwal_bimbingan_id'] = $jadwalBimbinganId;
        $validated['guru_id'] = Auth::id();

        Nilai::create($validated);

        return redirect()->route('guru.nilai')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function nilaiEdit($id)
    {
        $nilai = Nilai::findOrFail($id);

        if ($nilai->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $jadwal = $nilai->jadwalBimbingan;
        $siswa = User::where('role', 'siswa')->get();

        return view('guru.nilai.edit', compact('nilai', 'jadwal', 'siswa'));
    }

    public function nilaiUpdate(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        if ($nilai->guru_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'nilai_kompetensi' => 'required|integer|min:0|max:100',
            'nilai_sikap' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:500',
            'tanggal_penilaian' => 'required|date',
        ]);

        $nilai->update($validated);

        return redirect()->route('guru.nilai')->with('success', 'Nilai berhasil diupdate');
    }
}
