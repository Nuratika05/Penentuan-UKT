<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Jurusan;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


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
            'password.required' => 'Password harus berisi minimal 4 karakter',
            'password.min' => 'Password harus berisi minimal 4 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',

        ];

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:4'],
            'email' => ['required', 'email', 'unique:admins,email'],
        ], $message);

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
            return redirect()->route('admin.create')->with('error', 'Gagal menambahkan data. Email sudah digunakan.')->withErrors($validator)->withInput();
        }elseif ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {
            // Tangani jenis kesalahan lain jika diperlukan
            return redirect()->route('admin.index')->with('error', 'Gagal menambahkan data. Terjadi kesalahan.')->withErrors($validator)->withInput();
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
            $message = [
                'password.required' => 'Password harus berisi minimal 4 karakter',
                'password.min' => 'Password harus berisi minimal 4 karakter',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
            ];

            // Jika password kosong, hanya validasi email
            if (empty($request->password)) {
                $validator = Validator::make($request->all(), [
                    'email' => ['required', 'email', 'unique:admins,email,'.$admin->id],
                ], $message);

                // Cek validasi
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Jika validasi berhasil, lakukan update
                $admin->update([
                    'nama' => $request->nama,
                    'role' => $request->role,
                    'jurusan_id' => $request->jurusan_id,
                    'email' => $request->email,
                ]);

            } else {
                // Validasi email dan password jika password tidak kosong
                $validator = Validator::make($request->all(), [
                    'password' => ['required', 'min:4'],
                    'email' => ['required', 'email', 'unique:admins,email,'.$admin->id],
                ], $message);

                // Cek validasi
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Jika validasi berhasil, lakukan update
                $admin->update([
                    'nama' => $request->nama,
                    'role' => $request->role,
                    'jurusan_id' => $request->jurusan_id,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            return redirect()->route('admin.index')->with('success', 'Berhasil mengubah data.');

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->route('admin.edit', $admin->id)->with('error', 'Gagal mengubah data. Email sudah digunakan.')->withInput();
            } else {
                return redirect()->route('admin.index')->with('error', 'Gagal mengubah data. Terjadi kesalahan.')->withInput();
            }
        }
    }


    public function destroy(Admin $admin)
    {

        try {
            $admin->delete();
            return redirect()->route('admin.index')->with('success', 'Berhasil Menghapus Data.');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {

                return redirect()->route('admin.index')->with('error', 'Data tidak dapat dihapus karena terkait dengan data lain.');
            }

            // Jika ada pengecualian lain, lemparkan kembali pengecualian
            throw $e;
        }
    }
}
