<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recherchez une vidéo !</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" >

        <!-- Styles -->
        <style>
            .searchDiv{
                margin-top:30%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Fnac
                </div>

                <div class="links">
                    <a href="/">home</a>
                </div>

                <div class="searchDiv">
                    <form action="./visitorResultSearch">
                        <fieldset>
                            <legend>Recherchez une vidéo !</legend>
                            Type de recherche :<br>
                            <select name="searchingTypes">
                                <option value="realisator">realisateur</option>
                                <option value="actor">acteur</option>
                            </select>
                            <br>
                            Entrez le nom du réalisateur ou de l'acteur<br>
                            <input type="text" name="lastname" value="">
                            <br><br>
                            <input type="submit" value="Submit">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
