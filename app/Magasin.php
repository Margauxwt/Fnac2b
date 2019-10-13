<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Magasin extends Model
{
    protected $table = "t_r_magasin_mag";
    protected $primaryKey = "mag_id";
    public $timestamps = false;

    protected $fillable = [
        "mag_id",
    ];
}