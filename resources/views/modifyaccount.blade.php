<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">

<title>Modifier mon profil</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link href="{{ asset('/css/styles.css') }}" rel="stylesheet" >

<!-- Styles -->

</head>
<header>
    <h1 id="titre_modifier_profil">Modifier votre profil</h1>
</header>

<body>

            @php
            $buyers = DB::table('t_e_acheteur_ach')->get();
            $buyer=$buyers[0];
            print_r($buyer);



            @endphp
{{$buyer->ach_pseudo}}

    <div class="content">

        <form action="" method="post">
        <div id="div_profil">Mon nom :</div>
        <input type="text" name="lastnameBuyer" placeholder=""></input><br>





        <div id="div_profil">Mon prénom :</div>
        <input type="text" name="surnameBuyer" placeholder="Prenom"></input>
        
        <div id="div_profil">Pseudo :</div>
        <input type="text" name="surnameBuyer" placeholder="Pseudo"></input>


        <div id="div_profil">Adresse mail :</div>
        <input type="text" name="mailBuyer" placeholder="Adresse mail"></input>


        <div id="div_profil">Civilité :</div>
        <input type="text" name="genderBuyer" placeholder="Civilité"></input>


        <div id="div_profil">Téléphone fixe :</div>
        <input type="text" name="fixedTelBuyer" placeholder="Téléphone fixe"></input>


        <div id="div_profil">Téléphone portable :</div>
        <input type="text" name="mobileTelBuyer" placeholder="Téléphone portable"></input>

        <input type="submit" name="submit">
        </form>
</body>

<footer>
</footer>
</html>
