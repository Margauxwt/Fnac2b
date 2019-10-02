<?php

namespace App\Http\Controllers;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller {

    public function chargerInfos($id, $route){
        $data['id'] = $id;
        $data['route'] = $route;
        $buyers = DB::table('t_e_acheteur_ach')->get();
        $buyer=$buyers[$id];
        $offsetBuyer = (array)$buyer;
        $adressesPerso = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->get();  
        $adresseFact = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->where('adr_type', 'Facturation')->get();
        $adresseLivr = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->where('adr_type', 'Livraison')->get();
    
        $offsetAdresseFact = modifyController::offset($adresseFact);
        $offsetAdresseLivr = modifyController::offset($adresseLivr);

        foreach($offsetBuyer as $key=>$val) {
            session([$key => $val]);
        }
        return view("$route");
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
}