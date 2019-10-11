<?php

namespace App\Http\Controllers;
use App\User;
use App\Buyer;
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
            if (Hash::check($_POST["password"], $auth->password)) {
                session_start();
                session()->put('auth', $auth);
                return view('welcome');
            }
        }
        else if(isset($_POST["type"]) && $_POST["type"] == "acheteur")
        {
            $auth = Buyer::where("ach_mel",$_POST["email"])->firstOrFail();
            //if (Hash::check($_POST["password"], $auth->ach_motpasse)) {
                session_start();
                session()->put('auth', $auth);
                return view('welcome');
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
        }
        return view('welcome');
    }
}