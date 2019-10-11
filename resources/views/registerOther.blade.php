@extends('layouts.app')
@section('content')
    <div class="content">
        <h1 id="title_contact_information">Mes coordonnées</h1>
        <form class="form-horizontal" method="POST" action="">
            {{csrf_field()}}
            <div>{{$user = Auth::user()}}</div>
            <div id="name">Nom*: </div>
            <input type="text" name="name" required >
            <div id="mail">E-mail*: </div>
            <input type="email" name="mail" required>
            <div id="password">Mot de passe*: </div>
            <input type="password" name="password" required><br>
            <label for="type" class="col-md-4 control-label" >User Type:</label>
            <div class="col-md-6">
                <select class="form-control" name="type" id="type">
                    <option value="administrateur">Admin</option>
                    <option value="service_Acheteur">Service_Acheteur</option>
                    <option value="service_Vente">Service_Vente</option>
                    <option value="service Communication">Service Communication</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </form>
    </div>
@stop


