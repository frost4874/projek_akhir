<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerkasPermohonanController extends Controller
{
    public function index()
    {
        $npage = 2;
        return view('admin.berkas', compact('npage'));
    }
}
