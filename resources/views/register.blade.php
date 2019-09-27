<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">

<title>S'inscrire</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link href="{{ asset('/css/styles.css') }}" rel="stylesheet" >

<!-- Styles -->

</head>
<header>
    <h1 id="title_contact_information">Mes coordonnées</h1>
</header>

<body>
<div>
    <input type="radio" id="genderChoice1"
     name="gender" value="Madam">
    <label for="genderChoice1">Madame</label>

    <input type="radio" id="genderChoice2"
     name="gender" value="Sir">
    <label for="genderChoice2">Monsieur</label>

  </div>

    <div class="content">
    <form action="" method="post">
    <div id="div_profil"></div>
    <input type="text" name="lastnameInscription" placeholder="Nom"></input><br>
    
    <div id="div_profil"></div>
    <input type="text" name="surnameInscription" placeholder="Prenom"></input>
    
    <div id="div_profil"></div>
    <input type="text" name="mailInscription" placeholder="E-mail"></input>


    <div id="div_profil"></div>
    <input type="text" name="passwordInscription" placeholder="Mot de passe"></input>


    <div>
    <input type="checkbox" id="subscribe" name="subscribe" value="subscribe">
    <label for="subscribe">Êtes-vous adhérent Fnac ?</label>
    </div>
    <div>
        <button type="submit">Créer mon compte</button>
    </div>


    </form>





</body>

<footer>
</footer>
</html>
