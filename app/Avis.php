<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Avis extends Model
{
    protected $table = "t_e_avis_avi";
    protected $primaryKey = "avi_id";
    public $timestamps = false;

    public static function getAvisByIdVid($id){
        $avis = DB::table('t_e_avis_avi')
            ->select('*')
            ->join('t_e_acheteur_ach', 't_e_avis_avi.ach_id', '=', 't_e_acheteur_ach.ach_id')
            ->where('vid_id', $id)
            ->distinct()
            ->orderBy('avi_date', 'desc')
            ->orderBy('avi_note', 'asc')
            ->get();
            return $avis;
    }

    public function getPseudoClientByIdAvis($id){
        $pseudos = DB::table('t_e_acheteur_ach')
        ->select('t_e_acheteur_ach.ach_pseudo')
        ->join('t_e_avis_avi', 't_e_avis_avi.ach_id', '=', 't_e_acheteur_ach.ach_id')
        ->where('t_e_acheteur_ach.ach_id', $id)
        ->distinct()
        ->get();
    
        $string = "";
        foreach($pseudos as $pseudo => $value){
            if($string != "")
                $string = $string.", ".$value->ach_pseudo;
            else
                $string = $value->ach_pseudo;
        }
        return $string;
    }

    public function supprAvis($id){
        DB::table('t_e_avis_avi')
        ->where('t_e_avis_avi.avi_id', '=', $id)
        ->delete();
    }
}

