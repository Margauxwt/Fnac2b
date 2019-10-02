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
        <div id="div_profil">Mon nom :</div>
            @php
                $user_name=DB::select('select ach_nom from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_name);
            @endphp
        <div id="div_profil">Mon prénom :</div>
            @php
                $user_prename=DB::select('select ach_prenom from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_prename);
            @endphp
        <div id="div_profil">Pseudo :</div>
            @php
                $user_pseudo=DB::select('select ach_pseudo from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_pseudo);
            @endphp
        <div id="div_profil">Adresse mail :</div>
            @php
                $user_mel=DB::select('select ach_mel from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_mel);
            @endphp
        <div id="div_profil">Civilité :</div>
            @php
                $user_civilite=DB::select('select ach_civilite from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_civilite);
            @endphp
        <div id="div_profil">Téléphone fixe :</div>
            @php
                $user_telfixe=DB::select('select ach_telfixe from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_telfixe);
            @endphp
        <div id="div_profil">Téléphone portable :</div>
            @php
                $user_telportable=DB::select('select ach_telportable from t_e_acheteur_ach where ach_id = :id', ['id' => 1]);
                print_r($user_telportable);
            @endphp
    </body>

    <footer>
    </footer>
</html>
