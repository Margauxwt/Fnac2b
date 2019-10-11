<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Buyer as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        "name", "email", "password","type",
    ];
}