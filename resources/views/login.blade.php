@extends('layouts.app')
@section('content')
    <div class="content" style="text-align:center;">
        <div class="title m-b-md" style="margin-left:-15%; margin-top:-5%;">
            Connectez vous !
        </div>

        <div>
            <form class="col-md-6" style="margin-top:20%;" method="POST" action="">
            {{csrf_field()}}
                <div id="mail">E-mail*: </div>
                <input type="email" name="email" required>
                <div id="password">Mot de passe*: </div>
                <input type="password" name="password" required><br>
                <select class="form-control" name="type" id="type">
                    <option value="acheteur">Acheteur</option>
                    <option value="autre">Autre</option>
                </select><br>
                <button type="submit" class="btn btn-primary">
                    Login !
                </button>
            </form>
        </div>
    </div>
@stop