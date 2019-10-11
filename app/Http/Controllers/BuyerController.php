<?php

namespace App\Http\Controllers;
use App\Buyer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BuyerController extends Controller {

    public function index(){
        return view('profil', ['users' => Buyer::all()]);
    }

    public function indexAccountModify(){
        return view('modifyaccount', ['users' => Buyer::all()]);
    }


    

    public function update() {
        if((isset($_POST['lastnameBuyer']))&&(isset($_POST['firstnameBuyer']))&&(isset($_POST['surnameBuyer']))&&(isset($_POST['mailBuyer']))&&(isset($_POST['genderBuyer']))&&(isset($_POST['fixedTelBuyer']))&&(isset($_POST['mobileTelBuyer'])))
        {       $idUser=4;
                DB::table('t_e_acheteur_ach')
                ->where('ach_id', $idUser)
                ->update(
                    ['ach_nom'=> $_POST['lastnameBuyer'],
                    'ach_prenom'=> $_POST['firstnameBuyer'],
                    'ach_pseudo'=> $_POST['surnameBuyer'],
                    'ach_civilite'=> $_POST['genderBuyer'],
                    'ach_telfixe'=> $_POST['fixedTelBuyer'],
                    'ach_telportable'=> $_POST['mobileTelBuyer'],]);
                    
                // DB::table('t_e_adresse_adr')
                // ->where('ach_id', $idUser)
                // ->update(
                //     [
                //         'ach_id' => $idUser,
                //         'adr_nom'=> $_POST['nameAdrFact'],
                //         'adr_rue'=> $_POST['rueAdrFact'],
                //         'adr_cp'=> $_POST['cpAdrFact'],
                //         'adr_ville'=> $_POST['cityAdrFact'],
                //         'adr_type' => 'Facturation',                     
                //     ]);
                
                // DB::table('t_e_adresse_adr')
                // ->where('ach_id', $idUser)
                // ->update(
                //     [
                //         'ach_id' => $idUser,
                //         'adr_nom'=> $_POST['nameAdrLivr'],
                //         'adr_rue'=> $_POST['rueAdrLivr'],
                //         'adr_cp'=> $_POST['cpAdrLivr'],
                //         'adr_ville'=> $_POST['cityAdrLivr'],
                //         'adr_type' => 'Livraison',                     
                //     ]);
                //header("Refresh:0");
                return view('modifyaccount', ['users' => Buyer::all()]);
                Echo '<p>Vos modifications ont bien été enregistrées</p>';
        }
        else{
            Echo"<p>Nous n'avons pas pu enregistrer vos modifications...</p>";
        }

    }

    function add_user() {
        if($_POST['fixedtelInscription'] == '' && $_POST['mobiletelInscription'] == '' ){
            echo "<p style='color:red;'> Veuillez  remplir au moins un des champs marqués d'un **</p>";
            return view('/register');
        }

        foreach(Buyer::all()->FindOrFail() as $buyer)
        {
            if($buyer["ach_mel"] == $_POST["mailInscription"])
            {
                echo "<p style='color:red;'> Pseudo déjà utilisé. Veuillez choisir un autre pseudo.</p>";
                return view('/register');
            }
        }

            DB::table('t_e_acheteur_ach')
            ->insert(
                ['ach_nom'=> $_POST['lastnameInscription'],
                'ach_prenom'=> $_POST['surnameInscription'],
                'ach_mel'=> $_POST['mailInscription'],
                'ach_civilite'=> $_POST['genderInscription'],
                'ach_pseudo'=> $_POST['pseudoInscription'],
                'ach_telfixe'=> $_POST['fixedtelInscription'],
                'ach_telportable'=> $_POST['mobiletelInscription'],
                'ach_motpasse'=> $_POST['passwordInscription'],]);
            header("Refresh:0");
            return view('/login');
            

    }

}