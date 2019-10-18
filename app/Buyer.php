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
    public function getTablAdressFacturationBuyer($id){ //Changement de nom de fonction
        $adrFact = DB::table('t_e_adresse_adr')
        ->select('t_e_adresse_adr.adr_nom','t_e_adresse_adr.adr_rue','t_e_adresse_adr.adr_cp','t_e_adresse_adr.adr_ville')
        ->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_adresse_adr.ach_id')
        ->where('t_e_acheteur_ach.ach_id', '=', $id)
        ->where('t_e_adresse_adr.adr_type', '=', 'Facturation')
        ->get();

        $tablFact = [];
        foreach($adrFact as $adr => $value){
            if(!isset($tablFact['nom']))
                $tablFact['nom'] = "".$value->adr_nom."";
            else
                $tablFact['nom'] = "yo";
            
            if(!isset($tablFact['rue']))
                $tablFact['rue'] = "".$value->adr_rue."";
            else
                $tablFact['rue'] = "yo";
            if(!isset($tablFact['cp']))
                $tablFact['cp'] = "".$value->adr_cp."";
            else
                $tablFact['cp'] = 'yo';
            if(!isset($tablFact['ville']))
                $tablFact['ville'] = "".$value->adr_ville."";
            else
                $tablFact['ville'] = 'yo';
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

    public static function updateModify($id)
    {
        if((isset($_POST['lastnameBuyer']))&&(isset($_POST['firstnameBuyer']))&&(isset($_POST['surnameBuyer']))&&(isset($_POST['mailBuyer']))&&(isset($_POST['genderBuyer']))&&(isset($_POST['fixedTelBuyer']))&&(isset($_POST['mobileTelBuyer'])))
        {       
            DB::table('t_e_acheteur_ach')
            ->where('ach_id', $id)
            ->update(
                ['ach_nom'=> $_POST['lastnameBuyer'],
                'ach_prenom'=> $_POST['firstnameBuyer'],
                'ach_pseudo'=> $_POST['surnameBuyer'],
                'ach_civilite'=> $_POST['genderBuyer'],
                'ach_telfixe'=> $_POST['fixedTelBuyer'],
                'ach_telportable'=> $_POST['mobileTelBuyer'],]);
        }
        else{
            Echo"<p>Nous n'avons pas pu enregistrer vos modifications...</p>";
        }
        
        if((isset($_POST['nameAdrFact']))&&(isset($_POST['rueAdrFact']))&&(isset($_POST['cpAdrFact']))&&(isset($_POST['cityAdrFact']))) {
            DB::table('t_e_adresse_adr')
            ->where('ach_id', $id)
            ->where('adr_type', 'Facturation')
            ->update(
                [
                    'ach_id' => $id,
                    'adr_nom'=> $_POST['nameAdrFact'],
                    'adr_rue'=> $_POST['rueAdrFact'],
                    'adr_cp'=> $_POST['cpAdrFact'],
                    'adr_ville'=> $_POST['cityAdrFact'],
                    'adr_type' => 'Facturation',                     
                ]);
        }
        else{
            Echo"<p>Nous n'avons pas pu enregistrer vos modifications...</p>";
        }
        if((isset($_POST['nameAdrLivr']))&&(isset($_POST['rueAdrLivr']))&&(isset($_POST['cpAdrLivr']))&&(isset($_POST['cityAdrLivr']))) {
            DB::table('t_e_adresse_adr')
            ->where('ach_id', $id)
            ->where('adr_type', 'Livraison')
            ->update(
                [
                    'ach_id' => $id,
                    'adr_nom'=> $_POST['nameAdrLivr'],
                    'adr_rue'=> $_POST['rueAdrLivr'],
                    'adr_cp'=> $_POST['cpAdrLivr'],
                    'adr_ville'=> $_POST['cityAdrLivr'],
                    'adr_type' => 'Livraison',                     
                ]);
        }
        else{
            Echo"<p>Nous n'avons pas pu enregistrer vos modifications...</p>";
        }

        $relaisBuyer = DB::table('t_j_relaisacheteur_rea')
        ->select('*')
        ->where('t_j_relaisacheteur_rea.ach_id', $id)
        ->get();

        
        $varUpdate=0;
        for($i=0;$i<count($relaisBuyer)-1;$i++) {
            if($_POST['relais'] != $relaisBuyer[$i]->ach_id)
                $varUpdate = 1;
        }
        
        if($varUpdate == 1) {
            if($_POST['relais'] != 0) {
                DB::table('t_j_relaisacheteur_rea')
                ->insert(
                    [
                        'ach_id' => $id,
                        'rel_id' => $_POST['relais'],
                    ]
                );
                if(isset(session()->get('auth')['rel_id']))
                {
                    
                }
                else
                {
                    if(session()->get('errors') === null)
                        session()->put('errors', array());
                    session()->push('errors', 'Vous devez choisir un argument autre que default');
                }

            }
        }
        else {
            if($_POST['relais'] != 0) {
                DB::table('t_j_relaisacheteur_rea')
                ->where('t_j_relaisacheteur_rea.ach_id',$id)
                ->update(
                    [
                        'rel_id' => $_POST['relais'],
                    ]
                );
                if(session()->get('rel_id') === null)
                    session(['rel_id' => $_POST['relais']]);
                session(['rel_id' => $_POST['relais']]);
            }
        }
        
        



        
        
                
        
    

    }

}