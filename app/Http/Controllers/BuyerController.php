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


    

    public function modify() {
        if(isset($_POST["modify"])) {
            Buyer::updateModify($_POST["modify"]);
        }
        return view("profil", ['users' => Buyer::all()]);
    }

    function add_user() {
        if($_POST['fixedtelInscription'] == '' && $_POST['mobiletelInscription'] == '' ){
            if(session()->get('errors') === null)
                session()->put('errors', array());
            session()->push('errors', "Veuillez  remplir au moins un des champs marqués d'un **");
            return view('/register');
        }

        foreach(Buyer::all() as $buyer)
        {
            if($buyer["ach_mel"] == $_POST["mailInscription"])
            {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', "Mail déjà utilisé. Veuillez choisir un autre Mail.");
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
                
            $idBuyer = DB::table('t_e_acheteur_ach')
            ->select('ach_id')
            ->where('ach_mel','=',$_POST['mailInscription'])
            ->get();
                
             DB::table('t_e_adresse_adr')
             -> insert(
                 ['adr_nom' => ' ',
                  'adr_type' => 'Facturation',
                  'adr_nom' => ' ',
                  'adr_rue' => ' ',
                  'adr_complementrue' => ' ',
                  'adr_cp' => ' ',                 
                  'adr_ville' => ' ',
                  'pay_id' => '1',
                  'adr_latitude' => '50',
                  'adr_longitude' => '50',
                  'ach_id' => $idBuyer[0]->ach_id,
                 ]);
            
                 DB::table('t_e_adresse_adr')
                 -> insert(
                     ['adr_nom' => ' ',
                      'adr_type' => 'Livraison',
                      'adr_nom' => ' ',
                      'adr_rue' => ' ',
                      'adr_complementrue' => ' ',
                      'adr_cp' => ' ',                 
                      'adr_ville' => ' ',
                      'pay_id' => '1',
                      'adr_latitude' => '50',
                      'adr_longitude' => '50',
                      'ach_id' => $idBuyer[0]->ach_id,
                     ]);            
                
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', "Compte enregistré");  
            return view('welcome');
    }

}