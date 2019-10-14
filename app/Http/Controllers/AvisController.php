<?php

namespace App\Http\Controllers;
use App\Avis;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AvisController extends Controller {
    public function allAvis(){
        return view('detail', ['avis' => Avis::all()]);
    }

    public function AvisAbusif(){
        return view('abusivenotice', ['avis' => Avis::getAvisAbusif()]);
    }

    public function suppravis(){
        if(isset($_POST["Supprimer"]))
        {
            Avis::supprAvis($_POST["Supprimer"]);
        }
        return view('abusivenotice', ['avis' => Avis::getAvisAbusif()]);
    }
}
