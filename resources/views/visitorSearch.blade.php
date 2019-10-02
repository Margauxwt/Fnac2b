<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recherchez une vidéo !</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" >

        <!-- Styles -->
        <style>
            * {box-sizing: border-box;}

        body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
        overflow: hidden;
        background-color: #e9e9e9;
        }

        .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }

        .topnav a:hover {
        background-color: #ddd;
        color: black;
        }

        .topnav a.active {
        background-color: #2196F3;
        color: white;
        }

        .topnav .search-container {
        float: right;
        }

        .topnav input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
        }

        .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
        }

        .topnav .search-container button:hover {
        background: #ccc;
        }

        @media screen and (max-width: 600px) {
        .topnav .search-container {
            float: none;
        }
        .topnav a, .topnav input[type=text], .topnav .search-container button {
            float: none;
            display: block;
            text-align: left;
            width: 100%;
            margin: 0;
            padding: 14px;
        }
        .topnav input[type=text] {
            border: 1px solid #ccc;  
        }
        }

        #tableVideo {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        height:auto;
        display: flex;
        flex-direction: row;
        }

        .video {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width:25%;
        height:33vh;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="links">
                    <a href="/">home</a>
                </div>
                <p>{{videos}}</p>
                <div style="padding-left:16px;margin-top:5%;">
                    <h2>Responsive Search Bar : </h2>
                    <input type="text" placeholder="Search.." id="searchUpdate" onkeyup="filter()">
                    <select name="Type" id="Type">
                        <option value="Acteur">Acteur</option>
                        <option value="Createur">Createur</option>
                        </select>
                    </div>
                    <br>
                    <div id="tableVideo">
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/kDehTEEoFnE" width="100%" frameborder="0" allowfullscreen></iframe> 
                        <div>Acteur</div>
                        <div>Createur</div>
                    </div>
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/kDehTEEoFnE" width="100%" frameborder="0" allowfullscreen></iframe> 
                        <div>Maria Anders, Mathis Figuet</div>
                        <div>Germany</div>
                    </div>
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/kDehTEEoFnE" width="100%" frameborder="0" allowfullscreen></iframe> 
                        <div>Roland Mendel</div>
                        <div>Austria</div>
                    </div>
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/kDehTEEoFnE" width="100%" frameborder="0" allowfullscreen></iframe> 
                        <div>Helen Bennett</div>
                        <div>UK</div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        function filter(){
            var search = document.querySelector("#searchUpdate");
            var type = document.querySelector("#Type");
            var table = document.querySelectorAll(".video");
            var indexType = 1;

            if(type.value == "Createur")
                indexType = 2;

            for (var i = table.length - 1; i >= 0; i--) {
                if(table[i].children[indexType].innerHTML.toUpperCase().indexOf(search.value.toUpperCase()) > -1)
                    table[i].style.display = "";
                else
                    table[i].style.display = "none";
            }
        }
        </script>
    </body>
</html>
