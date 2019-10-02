<?php

namespace App\Http\Controllers;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class videoController extends Controller
{
    public function all()
    {
        return view('visitorSearch', ['videos' => Video::all()]);
    }
}