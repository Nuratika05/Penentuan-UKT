<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Link;

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
            $link = Link::all();
            $link->each(function($link) {
                $now = Carbon::now();
                $link->isActive = $now->between(Carbon::parse($link->tanggal_aktif), Carbon::parse($link->tanggal_mati));
            });
            $berkas = Berkas::where('status', 'Menunggu Verifikasi')->count();
            $berkas_belum_lengkap = Berkas::where('status', 'Belum Lengkap')->count();
            $berkas_lulus_verifikasi = Berkas::where('status', 'Lulus Verifikasi')->count();
            return view('home' , compact('mahasiswa', 'link', 'berkas' , 'berkas_belum_lengkap', 'berkas_lulus_verifikasi'));
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

            $berkas_belum_lengkap = Berkas::with(['admin', 'mahasiswa.prodi'])
            ->where('status', 'Belum Lengkap')
            ->where(function ($query) use ($admin) {
                $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                })
                ->orWhereHas('admin', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                });
            })->count();

            $berkas_lulus_verifikasi = Berkas::with(['admin', 'mahasiswa.prodi'])
            ->where('status', 'Lulus Verifikasi')
            ->where(function ($query) use ($admin) {
                $query->whereHas('mahasiswa.prodi', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                })
                ->orWhereHas('admin', function ($q) use ($admin) {
                    $q->where('jurusan_id', $admin->jurusan_id);
                });
            })->count();

            return view('home' , compact('berkas' , 'berkas_belum_lengkap', 'berkas_lulus_verifikasi'));
        }
    }
    }

    public function homeMahasiswa()
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        $berkas = Berkas::where('mahasiswa_id', $mahasiswa->id)->first();
        $links = Link::all();
        $links->each(function($link) {
            $now = Carbon::now();
            $link->isActive = $now->between(Carbon::parse($link->tanggal_aktif), Carbon::parse($link->tanggal_mati));
        });
        return view('home', compact('mahasiswa', 'berkas', 'links'));
    }

}
