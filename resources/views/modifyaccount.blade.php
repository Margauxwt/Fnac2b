<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

    <div class="content">
        <form action="" method="post">
        {{csrf_field()}}
        <h3>Informations relatives à votre profil</h3>

        <div id="div_profil">Mon nom :</div>
        <input type="text" name="lastnameBuyer" placeholder={{session()->get("ach_nom")}} value={{session()->get("ach_nom")}} required /><br>

        <div id="div_profil">Mon prénom :</div>
        <input type="text" name="firstnameBuyer" placeholder={{session()->get("ach_prenom")}} value={{session()->get("ach_prenom")}} required />
        
        <div id="div_profil">Pseudo :</div>
        <input type="text" name="surnameBuyer" placeholder={{session()->get("ach_pseudo")}} value={{session()->get("ach_pseudo")}} required />


        <div id="div_profil">Adresse mail :</div>
        <input type="email" multiple name="mailBuyer" placeholder={{session()->get("ach_mel")}} value={{session()->get("ach_mel")}} required />


        <div id="div_profil">Civilité :</div>
        <input type="text" name="genderBuyer" placeholder={{session()->get("ach_civilite")}} value={{session()->get("ach_civilite")}} required />

        <div id="div_profil">Téléphone fixe :</div>
        <input type="tel" name="fixedTelBuyer" placeholder={{session()->get("ach_telfixe")}} value={{session()->get("ach_telfixe")}} />


        <div id="div_profil">Téléphone portable :</div>
        <input type="tel" name="mobileTelBuyer" placeholder={{session()->get("ach_telportable")}} value={{session()->get("ach_telportable")}} />
        <br><br>
        
        <h3>Adresse de Facturation</h3>

        <div id="div_profil">Nom</div>
        <input type="text" name="adrFactBuyer" placeholder={{session()->get("adr_nom")}} value={{session()->get("adr_nom")}} />

        <div id="div_profil">Rue</div>
        <input type="text" name="adrFactBuyer" placeholder={{session()->get("adr_rue")}} value={{session()->get("adr_rue")}} />

        <br>

        <input type="submit" name="submit">

        </form>

        @php
        $users=App\User::all();
        print_r($users);
        @endphp

</body>

<footer>
</footer>
</html>
