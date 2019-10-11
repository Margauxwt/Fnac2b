@extends('layouts.app')
@section('content')

<title>Classement des vidéos</title>
    <header>
        <h1 id="titre_votre_profil">Votre Profil</h1>
    </header>

    <body>

    @php 
    $yo= session()->get('auth');
    print_r($yo);
    @endphp

    <br>
    <a href="/modifyaccount" id="lien_modify">Modifier mes informations</a>
    </body>
@stop  