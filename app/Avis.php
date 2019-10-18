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

    public static function supprAvis($id){
        $avis = DB::table('t_j_avisabusif_ava')
        ->select('*')
        ->where('t_j_avisabusif_ava.avi_id', '=', $id)
        ->delete();
        $avis = DB::table('t_e_avis_avi')
        ->select('*')
        ->where('t_e_avis_avi.avi_id', '=', $id)
        ->delete();
    }

    public static function addAvis($value){
        DB::table('t_e_avis_avi')
        ->insert([
            'ach_id' => $value[3][1], 
            'vid_id' => $value[3][0],
            'avi_titre' => $value[1],
            'avi_detail' => $value[2],
            'avi_note' => $value[0],
            'avi_nbutileoui' => 0,
            'avi_nbutilenon' => 0
        ]);
    }

    public static function getAvisAbusif(){
        $avis = DB::table('t_e_avis_avi')
        ->select('*')
        ->join('t_j_avisabusif_ava', 't_j_avisabusif_ava.avi_id', '=', 't_e_avis_avi.avi_id')
        ->get();
        return $avis;
    }

    public static function signalerAvis($idAvis){
        $id = DB::table('t_e_acheteur_ach')
        ->select('t_e_acheteur_ach.ach_id')
        ->join('t_e_avis_avi', 't_e_avis_avi.ach_id', '=', 't_e_acheteur_ach.ach_id')
        ->where('t_e_avis_avi.avi_id', '=', $idAvis)
        ->get();
        $avisabusif = DB::table('t_j_avisabusif_ava')
        ->where('avi_id', '=', $idAvis)
        ->first();
            if ($avisabusif === null) {
                $id = $id[0]->ach_id;
                DB::table('t_j_avisabusif_ava')->insert(['ach_id' => $id, 'avi_id' => $idAvis]);
            }
            else{
                
            }
            
        
    }

        
    public static function create($id, $idAvis){
        $data = new Avis;
        $data->ach_id = $id;
        $data->avi_id = $idAvis;
        $data->save();
    }

    public static function addOui($idAvis){
        DB::table('t_e_avis_avi')
        ->where('t_e_avis_avi.avi_id', '=', $idAvis)
        ->increment('t_e_avis_avi.avi_nbutileoui', 1);
    }

    public static function addNon($idAvis){
        DB::table('t_e_avis_avi')
        ->where('t_e_avis_avi.avi_id', '=', $idAvis)
        ->increment('t_e_avis_avi.avi_nbutilenon', 1);
    }
}

