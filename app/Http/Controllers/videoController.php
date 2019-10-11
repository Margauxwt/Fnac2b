<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class videoController extends Controller
{
    public function all()
    {
        return view('visitorSearch', ['videos' => Video::all()]);
    }
    public function allComparator()
    {
        if(session()->get('video1') !== null && session()->get('video2') !== null)
            return view('videoComparator', ['video1' => Video::findOrFail(session()->get('video1')), 'video2' => Video::findOrFail(session()->get('video2'))]);
        else if(session()->get('video1') !== null)
            return view('videoComparator', ['video1' => Video::findOrFail(session()->get('video1')), 'video2' => Video::findOrFail($_POST["video2"])]);
        else
            return view('videoComparator', ['videos' => Video::all()]);
    }
    public function comparator()
    {
        return view('videoComparator', ['video1' => Video::findOrFail($_POST["video1"]), 'video2' => Video::findOrFail($_POST["video2"])]);
    }
    
    public function allRank()
    {
        return view('rankingVideo', ['videos' => Video::all()]);
    }

    public function detail(){
        if(isset($_POST["comparator"]) && !empty($_POST["comparator"]))
        {
            if(session()->get('video1') === null)
                session()->put('video1', $_POST["comparator"]);
            else if(session()->get('video2') === null)
                session()->put('video2', $_POST["comparator"]);
            else
                echo "<div class='error'>Vous avez deja choisis 2 vidéos</div>";
            return view('detail', ['video' => Video::getVideoByTitre($_GET['titre'])]);
        }
        else
            return view('detail', ['video' => Video::getVideoByTitre($_GET['titre'])]);
    }
    
}