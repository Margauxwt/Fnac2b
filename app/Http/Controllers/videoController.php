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
use App\Favorite;
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
        return view('rankingVideo', ['videos' => Video::orderBy('vid_rank')->get()]);
    }

    public function detail(){
        if(isset($_POST['favorite']) && !empty($_POST['favorite']))
        {
            Favorite::addFavorite(session()->get('auth')['ach_id'],$_POST["favorite"]);
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', 'La video a bien été ajoutée dans vos favoris !');
        }
        else if(isset($_POST["ajouteravis"]))
        {
            if(empty($_POST["Note"]) || empty($_POST["Titre"]) || empty($_POST["Commentaire"])){
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Veuillez remplir tous les champs pour ajouter un avis');
            }
            else{
                $string = '';
                $string = explode(',', $_POST['ajouteravis']);
                $avis = [$_POST['Note'], $_POST['Titre'], $_POST['Commentaire'], $string];
                Avis::addAvis($avis);
                if(session()->get('messages') === null)
                    session()->put('messages', array());
                session()->push('messages', 'L\'avis a bien été créé !');
            }
        }
        else if(isset($_POST["Signaler"]))
        {
            Avis::signalerAvis($_POST["Signaler"]);
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', 'La video a bien été signalée !');
        }
        else if(isset($_POST["avisutile"]))
        {
            Avis::addOui($_POST["avisutile"]);
        }
        else if(isset($_POST["avisnonutile"]))
        {
            Avis::addNon($_POST["avisnonutile"]);
        }
        else if(isset($_POST["panier"]))
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
            {
                session()->put('video2', $_POST["comparator"]);
                if(session()->get('messages') === null)
                    session()->put('messages', array());
                session()->push('messages', 'Le comparateur vidéo est prêt !');
            }
            else
            {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Vous avez deja choisis 2 videos !');
            }
        }
        return view('detail', ['video' => Video::getVideoByIdVid($_GET['id']), 'avis' => Avis::getAvisByIdVid($_GET['id']), 'bool' => Video::testCommande($_GET['id'], session()->get('auth')['ach_id'])]);
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
            
            if(isset($_POST["relais"]) && !empty($_POST["relais"]) && $_POST["relais"] != "default")
            {
                if($_POST["relais"] == "myRelais")
                    $adr = session()->get('rel_id');
                else
                    $adr = $_POST["relais"];
                $champ = "rel_id";
            }
            else if(isset($_POST["magasin"]) && !empty($_POST["magasin"]) && $_POST["magasin"] != "default")
            {
                $adr = $_POST["magasin"];
                $champ = "mag_id";
            }
            else if($_POST['buy'] == 'me')
            {
                $adr = Adress::where('ach_id', session()->get("auth")["ach_id"])->get("adr_id")[0]["adr_id"];
                $champ = "adr_id";
            }
            else
            {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Vous devez choisir un argument autre que default');
                return redirect('basket');
            }
            
            $date = \Carbon\Carbon::now()->toDateTimeString();
            $order = Order::create($champ, $adr, $date);
            foreach(session()->get("panier") as $video)
            {
                OrderLign::create($order, $video);
            }
            session()->forget("panier");
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', 'Votre commande a bien été traitée !');
            return redirect('/');
            
        }
        else if(isset($_POST["order"]))
        {

            return view('order',['videosAch'=> $videos, 'prix' => $prix, 'magasins' => Magasin::All(), 'relais' => Relais::All()]);
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

        $videoSouh = Video::select('*')
                    ->where('vid_rank', $rangSouhaite)
                    ->get();


        if($rangSouhaite>0)
        {
            if($rangSouhaite > count($listVideo))
            {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Vous avez choisis un rang trop élevé');
            }
            else if($videoDep[0]->vid_rank == $rangSouhaite+1 || $videoDep[0]->vid_rank == $rangSouhaite-1 )
            {
                DB::table('t_e_video_vid')
                    ->where('vid_id', $videoSouh[0]->vid_id)
                    ->update(
                        [
                             'vid_rank'=> $videoDep[0]->vid_rank,
                         ]);

                DB::table('t_e_video_vid')
                    ->where('vid_id', $idVidDepart)
                    ->update(
                        [
                            'vid_rank'=> $rangSouhaite,
                        ]);
            }
            else if($videoDep[0]->vid_rank>$rangSouhaite)
            {
                for($i = $rangSouhaite-1; $i <= count($listVideo)-1; $i++)
                {
                    if($listVideo[$i]->vid_rank == $videoDep[0]->vid_rank)
                    {
                        DB::table('t_e_video_vid')
                            ->where('vid_id', $listVideo[$i]->vid_id)
                            ->update(
                                [
                                    'vid_rank'=> $rangSouhaite,
                                ]);
                    }      
                    else
                    {
                        DB::table('t_e_video_vid')
                            ->where('vid_id', $listVideo[$i]->vid_id)
                            ->update(
                                [
                                    'vid_rank'=> $listVideo[$i]->vid_rank+1,
                                ]);
                            
                    }
                }
            }
            else if ($videoDep[0]->vid_rank<$rangSouhaite)
            {
                for($i = $rangSouhaite-1; $i >= 0; $i--)
                {
                    if($listVideo[$i]->vid_rank == $videoDep[0]->vid_rank)
                    {
                        DB::table('t_e_video_vid')
                            ->where('vid_id', $listVideo[$i]->vid_id)
                            ->update(
                                [
                                    'vid_rank'=> $rangSouhaite,
                                ]);
                    }
                    else
                    {
                        DB::table('t_e_video_vid')
                            ->where('vid_id', $listVideo[$i]->vid_id)
                            ->update(
                                [
                                    'vid_rank'=> $listVideo[$i]->vid_rank-1,
                                ]);
                    }
                }
            }
            else if($videoDep[0]->vid_rank == $rangSouhaite)
            {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Vous avez choisi le même rang que celui de la vidéo choisie !');
            }
            else{
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Oops ...');
            }
            
        }
        else {
            if(session()->get('errors') === null)
                session()->put('errors', array());
            session()->push('errors', "Ce rang n'est pas réalisable nous sommes désolé (Rang <=0)");
        }
        return view('rankingVideo', ['videos'=> Video::orderBy('vid_rank')->get()]);
        
    }
}