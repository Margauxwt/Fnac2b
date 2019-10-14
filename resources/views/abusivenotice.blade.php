@extends('layouts.app')
@section('content')
    <h1>Avis signalé</h1>
    @foreach ($avis as $avi)
            <li class="avis_client">
                <ul>Date : {{$avi->avi_date}}</ul>
                <ul>Note/5 : {{$avi->avi_note}}</ul>
                <ul class="titre_avis">{{$avi->avi_titre}}</ul>
                <ul class="description_avis">{{$avi->avi_detail}}</ul>
                <form method="POST">
                    @csrf
                    <button class="button button5" type="submit" name="Supprimer" value="{{$avi->avi_id}}">Supprimer</button>
                </form>
            </li>
        @endforeach
@endsection