@extends('layouts.app')
@section('content')
    <div id="content">
        <h1>Informations</h1>
        <form action="" method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <p>Ou voullez vous recevoir vos colis ?</p>
            <p>(si vous choisissez chez moi l'adresse prise en compte sera celle de votre compte)</p>
            <select class="form-control" name="type" id="type">
                <option value="Me">Chez Moi</option>
                <option value="Relais">Relais</option>
                <option value="Magasin">Magasin</option>
            </select><br>
            <input type="text" name="adr"><br>
            <button class="button button5" type='submit' name='buy' style="margin-top:5%;">Passer la commande !</button>    
        </form>
    </div>
@endsection