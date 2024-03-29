<?php
 
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $table = "t_e_video_vid";
    protected $primaryKey = "vid_id";
    public $timestamps = false;

    public function getActor(){
        $actors = DB::table('t_e_video_vid')
            ->join('t_j_acteurvideo_acv', 't_j_acteurvideo_acv.vid_id', '=', 't_e_video_vid.vid_id')
            ->join('t_e_acteur_act', 't_j_acteurvideo_acv.act_id', '=', 't_e_acteur_act.act_id')
            ->select('t_e_acteur_act.act_nom')
            ->where('t_j_acteurvideo_acv.vid_id', $this->attributes['vid_id'])
            ->distinct()
            ->get();
            
        $string = "";
        foreach($actors as $actor => $value){
            if($string != "")
                $string = $string.", ".$value->act_nom;
            else
                $string = $value->act_nom;
        }
        return $string;
    }
    public function getAuthor(){
        $authors = DB::table('t_e_video_vid')
            ->join('t_e_realisateur_rea', 't_e_realisateur_rea.rea_id', '=', 't_e_video_vid.rea_id')
            ->select('t_e_realisateur_rea.rea_nom')
            ->where('t_e_realisateur_rea.rea_id', $this->attributes['rea_id'])
            ->distinct()
            ->get();
        
            $string = "";
            foreach($authors as $author => $value){
                if($string != "")
                    $string = $string.", ".$value->rea_nom;
                else
                    $string = $value->rea_nom;
            }
            return $string;
    }

    public static function getVideoByIdVid($id){
        $video = DB::table('t_e_video_vid')
            ->select('*')
            ->where('t_e_video_vid.vid_id', $id)
            ->distinct()
            ->get();
            return $video[0];
    }

    public static function testCommande($idVid, $idBuyer){
        $commande = DB::table('t_e_commande_com')
        ->select('*')
        ->join('t_j_lignecommande_lec', 't_j_lignecommande_lec.com_id', '=', 't_e_commande_com.com_id')
        ->where('t_e_commande_com.ach_id', '=', $idBuyer)
        ->where('t_j_lignecommande_lec.vid_id', '=', $idVid)
        ->get();
        if(count($commande) != 0)
            return true;
        else
            return false;
    }
    public function getAuthorById($id){
        $authors = DB::table('t_e_video_vid')
            ->join('t_e_realisateur_rea', 't_e_realisateur_rea.rea_id', '=', 't_e_video_vid.rea_id')
            ->select('t_e_realisateur_rea.rea_nom')
            ->where('t_e_realisateur_rea.rea_id', $id)
            ->distinct()
            ->get();
        
            $string = "";
            foreach($authors as $author => $value){
                if($string != "")
                    $string = $string.", ".$value->rea_nom;
                else
                    $string = $value->rea_nom;
            }
            return $string;
    }


}

