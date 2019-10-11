@extends('layouts.app')
@section('content')
    <h1>
        {{$video->vid_titre}}
    </h1>
    <form id="bar-button" action="" method="post">
    @csrf <!-- {{ csrf_field() }} -->
        @if (session()->get('auth')["type"] !== null)
            <button class="button button5" type='submit' name='panier' value='{{$video->vid_id}}'>+ Panier</button>
        @endif
        <button class="button button5" type='submit' name='comparator' value='{{$video->vid_id}}'>+ Comparateur</button>
    </form>
    <iframe
        src="https://www.youtube.com/embed/{{$video->vid_urlphoto}}">
    </iframe>
@endsection
