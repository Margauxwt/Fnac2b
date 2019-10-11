@extends('layouts.app')
@section('content')
    <h1>
        {{$video->vid_titre}}
    </h1>
    <form id="bar-button" action="" method="post">
    @csrf <!-- {{ csrf_field() }} -->
        @if (session()->get('auth')["type"] === null)
            <button class="button button5" type='submit' name='panier' value='{{$video->vid_id}}'>+ Panier</button>
        @endif
        <button class="button button5" type='submit' name='comparator' value='{{$video->vid_id}}'>+ Comparateur</button>
    </form>
    <iframe
        src="https://www.youtube.com/embed/{{$video->vid_urlphoto}}">
    </iframe>
    
    <div>
        Synopsis :
        <br>
        {{$video->vid_synopsis}}
    </div>
    <div>
        Date de parution : {{$video->vid_dateparution}}
    </div>
    <div>
        Durée du film : {{$video->vid_duree}}
    </div>
    <div>
        Type de public : {{$video->vid_publiclegal}}
    </div>
    <div>
        {{$video->vid_prixttc}} euros
    </div>
    <div>
        <h1>Avis des clients :</h1>
        @foreach ($avis as $avi)
            <li class="avis_client">
                <ul class="pseudo_avis">{{$avi->ach_pseudo}}</ul>
                <ul>Date : {{$avi->avi_date}}</ul>
                <ul>Note/5 : {{$avi->avi_note}}</ul>
                <ul class="titre_avis">{{$avi->avi_titre}}</ul>
                <ul class="description_avis">{{$avi->avi_detail}}</ul>
                <ul class="signaler_avis">Signaler</ul>
            </li>
        @endforeach
    </div>
    

@endsection
