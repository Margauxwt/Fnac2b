<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller {

    public function index(){
        return view('profil', ['users' => User::all()]);
    }

    public function indexAccountModify(){
        return view('modifyaccount', ['users' => User::all()]);
    }
    // public function indexAddressModify(){
    //     return view('modifyaccount', ['address' => User::getAddressUser()]);
    // }

    

    public function update() {
        if((isset($_POST['lastnameBuyer']))&&(isset($_POST['firstnameBuyer']))&&(isset($_POST['surnameBuyer']))&&(isset($_POST['mailBuyer']))&&(isset($_POST['genderBuyer']))&&(isset($_POST['fixedTelBuyer']))&&(isset($_POST['mobileTelBuyer'])))
        {       $idUser=4;
                DB::table('t_e_acheteur_ach')
                ->where('ach_id', $idUser)
                ->update(
                    ['ach_nom'=> $_POST['lastnameBuyer'],
                    'ach_prenom'=> $_POST['firstnameBuyer'],
                    'ach_pseudo'=> $_POST['surnameBuyer'],
                    'ach_mel'=> $_POST['mailBuyer'],
                    'ach_civilite'=> $_POST['genderBuyer'],
                    'ach_telfixe'=> $_POST['fixedTelBuyer'],
                    'ach_telportable'=> $_POST['mobileTelBuyer'],]);
                DB::table('t_e_adresse_adr');
                /*->where('ach_id', $idUser)
                ->update(
                    [
                        'adr_'
                    ])*/
                header("Refresh:0");
                Echo '<p>Vos modifications ont bien été enregistrées</p>';
        }
        else{
            Echo"<p>Nous n'avons pas pu enregistrer vos modifications...</p>";
        }

    }

    function add_user() {
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

    }

}