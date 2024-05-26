<?php

namespace App\Http\Controllers;
use App\Models\Link;

use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function store(Request $request)
    {
        $message = [
            'url.required' => 'Link URL harus diisi',
            'url.url' => 'Masukkan URL yang valid',
            'tanggal_aktif.required' => 'Tanggal aktif harus diisi',
            'tanggal_aktif.date' => 'Masukkan tanggal yang valid',
            'tanggal_mati.date' => 'Masukkan tanggal yang valid',
        ];
        $request->validate([
            'url' => 'required|url',
            'tanggal_aktif' => 'required|date',
            'tanggal_mati' => 'nullable|date',
        ],$message);

        $links = Link::create($request->all());

        if ($links) {
        return redirect()->back()->with('success', 'Berhasil Menambahkan Link.')->with('modal', 'addLinkModal');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Link.')->with('modal', 'addLinkModal');
        }
    }

    public function update(Request $request, Link $link)
    {
        $message = [
            'url.required' => 'Link URL harus diisi',
            'url.url' => 'Masukkan URL yang valid',
            'tanggal_aktif.required' => 'Tanggal aktif harus diisi',
            'tanggal_aktif.date' => 'Masukkan tanggal yang valid',
            'tanggal_mati.date' => 'Masukkan tanggal yang valid',
        ];
        $request->validate([
            'url' => 'required|url',
            'tanggal_aktif' => 'required|date',
            'tanggal_mati' => 'nullable|date',
        ],$message);

        $links = $link->update($request->all());

        if ($links){
        return redirect()->back()->with('success', 'Berhasil Mengubah Link.')->with('modal', 'editLinkModal'.$link->id);
    } else {
        return redirect()->back()->with('error', 'Gagal Mengubah Link.')->with('modal', 'editLinkModal'. $link->id);
    }
    }

    public function destroy(Link $link)
    {
        $links = $link->delete();

        if ($links) {
        return redirect()->back()->with('success', 'Berhasil Menghapus Link.');
    } else {
        return redirect()->back()->with('error', 'Gagal Menghapus Link.');
    }
    }
}
