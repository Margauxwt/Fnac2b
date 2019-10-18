@extends('layouts.app')
@section('content')
    <div id="content">
        <h1 style="text-align:center;">Favoris</h1>

        <form action="" method="post">
        {{csrf_field()}}
        
        @foreach($videoFav as $video)
            <div class="video visible" style="display:inline-block;height:auto;width:auto;text-align:center;">
                <iframe src="https://www.youtube.com/embed/{{$video[0]->vid_urlphoto}}"></iframe>
                <div>{{$video[0]->getAuthor()}}</div>
                <div>{{$video[0]->getActor()}}</div>
                <div>{{$video[0]->vid_prixttc}} Euros</div>
                <button class="button button5" type='submit' name='deleteFav' value='{{$video[0]->vid_id}}'>Supprimer des favoris</button>
            </div>
        @endforeach

        </form>
    </div>
@endsection