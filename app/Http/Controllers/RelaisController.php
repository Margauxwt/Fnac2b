<?php

namespace App\Http\Controllers;
use App\Http\Controllers\OrderController;
use App\Video;
use App\Avis;
use App\Adress;
use App\Magasin;
use App\Relais;
use App\Order;
use App\OrderLign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
class RelaisController extends Controller
{
    public function all()
    {
        return view('modifyaccount', ['relais' => Relais::getRelais()]);
    }
    
}