<?php

namespace App;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;


class Buyer extends Model
{
    use Notifiable;

    protected $table = "t_e_acheteur_ach";
    public $timestamps = false;
    protected $primaryKey = "ach_id";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ach_mel', 'ach_civilite', 'ach_nom', 'ach_prenom', 'ach_telfixe', 'ach_telportable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ach_id', 'ach_motdepasse', 'mag_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword() {
        return $this->ach_motdepasse;
    }

    public function getAddressLivraisonBuyer($id){ //Changement de nom de fonction //Retourne l'adresse de livraison de l'acheteur
        $adrLivraison = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_nom','t_e_adresse_adr.adr_rue','t_e_adresse_adr.adr_cp','t_e_adresse_adr.adr_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Livraison')
        ->get();

        $string = ""; 
        foreach($adrLivraison as $adr => $value){ //On retient seulement les informations essentielles
            if($string != "")
                $string = $string.", ".$value->adr_nom." ".$value->adr_rue.", ".$value->adr_cp." ".$value->adr_ville;
            else
                $string = $value->adr_nom." : ".$value->adr_rue.", ".$value->adr_cp." ".$value->adr_ville;
        }

        return $string;
    }
    
    public function getAddressFacturationBuyer($id){ //Changement de nom de fonction //Retourne l'adresse de facturation de l'acheteur
        $adrFacturation = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_nom','t_e_adresse_adr.adr_rue','t_e_adresse_adr.adr_cp','t_e_adresse_adr.adr_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Facturation')
        ->get();

        $string = "";
        foreach($adrFacturation as $adr => $value){ //On retient seulement les informations essentielles
            if($string != "")
                $string = $string.", ".$value->adr_nom." ".$value->adr_rue.", ".$value->adr_cp." ".$value->adr_ville;
            else
                $string = $value->adr_nom." : ".$value->adr_rue.", ".$value->adr_cp." ".$value->adr_ville;
        }

        return $string;
    }
    public static function getAddressIDBuyer($id){ //Changement de nom de fonction //Retourne l'adresse de facturation de l'acheteur
        $adrID = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_id')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Facturation')
        ->get();

        return $adrID;
    }
    //BEN
    public function getTablAdressFacturationBuyer($id){ //Changement de nom de fonction
        $adrFact = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_nom','t_e_adresse_adr.adr_rue','t_e_adresse_adr.adr_cp','t_e_adresse_adr.adr_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Facturation')
        ->get();

        $tablFact = [];
        foreach($adrFact as $adr => $value){
            $tablFact['nom'] = "".$value->adr_nom."";
            $tablFact['rue'] = "".$value->adr_rue."";
            $tablFact['cp'] = "".$value->adr_cp."";
            $tablFact['ville'] = "".$value->adr_ville."";
        }

        return $tablFact;
    }

    public function getTablAdressLivraisonBuyer($id){ //Changement de nom de fonction
        $adrLivr = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_nom','t_e_adresse_adr.adr_rue','t_e_adresse_adr.adr_cp','t_e_adresse_adr.adr_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Livraison')
        ->get();

        $tablFact = [];
        foreach($adrLivr as $adr => $value){
            if(isset($value->adr_nom))
                $tablFact['nom'] = "".$value->adr_nom."";
            else
                $tablFact['nom'] = "";
            if(isset($value->adr_rue))
                $tablFact['rue'] = "".$value->adr_rue."";
            else
                $tablFact['rue'] = "";
            if(isset($value->adr_cp))
                $tablFact['cp'] = "".$value->adr_cp."";
            else
                $tablFact['cp'] = "";
            if(isset($value->adr_ville))
                $tablFact['ville'] = "".$value->adr_ville."";
            else
                $tablFact['cp'] = "";
        }

        return $tablFact;
    }

    public function getMagasinPrefBuyer($id){ //Changement de nom de fonction //Retourne le magasin préféré de l'acheteur
        $magPref = DB::table('t_r_magasin_mag')
        ->select('t_r_magasin_mag.mag_nom','t_r_magasin_mag.mag_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.mag_id', '=', 't_r_magasin_mag.mag_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->get();

        $string = "";
        foreach($magPref as $adr => $value){
            if($string != "")
                $string = $string.", ".$value->mag_nom.", ".$value->mag_ville;
            else
                $string = $value->mag_nom.", ".$value->mag_ville;
        }

        return $string;
    }
}

