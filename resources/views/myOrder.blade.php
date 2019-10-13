@extends('layouts.app')
@section('content')
    <div id="content">
        <h1>Mes commandes !</h1>
        @foreach($orders as $order)
            <div class="order">
                <p>Commande passée le : {{$order["date"]}}</p>
                @foreach($order["videos"] as $video)
                    <div class="videoInOrder" style="display: flex;justify-content: left;flex-direction:inline;">
                        <p style="margin-right:5%;">titre : {{$video["titre"]}}</p>
                        <p style="margin-right:5%;">quantité : {{$video["qte"]}}</p>
                        <p style="margin-right:5%;">prix : {{$video["prix"]}}</p>
                    </div>
                @endforeach
                <br>
            </div>
        @endforeach
    </div>
@endsection