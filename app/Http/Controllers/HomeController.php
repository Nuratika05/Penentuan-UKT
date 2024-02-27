<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homeAdmin()
    {
        if(Auth('admin')->check()){
            $admin = auth()->guard('admin')->user();
            if(Auth::guard('admin')->check() && Auth::user()->role == 'superadmin'){
            // count mahasiswa
            $mahasiswa = Mahasiswa::count();
            $berkas = Berkas::where('status', 'Menunggu Verifikasi')->count();
            $berkaslengkap = Berkas::where('status', 'Lengkap')->count();
            return view('home' , compact('mahasiswa', 'berkas' , 'berkaslengkap'));
            }
            elseif(Auth::guard('admin')->check() && Auth::user()->role == 'verifikator'){
            $berkas = Berkas::with(['admin', 'mahasiswa.prodi'])
            ->where('status', 'Menunggu Verifikasi')
            ->where(function ($query) use ($admin) {
                $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                })
                ->orWhereHas('admin', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                });
            })->count();
            $berkaslengkap = Berkas::with(['admin', 'mahasiswa.prodi'])
            ->where('status', 'Lengkap')
            ->where(function ($query) use ($admin) {
                $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                })
                ->orWhereHas('admin', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                });
            })->count();

            return view('home' , compact('berkas' , 'berkaslengkap'));
        }
    }
    }

    public function homeMahasiswa()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
        return view('home', compact('mahasiswa', 'berkas'));
    }
}
