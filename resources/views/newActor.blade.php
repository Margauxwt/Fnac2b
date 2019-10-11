@extends('layouts.app')

@section('content')


</head>
<header>
    <h1>Ajouter un acteur</h1>
</header>

<body>

    <div class="content">
        <form action="" method="post"> 
        {{csrf_field()}}

            <div>Nom: </div>
            <input type="text" name="NameActor" required><br>

            <div>
                <button type="submit">Ajouter</button>
            </div>

        </form>

</body>

@endsection
