<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EchofaIndexController extends Controller
{
    public function index()
    {
        return view('echofaIndex');
    }
}
