<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = "t_e_acteur_act";
    protected $primaryKey = "act_id";
    public $timestamps = false;
}

