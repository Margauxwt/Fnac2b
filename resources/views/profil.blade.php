@extends('layouts.app')
@section('content')

<title>Mon Profil</title>
    <header>
        <h1 id="titre_votre_profil">Votre Profil</h1>
    </header>

    <body>

        @php 
            $user = session('auth');
        @endphp

        <div class="div_votre_profil">Votre nom : {{$user->ach_nom}}</div>
        <div class="div_votre_profil">Votre prénom : {{$user->ach_prenom}}</div>
        <div class="div_votre_profil">Votre pseudo : {{$user->ach_pseudo}}</div>
        <div class="div_votre_profil">Votre adresse mail : {{$user->ach_mel}}</div>
        <div class="div_votre_profil">Votre civilité : {{$user->ach_civilite}}</div>
        <div class="div_votre_profil">Votre téléphone fixe : {{$user->ach_telfixe}}</div>
        <div class="div_votre_profil">Votre téléphone portable : {{$user->ach_telportable}}</div>
        <div class="div_votre_profil">Votre adresse de facturation : {{$user->getAddressFacturationBuyer($user->ach_id)}}</div>
        <div class="div_votre_profil">Votre adresse de livraison : {{$user->getAddressLivraisonBuyer($user->ach_id)}}</div>
        <div class="div_votre_profil">Votre magasin préféré : {{$user->getMagasinPrefBuyer($user->ach_id)}}</div>

        <br>
        <a href="./modifyaccount" id="lien_modify">Modifier mes informations</a>
    </body>
@stop