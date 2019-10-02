<?php

namespace App\Http\Controllers;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;


class modifyController extends Controller
{
    public function begin() {
        
        $buyers = DB::table('t_e_acheteur_ach')->get();
        $buyer=$buyers[3];
        $offsetBuyer = (array)$buyer;
        $adressesPerso = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->get();  
        $adresseFact = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->where('adr_type', 'Facturation')->get();
        $adresseLivr = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->where('adr_type', 'Livraison')->get();
    
        $offsetAdresseFact = modifyController::offset($adresseFact);
        $offsetAdresseLivr = modifyController::offset($adresseLivr);

        foreach($offsetBuyer as $key=>$val) {
            session([$key => $val]);
        }
        foreach($offsetAdresseFact as $key=>$val) {
            session([$key => $val]);
        }
        return view("modifyaccount");
    }

    public function offset($add) {
        $temp=[];
        foreach($add as $val) {
            foreach ($val as $key => $tab) {
                $temp[$key] = $tab;
            }
        }
        return $temp;
    }
                

    function update() {
        $buyers = DB::table('t_e_acheteur_ach')->get();
        $buyer=$buyers[0];
        $offsetBuyer = (array)$buyer;
        if((isset($_POST['lastnameBuyer']))&&(isset($_POST['firstnameBuyer']))&&(isset($_POST['surnameBuyer']))&&(isset($_POST['mailBuyer']))&&(isset($_POST['genderBuyer']))&&(isset($_POST['fixedTelBuyer']))&&(isset($_POST['mobileTelBuyer'])))
        {
            DB::table('t_e_acheteur_ach')
            ->where('ach_id', 4)
            ->update(
                ['ach_nom'=> $_POST['lastnameBuyer'],
                'ach_prenom'=> $_POST['firstnameBuyer'],
                'ach_pseudo'=> $_POST['surnameBuyer'],
                'ach_mel'=> $_POST['mailBuyer'],
                'ach_civilite'=> $_POST['genderBuyer'],
                'ach_telfixe'=> $_POST['fixedTelBuyer'],
                'ach_telportable'=> $_POST['mobileTelBuyer'],]);
            header("Refresh:0");
            Echo '<p>Vos modifications ont bien été enregistrées</p>';
        }

    }
}