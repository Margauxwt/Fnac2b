@extends('layouts.app')
@section('content')
<div class="content">
    <div class="title m-b-md"></div>

    @if (isset($video1) && !empty($video1) && isset($video2) && !empty($video2))
        <div class="content">
            <div class="split left">
                <div class="centered">
                    <h2>{{$video1->vid_titre}}</h2>
                    <iframe
                        src="https://www.youtube.com/embed/{{$video1->vid_urlphoto}}">
                    </iframe>
                    <p class="Auteur">{{$video1->getAuthor()}}</p>
                    <p class="Acteur">{{$video1->getActor()}}</p>
                    <p class="Synopsis">{{$video1->vid_synopsis}}</p>
                    <p class="DateParution">{{$video1->vid_dateparution}}</p>
                    <p class="Duree">{{$video1->vid_duree}}</p>
                    <p class="PublicLegal">{{$video1->vid_publiclegal}}</p>
                    <p class="PrixTTC">{{$video1->vid_prixttc}}</p>
                    <p class="Stock">{{$video1->vid_stock}}</p>
                </div>
            </div>

            <div class="split right">
                <div class="centered">
                    <h2>{{$video2->vid_titre}}</h2>
                    <iframe
                        src="https://www.youtube.com/embed/{{$video2->vid_urlphoto}}">
                    </iframe>
                    <p class="Auteur">{{$video2->getAuthor()}}</p>
                    <p class="Acteur">{{$video2->getActor()}}</p>
                    <p class="Synopsis">{{$video2->vid_synopsis}}</p>
                    <p class="DateParution">{{$video2->vid_dateparution}}</p>
                    <p class="Duree">{{$video2->vid_duree}}</p>
                    <p class="PublicLegal">{{$video2->vid_publiclegal}}</p>
                    <p class="PrixTTC">{{$video2->vid_prixttc}}</p>
                    <p class="Stock">{{$video2->vid_stock}}</p>
                </div>
            </div>
        </div>
        <div id="middle">
            <p class="Auteur">Auteur</p>
            <p class="Acteur">Acteur</p>
            <p class="Synopsis">Synopsis</p>
            <p class="DateParution">DateParution</p>
            <p class="Duree">Duree</p>
            <p class="PublicLegal">PublicLegal</p>
            <p class="PrixTTC">PrixTTC</p>
            <p class="Stock">Stocks</p>
        </div>
    @else
        <form action="" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="content">
                @if (session()->get('videoComparator')["video1"] === null)
                    <div class="split left">
                        <div class="centered">
                            <p>première vidéo à comparée !</p>
                            <select name="video1">
                                @foreach ($videos as $video)
                                    <option value="{{$video->vid_id}}">{{$video->vid_titre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="split right">
                    <div class="centered">
                        <p>deuxième vidéo à comparée !</p>
                        <select name="video2">
                            @foreach ($videos as $video)
                                <option value="{{$video->vid_id}}">{{$video->vid_titre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit">
        </form>
    @endif

</div>
@stop