<?php

namespace App\Http\Controllers;
use App\Order;
use App\OrderLign;
use App\Video;
use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller {
    public function myOrder()
    {
        $ordersRaw = Order::where('ach_id', session()->get("auth")["ach_id"])->get();
        $orders = array();
        $i = 0;
        foreach($ordersRaw as $order)
        {
            $orderLigns = OrderLign::where('com_id', $order->com_id)->get();
            $orders[$i] = array("date" => $order->com_date, "videos" => array());
            $j = 0;
            foreach($orderLigns as $orderLign)
            {
                $video = Video::where('vid_id', $orderLign->vid_id)->get()->first();
                $orders[$i]["videos"][$j] = array("titre" => $video->vid_titre, "qte" => $orderLign->lec_quantite, "prix" => $video->vid_prixttc);
                $j++;
            }
            $i++;
        }
        return view('myOrder', ['orders' => $orders]);
    }
    public function orderLastDay()
    {
        $date = \Carbon\Carbon::now();
        $date->subDay();
        $date = $date->year."-".$date->month."-".$date->day;
        $ordersRaw = Order::where('com_date', $date)->get();
        $orders = array();
        $i = 0;
        foreach($ordersRaw as $order)
        {
            $orderLigns = OrderLign::where('com_id', $order->com_id)->get();
            $buyer = Buyer::where('ach_id', $order->ach_id)->get()->first();
            $orders[$i] = array("acheteur" => $buyer->ach_mel,"date" => $order->com_date, "videos" => array());
            $j = 0;
            foreach($orderLigns as $orderLign)
            {
                $video = Video::where('vid_id', $orderLign->vid_id)->get()->first();
                $orders[$i]["videos"][$j] = array("titre" => $video->vid_titre, "qte" => $orderLign->lec_quantite, "prix" => $video->vid_prixttc);
                $j++;
            }
            $i++;
        }
        return view('orderLastDay', ['orders' => $orders]);
    }
}