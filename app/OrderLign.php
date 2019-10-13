<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrderLign extends Model
{
    protected $table = "t_j_lignecommande_lec";
    protected $primaryKey = "com_id";
    public $timestamps = true;

    protected $fillable = [
        "ach_id","com_date",
    ];

    public static function create($com_id, $vid_id)
    {
        DB::table('t_j_lignecommande_lec')
            ->insert(
                ['com_id'=> $com_id,
                'vid_id' => $vid_id,
                'lec_quantite' => 1,]);
    }
}