<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">

<title>Modifier mon profil</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link href="{{ asset('/css/app.css') }}" rel="stylesheet" >


<!-- Styles -->

</head>
<header>
    <h1 id="titre_modifier_profil">Modifier votre profil</h1>
</header>

<body>

            @php
            $buyers = DB::table('t_e_acheteur_ach')->get();
            $buyer=$buyers[0];
            $offsetBuyer = (array)$buyer;
            echo $offsetBuyer["ach_id"];
            $adressesPerso = DB::table('t_e_adresse_adr')->where('ach_id', '=' , $offsetBuyer["ach_id"])->get();
            
            @endphp

    <div class="content">
    <?php
        if((isset($_POST['lastnameBuyer']))&&(isset($_POST['firstnameBuyer']))&&(isset($_POST['surnameBuyer']))&&(isset($_POST['mailBuyer']))&&(isset($_POST['genderBuyer']))&&(isset($_POST['fixedTelBuyer']))&&(isset($_POST['mobileTelBuyer']))) {
            DB::table('t_e_acheteur_ach')
            ->where('ach_id', 4)
            ->update(['ach_pseudo'=> $_POST['surnameBuyer']]);
            header("Refresh:0");
        }
        Echo '<p>Vos modifications ont bien été enregistrées</p>';
        print_r($buyer);
        print_r($adressesPerso);
        ?>

        <form action="" method="post">
        {{csrf_field()}}
        <div id="div_profil">Mon nom :</div>
        <input type="text" name="lastnameBuyer" placeholder="{{$buyer->ach_nom}}" value="{{$buyer->ach_nom}}" required></input><br>

        <div id="div_profil">Mon prénom :</div>
        <input type="text" name="firstnameBuyer" placeholder="{{$buyer->ach_prenom}}" value="{{$buyer->ach_prenom}}" required></input>
        
        <div id="div_profil">Pseudo :</div>
        <input type="text" name="surnameBuyer" placeholder="{{$buyer->ach_pseudo}}" value="{{$buyer->ach_pseudo}}" required></input>


        <div id="div_profil">Adresse mail :</div>
        <input type="email" multiple name="mailBuyer" placeholder="{{$buyer->ach_mel}}" value="{{$buyer->ach_mel}}" required></input>


        <div id="div_profil">Civilité :</div>
        <input type="text" name="genderBuyer" placeholder="{{$buyer->ach_civilite}}" value="{{$buyer->ach_civilite}}" required></input>


        <div id="div_profil">Téléphone fixe :</div>
        <input type="text" name="fixedTelBuyer" placeholder="{{$buyer->ach_telfixe}}" value="{{$buyer->ach_telfixe}}"></input>


        <div id="div_profil">Téléphone portable :</div>
        <input type="text" name="mobileTelBuyer" placeholder="{{$buyer->ach_telportable}}" value="{{$buyer->ach_telportable}}"></input>

        <input type="submit" name="submit">
        </form>



</body>

<footer>
</footer>
</html>
