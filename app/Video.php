<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "t_e_video_vid";
    protected $primaryKey = "vid_id";
    public $timestamps = false;
}

