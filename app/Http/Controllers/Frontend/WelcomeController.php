<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $kits = Kit::take(4)->get(); //primeros 4 kits
        //$kits = Kit::all(); // todos los kits

        return view('welcome', ['kits' => $kits]);
    }

    public function gracias()
    {
        return view('gracias');
    }
}
