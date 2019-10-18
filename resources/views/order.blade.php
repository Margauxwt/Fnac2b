@extends('layouts.app')
@section('content')
    <div id="content" style="text-align:center;">
        <h1>Informations</h1>
        <p>Ou voullez vous recevoir vos colis ?</p>
        <form action="" method="post">
        {{csrf_field()}}
            <div id="split3">
                <div class="splitOrder">
                    <p>Chez Moi !</p>
                    <button class="button" type='submit' name='buy' style="margin-top:5%;" value="me">Passer la commande !</button>
                </div>
                <div class="splitOrder">
                    <p>Chez un relais !</p>
                    <select class="form-control" name="relais" id="type">
                        <option value="default">default</option>
                        @if (session()->get('rel_id') !== null)
                            <option value="myRelais">mon relais</option>
                        @endif
                        @foreach ($relais as $relai)
                            <option value="{{$relai->rel_id}}">{{$relai->rel_nom}}</option>
                        @endforeach
                    </select>
                    <button class="button" type='submit' name='buy' style="margin-top:5%;">Passer la commande !</button>
                </div>
                <div class="splitOrder">
                    <p>Dans un magasin !</p>
                    <select class="form-control" name="magasin" id="type">
                        <option value="default">default</option>
                        @foreach ($magasins as $magasin)
                            <option value="{{$magasin->mag_id}}">{{$magasin->mag_nom}}</option>
                        @endforeach
                    </select>
                    <button class="button" type='submit' name='buy' style="margin-top:5%;">Passer la commande !</button>
                </div>
            </div>
        </form>
        <!--
        <form action="" method="post">
        @csrf  {{ csrf_field() }} 
            <p>Ou voullez vous recevoir vos colis ?</p>
            <p>(si vous choisissez chez moi l'adresse prise en compte sera celle de votre compte)</p>
            <select class="form-control" name="type" id="type">
                <option value="Me">Chez Moi</option>
                <option value="Relais">Relais</option>
                <option value="Magasin">Magasin</option>
            </select><br>
            <input type="text" name="adr"><br>
            <button class="button button5" type='submit' name='buy' style="margin-top:5%;">Passer la commande !</button>    
        </form>-->
    </div>
@endsection