<?php

namespace App\Http\Controllers;
use App\User;
use App\Buyer;
use App\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    protected function create()
    {
        DB::table('users')
            ->insert(
                ['name'=> $_POST['name'],
                'email'=> $_POST['mail'],
                'password'=> bcrypt($_POST['password']),
                'type'=> $_POST['type'],]);
            header("Refresh:0");
    }
    public static function login()
    {
        
        if(isset($_POST["type"]) && $_POST["type"] != "acheteur")
        {
            $auth = User::where("email",$_POST["email"])->firstOrFail();
            //if (Hash::check($_POST["password"], $auth->password)) {
                session_start();
                session()->put('auth', $auth);

                if(session()->get('messages') === null)
                    session()->put('messages', array());
                session()->push('messages', 'Vous etes connecté !');

                return view('welcome');
            //}
        }
        else if(isset($_POST["type"]) && $_POST["type"] == "acheteur")
        {
            //if (Hash::check($_POST["password"], $auth->ach_motpasse)) {
                try{
                    $auth = Buyer::where("ach_mel",$_POST["email"])->firstOrFail();
                    session_start();
                    session()->put('auth', $auth);

                    if(session()->get('messages') === null)
                        session()->put('messages', array());
                    session()->push('messages', 'Vous etes connecté !');

                    return redirect('/');
                } catch (\Exception $e) {
                    if(session()->get('errors') === null)
                        session()->put('errors', array());
                    session()->push('errors', "La combinaison password/login n'est pas correct");

                    return redirect('login');
                }

            //}
        }

    }
    public static function logout()
    {
        if(session()->get('auth') !== null)
        {
            session()->forget('auth');
            session()->forget('video1');
            session()->forget('video2');
            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', "Vous etes déconnecté !");  
        }
        return view('welcome');
    }



    function add_actor() {
        foreach(Actor::all() as $actor)
        {
             if($actor["act_nom"] == $_POST["NameActor"])
             {
                if(session()->get('errors') === null)
                    session()->put('errors', array());
                session()->push('errors', 'Acteur déjà existant.');
                 return view('newActor');
             }
        }

            DB::table('t_e_acteur_act')
            ->insert(
                ['act_nom'=> $_POST['NameActor'],]);

            if(session()->get('messages') === null)
                session()->put('messages', array());
            session()->push('messages', "Acteur enregistré !");  
            return view('newActor');                  
    }
    public function manage()
    {
        if(isset($_POST["change"]) && !empty($_POST["change"]))
        {
            User::where('id', $_POST["change"])->update(['type' => $_POST["type"]]);
        }
        return view("manage", ["users" => User::orderBy('type')->get()]);
    }

}