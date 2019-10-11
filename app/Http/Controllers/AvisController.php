<?php

namespace App\Http\Controllers;
use App\Avis;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AvisController extends Controller {
    public function allAvis(){
        return view('detail', ['avis' => Avis::all()]);
    }
}