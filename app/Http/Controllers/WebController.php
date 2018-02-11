<?php

namespace DesafioTecnicoMoip\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        return view('welcome');
    }
}
