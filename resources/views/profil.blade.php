<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <title>Mon Profil</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" >

        <!-- Styles -->
       
    </head>
    <header>
        <h1 id="titre_votre_profil">Votre Profil</h1>
    </header>

    <body>

    @php 
        $user = $users[1];
    @endphp

    <div class="div_votre_profil">Votre nom : {{$user->ach_nom}}</div>
    <div class="div_votre_profil">Votre prénom : {{$user->ach_prenom}}</div>
    <div class="div_votre_profil">Votre pseudo : {{$user->ach_pseudo}}</div>
    <div class="div_votre_profil">Votre adresse mail : {{$user->ach_mel}}</div>
    <div class="div_votre_profil">Votre civilité : {{$user->ach_civilite}}</div>
    <div class="div_votre_profil">Votre téléphone fixe : {{$user->ach_telfixe}}</div>
    <div class="div_votre_profil">Votre téléphone portable : {{$user->ach_telportable}}</div>
    <div class="div_votre_profil">Votre adresse de facturation : {{$user->getAddressFacturationUser(1)}}</div>
    <div class="div_votre_profil">Votre adresse de livraison : {{$user->getAddressLivraisonUser(1)}}</div>
    <div class="div_votre_profil">Votre magasin préféré : {{$user->getMagasinPrefUser(1)}}</div>

    <br>
    <a href="/modifyaccount">Modifier mes informations</a>
    </body>

    <footer>
    </footer>
</html>
