<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class videoController extends Controller
{
    public function all()
    {
        return view('visitorSearch', ['videos' => Video::all()]);
    }
}