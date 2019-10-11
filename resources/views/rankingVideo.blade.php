@extends('layouts.app')
@section('content')

<title>Classement des vidéos</title>
    <header>
        <h1>Classement des vidéos</h1>
    </header>

    <body>
        <form action="" method="post">
        {{csrf_field()}}
            <h2>Veuillez choisir une video :</h2>
            <select name="video">
                @foreach ($videos as $video)
                    <option value="{{$video->vid_id}}">{{$video->vid_titre}}</option>
                @endforeach
            </select>
            
            <h2>Veuillez choisir un rang :</h2>
                <input type="text" name="rang"/>
        </form>
        <br>
        <input type="submit" name="submit">
        <br>


    </body>
@stop  