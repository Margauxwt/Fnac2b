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
        @if(session()->get("auth") !== null && session()->get("auth")["type"] === null)
            <button class="button button5" type='submit' name='favorite' value='{{$video->vid_id}}'>+ Favoris</button>
        @endif
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
    @if(session()->get("auth") !== null && session()->get("auth")["type"] === null && $bool == true)
    <div>
        <h1>Rédiger un avis :</h1>
        <form method="POST">
        @csrf
        
        <label>Note : <input type="number" name="Note" min="1" max="5" required></label>
        <label>Titre : <input type="text" name="Titre" size="30" maxlength="100" required></label>
        <label>Commentaire : <textarea name="Commentaire" style="width:250px;height:150px;" required></textarea></label>
        <br>
        <button class="button button5" type="submit" name="ajouteravis" value="{{$video->vid_id}},{{session("auth")['ach_id']}}">Ajouter</button>
        </form>
    </div>
    @endif
    <div>
        <h1>Avis des clients :</h1>
        @foreach ($avis as $avi)
            <li class="avis_client">
                <ul class="pseudo_avis">{{$avi->ach_pseudo}}</ul>
                <ul>Date : {{$avi->avi_date}}</ul>
                <ul>Note/5 : {{$avi->avi_note}}</ul>
                <ul class="titre_avis">{{$avi->avi_titre}}</ul>
                <ul class="description_avis">{{$avi->avi_detail}}</ul>
                <form method="POST">
                    @csrf
                    <button class="button button5" type="submit" name="Signaler" value="{{$avi->avi_id}}">Signaler</button>
                    <button class="button button5" type="submit" name="avisutile" value="{{$avi->avi_id}}">Utile : {{$avi->avi_nbutileoui}}</button>
                    <button class="button button5" type="submit" name="avisnonutile" value="{{$avi->avi_id}}">Non utile : {{$avi->avi_nbutilenon}}</button>
                </form>
            </li>
        @endforeach
    </div>
    

@endsection
