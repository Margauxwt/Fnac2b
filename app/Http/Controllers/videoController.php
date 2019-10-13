<?php

namespace App\Http\Controllers;
use App\Http\Controllers\OrderController;
use App\Video;
use App\Avis;
use App\Adress;
use App\Magasin;
use App\Relais;
use App\Order;
use App\OrderLign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class videoController extends Controller
{
    public function all()
    {
        return view('visitorSearch', ['videos' => Video::orderBy('vid_rank')->get()]);
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
        $prix = 0;
        $i = 0;
        $once = false;
        foreach(session()->get("panier") as $video)
        {
            if(isset($_POST["delete"]) && !empty($_POST["delete"]) && $video == $_POST["delete"] && $once == false)
            {
                session()->forget("panier.".array_search($_POST["delete"],session()->get("panier")));
                $once = true;
            }
            else
            {
                $videoCurrent = Video::where('vid_id', $video)->first();
                $videos[$i] = $videoCurrent;
                $prix += $videoCurrent->vid_prixttc;
                $i++;
            }
            
        }
        if(isset($_POST["buy"]))
        {
            if($_POST["type"] == "Me")
            {
                $adr = Adress::where('ach_id', session()->get("auth")["ach_id"])->get("adr_id")[0]["adr_id"];
                $champ = "adr_id";
            }
            else 
            {
                if($_POST["type"] == "Relais")
                {
                    $adr = Relais::where('rel_nom', $_POST["adr"])->get("rel_id")[0]["rel_id"];
                    $champ = "rel_id";
                }
                else
                {
                    $adr = Magasin::where('mag_nom', $_POST["adr"])->get("mag_id")[0]["mag_id"];
                    $champ = "mag_id";
                }
            }
            $date = \Carbon\Carbon::now()->toDateTimeString();
            $order = Order::create($champ, $adr, $date);
            foreach(session()->get("panier") as $video)
            {
                OrderLign::create($order, $video);
            }
            session()->forget("panier");
            echo "votre commande a bien été enregistrée !";
            return view('weclome');
        }
        else if(isset($_POST["order"]))
        {
            return view('order',['videosAch'=> $videos, 'prix' => $prix]);
        }
        else if($i == 0)
        {
            session()->forget("panier");
            return view('welcome');
        }
        else
            return view('basket', ['videosAch'=> $videos, 'prix' => $prix]);
    }

    public function updateRank()
    {   
        $listVideo= DB::table('t_e_video_vid')
                    ->select('*')
                    ->orderBy('vid_rank')
                    ->get();
        $idVidDepart = $_POST['video'];
        $rangSouhaite = $_POST['rang'];
        $videoDep = DB::table('t_e_video_vid')
                    ->select('*')
                    ->where('vid_id', $idVidDepart)
                    ->get();

        $videoSouh = DB::table('t_e_video_vid')
                    ->select('*')
                    ->where('vid_rank', $rangSouhaite)
                    ->get();
        if($rangSouhaite>0)
        {
            if($videoDep[0]->vid_rank>$rangSouhaite)
            {
                // echo'<br>Depart > Souhait';
                // echo '<br>rangDepart : '.$videoDep[0]->vid_rank;
                // echo '<br>rangSouhait : '.$rangSouhaite;

                if($videoDep[0]->vid_rank=$rangSouhaite+1)
                {
                    // echo '<br> Ecart de 1';
                    $vartemp = $rangSouhaite;
                    DB::table('t_e_video_vid')
                    ->where('vid_rank', $rangSouhaite)
                    ->update(
                        [
                            'vid_rank'=> $videoDep[0]->vid_rank,
                        ]);

                    DB::table('t_e_video_vid')
                    ->where('vid_rank', $videoDep[0]->vid_rank)
                    ->update(
                        [
                        'vid_rank'=> $vartemp,
                        ]);
                        Echo 'Rang ajouté';
                }


            }
            else if ($videoDep[0]->vid_rank<$rangSouhaite)
            {
                echo'<br>Depart < Souhait';
                echo '<br>rangDepart : '.$videoDep[0]->vid_rank;
                echo '<br>rangSouhait : '.$rangSouhaite;
            }
        }
        else {
            echo "Ce rang n'est pas réalisable nous sommes désolé (Rang <=0)";
        }


        
        
    }
}