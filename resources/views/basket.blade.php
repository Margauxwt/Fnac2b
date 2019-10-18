@extends('layouts.app')
@section('content')
    <div id="content">
        <h1 style="text-align:center;">Panier, Total : {{$prix}}€</h1>

        <form action="" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        @foreach($videosAch as $video)
                <div class="video visible" style="display:inline-block;height:auto;width:auto;text-align:center;">
                    <iframe src="https://www.youtube.com/embed/{{$video->vid_urlphoto}}"></iframe>
                    <div>{{$video->getAuthor()}}</div>
                    <div>{{$video->getActor()}}</div>
                    <div>{{$video->vid_prixttc}} Euros</div>
                    <button class="button button5" type='submit' name='delete' value='{{$video->vid_id}}'>Supprimer du panier</button>
                </div>
        @endforeach
        </form>
        @if(session()->get("auth") !== null && session()->get("auth")["type"] === null)
            <form action="" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
                <button class="button" type='submit' name='order' style="margin-top:5%;">Passer la commande !</button>            
            </form>
        @else
            <div style="text-align:center;margin-top:10%;">Vous devez etre connecté pour pouvoir passer une commande !</div>
        @endif
    </div>
@endsection