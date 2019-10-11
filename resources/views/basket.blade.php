@extends('layouts.app')
@section('content')
    <div id="content">
        <h1>Panier</h1>
        <form action="" method="post">
        @csrf <!-- {{ csrf_field() }} -->
        @foreach($videosAch as $video)
                <div class="video visible" style="display:inline-block;">
                    <iframe src="https://www.youtube.com/embed/{{$video->vid_urlphoto}}"></iframe>
                    <div>{{$video->getAuthor()}}</div>
                    <div>{{$video->getActor()}}</div>
                    <div>{{$video->vid_prixttc}} Euros</div>
                    <button class="button button5" type='submit' name='delete' value='{{$video->vid_id}}'>-</button>
                </div>
            @endforeach
        </form>
        <form action="">
            <button class="button button5" type='submit' name='delete'>-</button>            
        </form>
    </div>
@endsection