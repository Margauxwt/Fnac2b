<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Relais extends Model
{
    protected $table = "t_e_relais_rel";
    protected $primaryKey = "rel_id";
    public $timestamps = true;

    protected $fillable = [
        "rel_id",
    ];
}