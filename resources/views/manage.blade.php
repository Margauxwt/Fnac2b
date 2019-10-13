@extends('layouts.app')
@section('content')
    <div class="content">
        <h1>Panel de controle Administrateur !</h1>
        <div>
            @foreach($users as $user)
                <form class="user" method="post" style="display: flex;justify-content: space-between;flex-direction:inline;align-items: center;border: 1px solid black;margin-top:2%;">
                    @csrf
                    <div style="margin-right:5%;">{{$user->email}}</div>
                    <div style="margin-right:5%;">{{$user->type}}</div>
                    <select class="form-control" name="type" id="type" style="margin-right:5%;">
                        <option value="">default</option>
                        <option value="administrateur">administrateur</option>
                        <option value="service_Acheteur">service Acheteur</option>
                        <option value="service_Vente">service Vente</option>
                        <option value="service_Communication">service Communication</option>
                    </select>
                    <button type="submit" class="button button5" name='change' value="{{$user->id}}">Changer !</button>
                </form>
            @endforeach
        </div>
    </div>
@stop