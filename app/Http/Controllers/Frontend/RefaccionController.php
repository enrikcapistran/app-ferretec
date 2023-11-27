<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Refaccion;
use Illuminate\Http\Request;

class RefaccionController extends Controller
{
    //
    public function index(){
        $refaccions = Refaccion::all();
        return view('refaccions.index', compact('refaccions'));
    }

    public function show(Refaccion $refaccion){
        return view('refaccions.show', compact('refaccion'));
    }
}

