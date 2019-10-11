<?php

namespace App\Http\Controllers;
use App\Video;
use App\Avis;
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
            return view('videoComparator', ['video1' => Video::findOrFail(session()->get('video1')),'videos' => Video::all()]);
        else
            return view('videoComparator', ['videos' => Video::all()]);
    }
    public function comparator()
    {
        if(isset($_POST["delete"]))
        {
            if(session()->get("video1") !== null)
                session()->forget("video1");
            if(session()->get("video2") !== null)
                session()->forget("video2");
            return view('welcome');
        }
        else{
            if(session()->get('video1') !== null)
                return view('videoComparator', ['video1' => Video::findOrFail(session()->get('video1')),'video2' => Video::findOrFail($_POST["video2"])]);
            else
                return view('videoComparator', ['video1' => Video::findOrFail($_POST["video1"]), 'video2' => Video::findOrFail($_POST["video2"])]);
        }
    }
    
    public function allRank()
    {
        return view('rankingVideo', ['videos' => Video::all()]);
    }

    /*
    public function updateRank()
    {
        
    }
    */
    

    public function detail(){
        if(isset($_POST["panier"]))
        {
            if(session()->get("panier") !== null)
            {
                session()->push("panier", $_POST["panier"]);
            }
            else
            {
                $panier = array(
                    $_POST["panier"]
                );
                session()->put("panier", $panier);
            }
        }
        else if(isset($_POST["comparator"]) && !empty($_POST["comparator"]))
        {
            if(session()->get('video1') === null)
                session()->put('video1', $_POST["comparator"]);
            else if(session()->get('video2') === null)
                session()->put('video2', $_POST["comparator"]);
            else
                echo "<div class='error'>Vous avez deja choisis 2 vidéos</div>";
        }
        return view('detail', ['video' => Video::getVideoByIdVid($_GET['id']), 'avis' => Avis::getAvisByIdVid($_GET['id'])]);
    }

    public function basket()
    {
        $videos = array();
        $i = 0;
        foreach(session()->get("panier") as $video)
        {
            if(isset($_POST["delete"]) && !empty($_POST["delete"]) && $video == $_POST["delete"])
            {
                session()->pull("panier",$video);
            }
            else
            {
                $videos[$i] = Video::where('vid_id', $video)->first();
                $i++;
            }
        }
        if($i == 0)
            return view('welcome');
        else
            return view('basket', ['videosAch'=> $videos]);
    }

    public function updateRank()
    {   $listVideo= DB::table('t_e_video_vid')
                    ->select('vid_id','vid_titre','vid_rank')
                    ->orderBy('vid_rank')
                    ->get();
        $rangSouhaite = $_POST['rang'];
        $rangDepart = $_POST['video'];
        $videoDep = DB::table('t_e_video_vid')
                    ->select('*')
                    ->where('vid_id', $rangDepart)
                    ->get();

        print_r($videoDep);
        if($rangSouhaite<=0)
        {
            echo "Ce rang n'est pas réalisable nous sommes désolé";
        }
        else {
            if($rangDepart>$rangSouhaite)
            {
                if($rangDepart=$rangSouhaite+1)
                {
                    DB::table('t_e_video_vid')
                    ->where('vid_id', $rangSouhaite)
                    ->update(
                        ['vid_id'=> $videoDep['vid_id'],
                        'for_id'=> $videoDep['for_id'],
                        'vid_titre'=> $videoDep['vid_titre'],
                        'vid_synopsis'=> $videoDep['vid_synopsis'],
                        'vid_dateparution'=> $videoDep['vid_dateparution'],
                        'vid_duree'=> $videoDep['vid_duree'],
                        'vid_publiclegal'=> $videoDep['vid_publiclegal'],
                        'vid_urlphoto'=> $videoDep['vid_urlphoto'],
                        'vid_prixttc'=> $videoDep['vid_prixttc'],
                        'vid_codebarre'=> $videoDep['vid_codebarre'],
                        'vid_stock'=> $videoDep['vid_stock'],
                        'vid_rank'=> $rangDepart,]);
                    DB::table('t_e_video_vid')
                    ->where('vid_id', $rangDepart)
                    ->update(
                        ['vid_id'=> $videoDep['vid_id'],
                        'for_id'=> $videoDep['for_id'],
                        'vid_titre'=> $videoDep['vid_titre'],
                        'vid_synopsis'=> $videoDep['vid_synopsis'],
                        'vid_dateparution'=> $videoDep['vid_dateparution'],
                        'vid_duree'=> $videoDep['vid_duree'],
                        'vid_publiclegal'=> $videoDep['vid_publiclegal'],
                        'vid_urlphoto'=> $videoDep['vid_urlphoto'],
                        'vid_prixttc'=> $videoDep['vid_prixttc'],
                        'vid_codebarre'=> $videoDep['vid_codebarre'],
                        'vid_stock'=> $videoDep['vid_stock'],
                        'vid_rank'=> $rangDepart,]);
                }

            }
            else if ($rangDepart<$rangSouhaite)
            {
                echo'yo2';
                echo 'rangDepart : '.$rangDepart;
                echo 'rangSouhait : '.$rangSouhaite;
            }
        }
        
        
    }
}