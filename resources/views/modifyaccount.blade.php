@extends('layouts.app')
@section('content')
    <div class="content" style="overflow-y:scroll;"> 
        <h1 id="titre_modifier_profil">Modifier votre profil</h1>
        <form action="profil" method="post">
            {{csrf_field()}}
            <h3>Informations relatives à votre profil</h3>

            @php
                $user = session('auth');
                $user->refresh();
                $adrFact = $user->getTablAdressFacturationBuyer('1');
                $adrLivr = $user->getTablAdressLivraisonBuyer('1');
            @endphp


            <div id="div_profil">Mon nom :</div>
            <input type="text" name="lastnameBuyer" placeholder="{{$user->ach_nom}}" value="{{$user->ach_nom}}" required /><br>

            <div id="div_profil">Mon prénom :</div>
            <input type="text" name="firstnameBuyer" placeholder="{{$user->ach_prenom}}" value="{{$user->ach_prenom}}" required />
            
            <div id="div_profil">Pseudo :</div>
            <input type="text" name="surnameBuyer" placeholder="{{$user->ach_pseudo}}" value="{{$user->ach_pseudo}}" required />


            <div id="div_profil">Adresse mail :</div>
            <input type="email" multiple name="mailBuyer" placeholder="{{$user->ach_mel}}" value="{{$user->ach_mel}}" required />


            <div id="div_profil">Civilité :</div>
            <input type="text" name="genderBuyer" placeholder="{{$user->ach_civilite}}" value="{{$user->ach_civilite}}" required />

            <div id="div_profil">Téléphone fixe :</div>
            <input type="tel" name="fixedTelBuyer" placeholder="{{$user->ach_telfixe}}" value="{{$user->ach_telfixe}}" />


            <div id="div_profil">Téléphone portable :</div>
            <input type="tel" name="mobileTelBuyer" placeholder="{{$user->ach_telportable}}" value="{{$user->ach_telportable}}" />
            <br><br>
            
            <h3>Adresse de Facturation</h3>

            <div id="div_profil">Nom adresse :</div>       
            <input type="text" name="nameAdrFact" placeholder="{{$adrFact['nom']}}" value="{{$adrFact['nom']}}"/>

            <div id="div_profil">Rue adresse :</div>       
            <input type="text" name="rueAdrFact" placeholder="{{$adrFact['rue']}}" value="{{$adrFact['rue']}}"/>

            <div id="div_profil">Code Postal adresse :</div>       
            <input type="text" name="cpAdrFact" placeholder="{{$adrFact['cp']}}" value="{{$adrFact['cp']}}"/>

            <div id="div_profil">Ville adresse :</div>       
            <input type="text" name="cityAdrFact" placeholder="{{$adrFact['ville']}}" value="{{$adrFact['ville']}}"/><br><br>

            <h3>Adresse de Livraison</h3>

            <div id="div_profil">Nom adresse :</div>       
            <input type="text" name="nameAdrLivr" placeholder="{{$adrLivr['nom']}}" value="{{$adrLivr['nom']}}"/>

            <div id="div_profil">Rue adresse :</div>       
            <input type="text" name="rueAdrLivr" placeholder="{{$adrLivr['rue']}}" value="{{$adrLivr['rue']}}"/>

            <div id="div_profil">Code Postal adresse :</div>       
            <input type="text" name="cpAdrLivr" placeholder="{{$adrLivr['cp']}}" value="{{$adrLivr['cp']}}"/>

            <div id="div_profil">Ville adresse :</div>       
            <input type="text" name="cityAdrLivr" placeholder="{{$adrLivr['ville']}}" value="{{$adrLivr['ville']}}"/><br><br>

            <input type="submit" name="submit">
        </form>
    </div>
@stop
