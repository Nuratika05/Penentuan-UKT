<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use app\Models\Folder;

use Illuminate\Http\Request;

class FolderArsipController extends Controller
{
    public function index(){

            $arsip = Arsip::all();
            $dataExists = $arsip->isNotEmpty();

            return view('arsip.folder', compact('arsip', 'dataExists' ));

    }
}
