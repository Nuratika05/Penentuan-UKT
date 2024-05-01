<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Jurusan;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{

    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }


    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.create', compact ('jurusans'));
    }

    public function store(Request $request)
    {
        $message = [
            'password' => 'Password harus berisi minimal 4 karakter',
        ];
        $request->validate([
            'password' => ['required', Password::min(4)],
        ],$message);

        try {
        Admin::create([
            'nama' => $request->nama,
            'role' => $request->role,
            'email' => $request->email,
            'jurusan_id' => $request->jurusan_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.create')->with('success', 'Berhasil Menambahkan data.');
    } catch (QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // Kode 1062 adalah kode untuk kesalahan unik (duplicate key)
            return redirect()->route('admin.index')->with('error', 'Gagal menambahkan data. Email sudah digunakan.')->withErrors($request)->withInput();
        } else {
            // Tangani jenis kesalahan lain jika diperlukan
            return redirect()->route('admin.index')->with('error', 'Gagal menambahkan data. Terjadi kesalahan.')->withErrors($request)->withInput();
        }
    }
    }
    public function edit(Admin $admin)
    {


        $admin->find($admin);
        $jurusans = Jurusan::all();
        return view ('admin.edit', compact ('admin' , 'jurusans'));
    }

    public function update(Request $request, Admin $admin)
    {

        try {
        // jika input password kosong
        if ($request->password == '' ) {
            $admin->update([
                'nama' => $request->nama,
                'role' => $request->role,
                'jurusan_id' => $request->jurusan_id,
                'email' => $request->email,
            ]);
        } else {
            $message = [
                'password' => 'Password harus berisi minimal 4 karakter',
            ];
            $request->validate([
                'password' => ['required', Password::min(4)],
            ],$message);
            // jika input password terisi
            $admin->update([
                'nama' => $request->nama,
                'role' => $request->role,
                'email' => $request->email,
                'jurusan_id' => $request->jurusan_id,
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('admin.index')->with('success', 'Berhasil mengedit data.');
    } catch (QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            return redirect()->route('admin.index')->with('error', 'Gagal mengubah data. Email sudah digunakan.')->withErrors($request)->withInput();
        } else {
            // Tangani jenis kesalahan lain jika diperlukan
            return redirect()->route('admin.index')->with('error', 'Gagal mengubah data. Terjadi kesalahan.')->withErrors($request)->withInput();
        }
    }
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Berhasil Menghapus Data.');
    }
}
