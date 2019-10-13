
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @php
    @endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" >
       
        <!-- Styles -->
        <style>
        
        </style>
    </head>
    <body>
        <div class="menu-top">
            
            <a href="./">Home</a>
            <a href="./visitorSearch">Rechercher vidéo</a>
            <a href="./videoComparator">Comparer vidéos</a>
            @if (session()->get('panier') !== null)
                <a href="./basket">Panier({{count(session()->get('panier'))}})</a>
            @endif
            @if (session()->get('auth') !== null)
                <!-- Si le visiteur est connecté -->
                <a href="./logout">Se déconnecter</a>
                @if (session()->get('auth')["type"] !== null)
                <!-- Si le visiteur est connecté et n'est pas un acheteur-->
                    @if (session()->get('auth')["type"] == "administrateur")
                    <!-- Si le visiteur est un admin-->
                    <a href="./rankingVideo">Ranking</a>
                    <a href="./registerOther">inscrire (Autre)</a>
                    <a href="./newActor">Ajouter un acteur</a>
                    <a href="./manageUsers">Panel de controle</a>
                    <!-- Ici -->
                    @else
                        @if (session()->get('auth')["type"] == "service_Acheteur")
                        <!-- Si le visiteur est dans le service_Acheteur-->
                        <a href="./orderLastDay">Voir les commandes</a>
                        @else
                            @if (session()->get('auth')["type"] == "service_Vente")
                            <!-- Si le visiteur est dans le service_Vente-->
                            @else
                                @if (session()->get('auth')["type"] == "service Communication")
                                <!-- Si le visiteur est dans le service Communication-->
                                @endif
                            @endif
                        @endif
                    @endif
                @else
                <!-- Si le visiteur est connecté et est un acheteur-->
                <a href="./profil">Profil</a>
                <a href="./myOrder">Mes commandes</a>
                @endif
            @else
                <!-- Si le visiteur n'est pas connecté -->
                <a href="./register">S'inscrire (Acheteur)</a>
                <a href="./login">Se connecter</a>
            @endif
    </div>
        @yield('content')
    </body>
</html>
