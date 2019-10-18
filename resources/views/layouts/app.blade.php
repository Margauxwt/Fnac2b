
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                    <a href="./registerOther">inscrire (Autre)</a>
                    <a href="./newActor">Ajouter un acteur</a>
                    <a href="./manageUsers">Panel de controle</a>
                    @else
                        @if (session()->get('auth')["type"] == "service_Acheteur")
                        <!-- Si le visiteur est dans le service_Acheteur-->
                        <a href="./orderLastDay">Voir les commandes</a>
                        @else
                            @if (session()->get('auth')["type"] == "service_Vente")
                            <!-- Si le visiteur est dans le service_Vente-->
                            <a href="./rankingVideo">Ranking</a>
                            @else
                                @if (session()->get('auth')["type"] == "service_Communication")
                                    <a href="./abusivenotice">Avis signalé</a>
                                @endif
                            @endif
                        @endif
                    @endif
                @else
                <!-- Si le visiteur est connecté et est un acheteur-->
                <a href="./profil">Profil</a>
                <a href="./myOrder">Mes commandes</a>
                <a href="./favorite">Mes favoris</a>
                @endif
            @else
                <!-- Si le visiteur n'est pas connecté -->
                <a href="./register">S'inscrire (Acheteur)</a>
                <a href="./login">Se connecter</a>
            @endif
    </div>
    <div id="serverMessage">
        @if (session()->get('errors') !== null)
            @foreach (session()->get('errors') as $error)
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Danger!</strong> {{$error}}
            </div>
            @endforeach
            @php session()->forget('errors'); @endphp
        @endif
        @if (session()->get('messages') !== null)
            @foreach (session()->get('messages') as $message)
            <div class="message">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong>Success !</strong> {{$message}}
            </div>
            @endforeach
            @php session()->forget('messages'); @endphp
        @endif
    </div>
        @yield('content')
    </body>
</html>
