<?php

namespace App\Http\Controllers;
use App\Favorite;
use App\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FavoriteController extends Controller {
    public static function allFavorite(){
        $favs = Favorite::getAllFavorite(session()->get('auth')['ach_id']);
        $videos = array();
        foreach($favs as $fav)
        {
            array_push($videos, Video::where('vid_id', $fav->vid_id)->get());
        }
        return view('favorite', ['videoFav' =>  $videos]);
    }

    public static function DeleteFavorite(){
        $fav = Favorite::find($_POST['deleteFav']);
        $fav->delete();
        return redirect('favorite');
    }


}