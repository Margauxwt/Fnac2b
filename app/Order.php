<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    protected $table = "t_e_commande_com";
    protected $primaryKey = "com_id";
    public $timestamps = false;

    protected $fillable = [
        "ach_id","com_date",
    ];

    public static function create($champ, $adr, $date)
    {
        $data = new Order;
        $data->ach_id = session()->get("auth")["ach_id"];
        $data->$champ = $adr;
        $data->com_date = $date;
        $data->save();
        return $data->com_id;
    }
}