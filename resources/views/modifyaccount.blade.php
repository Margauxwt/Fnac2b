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

        @php
            $user = $users[0];
        @endphp


        <div id="div_profil">Mon nom :</div>
        <input type="text" name="lastnameBuyer" placeholder={{$user->ach_nom}} value={{$user->ach_nom}} required /><br>

        <div id="div_profil">Mon prénom :</div>
        <input type="text" name="firstnameBuyer" placeholder={{$user->ach_prenom}} value={{$user->ach_prenom}} required />
        
        <div id="div_profil">Pseudo :</div>
        <input type="text" name="surnameBuyer" placeholder={{$user->ach_pseudo}} value={{$user->ach_pseudo}} required />


        <div id="div_profil">Adresse mail :</div>
        <input type="email" multiple name="mailBuyer" placeholder={{$user->ach_mel}} value={{$user->ach_mel}} required />


        <div id="div_profil">Civilité :</div>
        <input type="text" name="genderBuyer" placeholder={{$user->ach_civilite}} value={{$user->ach_civilite}} required />

        <div id="div_profil">Téléphone fixe :</div>
        <input type="tel" name="fixedTelBuyer" placeholder={{$user->ach_telfixe}} value={{$user->ach_telfixe}} />


        <div id="div_profil">Téléphone portable :</div>
        <input type="tel" name="mobileTelBuyer" placeholder={{$user->ach_telportable}} value={{$user->ach_telportable}} />
        <br><br>
        
        <h3>Adresse de Facturation</h3>

        <div id="div_profil">Nom adresse :</div>
        


        
        <input type="tel" name="" placeholder={{$user->getAdrFactUser(1)}}getAdrFactUser value="" />


        <input type="submit" name="submit">



        </form>
        
        

</body>

<footer>
</footer>
</html>
