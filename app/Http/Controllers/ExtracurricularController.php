<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $eksul = Extracurricular::all();
        return view('extracurricular', compact('eksul'));
    }
}
