<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Relais extends Model
{
    protected $table = "t_e_relais_rel";
    protected $primaryKey = "rel_id";
    public $timestamps = true;

    protected $fillable = [
        "rel_id",
    ];

    public static function getRelais(){
        $relais = DB::table('t_e_relais_rel')
        ->select('t_e_relais_rel.rel_rue','t_e_relais_rel.rel_cp','t_e_relais_rel.rel_ville')
        ->get();

        $tabl[] ='';
        $string = "";
        foreach($relais as $rel => $value){ //On retient seulement les informations essentielles
            if($string != "")
                $tabl[] = ", ".$value->rel_rue." ".$value->rel_cp.", ".$value->rel_ville;
            else
                $tabl[] = $value->rel_rue." : ".$value->rel_cp.", ".$value->rel_ville;
        }

        return $tabl;
    }
}