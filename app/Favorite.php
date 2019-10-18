<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Favorite extends Model
{
    protected $table = "t_j_favori_fav";
    protected $primaryKey = "vid_id";
    public $timestamps = false;
    

    public static function addFavorite($ach_id, $vid_id) {
        foreach(Favorite::all() as $favorite)
        {
            if($favorite["vid_id"] == $vid_id)
            {
                echo "<p style='color:red;'> La vidéo est déjà ajouté au favoris.</p>";
                return view('/visitorSearch');
            }
        }

        DB::table('t_j_favori_fav')
                ->insert(
                    ['ach_id'=> $ach_id,
                    'vid_id'=> $vid_id,]);    
        return view('welcome');
    }

    public static function getAllFavorite($ach_id)
    {
        $favs = DB::table('t_j_favori_fav')
        ->select('t_j_favori_fav.vid_id','t_j_favori_fav.ach_id')
        ->join('t_e_video_vid', 't_e_video_vid.vid_id', '=', 't_j_favori_fav.vid_id')
        ->where('t_j_favori_fav.ach_id', '=', $ach_id)
        ->get();
        return $favs;
    }

}

