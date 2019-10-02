<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">

<title>S'inscrire</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link href="{{ asset('/css/app.css') }}" rel="stylesheet" >

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

        <input type="radio" id="genderChoice2"
        name="gender" value="Mll">
        <label for="genderChoice3">Mademoiselle</label>

    </div>

    <div class="content">
    <form action="" method="post">

        <div id="div_profil">Nom: </div>
        <input type="text" name="lastnameInscription" ></input><br>
        
        <div id="div_profil">Prenom: </div>
        <input type="text" name="surnameInscription"></input>

        <div id="div_profil">E-mail: </div>
        <input type="mail" name="mailInscription" ></input>

        <div id="div_profil">Telephone fixe: </div>
        <input type="text" name="telfixeInscription" ></input>

        <div id="div_profil">Telephone portable: </div>
        <input type="text" name="telmobileInscription" ></input>

        <div id="div_profil">Mot de passe: </div>
        <input type="text" name="passwordInscription" ></input>

        <div id="div_profil">Adresse de facturation </div>
        <input type="text" name="nameAdressFactInscription" placeholder="nom" > </input>
        <input type="text" name="streetAdressFactInscription" placeholder="rue" > </input>
        <input type="text" name="CDAdressFactInscription" placeholder="code postale" > </input>
        <input type="text" name="cityAdressFactInscription" placeholder="ville" > </input>

        <div id="div_profil">Adresse de livraison </div>
        <input type="text" name="nameAdressLivInscription" placeholder="nom" > </input>
        <input type="text" name="streetAdressLivInscription" placeholder="rue" > </input>
        <input type="text" name="CDAdressLivInscription" placeholder="code postale" > </input>
        <input type="text" name="cityAdressLivInscription" placeholder="ville" > </input>
        



        <div>
            <button type="submit">Créer mon compte</button>
        </div>


    </form>

</body>

<footer>
</footer>
</html>
