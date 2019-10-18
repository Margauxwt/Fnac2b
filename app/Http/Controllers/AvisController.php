<?php

namespace App\Http\Controllers;
use App\Avis;
use App\Video;

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
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', "L'avis a bien été supprimé !");
        }
        return view('abusivenotice', ['avis' => Avis::getAvisAbusif()]);
    }

    public function signaleravis(){
        if(isset($_POST["Signaler"]))
        {
            Avis::signalerAvis($_POST["Signaler"]);
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', "L'avis a bien été signalé !");
        }
        return view('detail', ['video' => Video::getVideoByIdVid($_GET['id']), 'avis' => Avis::getAvisByIdVid($_GET['id'])]);
    }
}
