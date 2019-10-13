<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Adress extends Model
{
    protected $table = "t_e_adresse_adr";
    protected $primaryKey = "adr_id";
    public $timestamps = true;

    protected $fillable = [
        "adr_id",
    ];
}