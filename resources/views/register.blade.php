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

    <div class="content">
    <form action="" method="post"> 
    {{csrf_field()}}

        <div>
            <input type="radio" id="Mme"
            name="genderInscription" value="Mme" required>
            <label for="Mme">Madame</label>

            <input type="radio" id="M."
            name="genderInscription" value="M.">
            <label for="M.">Monsieur</label>

            <input type="radio" id="Mlle"
            name="genderInscription" value="Mlle">
            <label for="Mlle">Mademoiselle</label>

        </div>

        <div id="div_profil">Nom*: </div>
        <input type="text" name="lastnameInscription" required ></input><br>
        
        <div id="div_profil">Prenom*: </div>
        <input type="text" name="surnameInscription" required></input>

        <div id="div_profil">Pseudo*: </div>
        <input type="text" name="pseudoInscription" required></input>

        <div id="div_profil">E-mail*: </div>
        <input type="email" name="mailInscription" required ></input>

        <div id="div_profil">Telephone fixe**: </div>
        <input type="number" name="fixedtelInscription" ></input>

        <div id="div_profil">Telephone portable**: </div>
        <input type="number" name="mobiletelInscription" ></input>

        <?php 
            if(isset($_POST['fixedtelInscription']) && $_POST['mobiletelInscription'] = '' ){
                echo 'Veuillez remplir correctement les champs';
            }
        ?>

        <div id="div_profil">Mot de passe*: </div>
        <input type="password" name="passwordInscription" required ></input>

 
        <div>
            <button type="submit">Créer mon compte</button>
        </div>

        <p> Les champs marqués d'un * sont obligatoires <br/> 
            Il est obligatoire de remplir au moins un des champs marqués d'un **
        </p>


    </form>

</body>

<footer>
</footer>
</html>
