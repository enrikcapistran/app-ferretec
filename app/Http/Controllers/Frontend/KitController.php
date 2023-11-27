<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use Illuminate\Http\Request;

class KitController extends Controller
{
    public function index()
    {
        $kits = Kit::all();

        return view('kits.index', compact('kits'));
    }
}
