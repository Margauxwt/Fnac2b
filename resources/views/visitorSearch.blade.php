@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height" style="overflow-y:hidden;">
        <div class="content">
            <div style="padding-left:16px;margin-top:5%;">
                <h2>Type Search Bar : </h2>
                <input type="text" placeholder="Search.." id="searchUpdate" onkeyup="filter()">
                <select name="Type" id="Type">
                    <option value="Acteur">Acteur</option>
                    <option value="Createur">Createur</option>
                </select>
                </div>
                <br>
                <div id="tableVideo">
                    @foreach ($videos as $video)
                        <a href="./consultationVideo?id={{$video->vid_id}}">
                            <div class="video visible">
                                <iframe
                                    src="https://www.youtube.com/embed/{{$video->vid_urlphoto}}">
                                </iframe>
                                <div>{{$video->getAuthor()}}</div>
                                <div>{{$video->getActor()}}</div>
                                <div>{{$video->vid_prixttc}} Euros</div>
                            </div>
                        </a>
                    @endforeach
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                    <div class="video visible">
                        <div></div>
                        <div>Bonjour</div>
                        <div>Bonjour</div>
                    </div>
                </div>
                <div id="links">
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    table = document.querySelectorAll(".video");
    links = document.querySelector("#links");
    page();
    function page()
    {
        visible = document.querySelectorAll(".visible");
        links.innerHTML = "";
        if(visible.length > 10)
        {
            for (var i = 1; i-1 < visible.length/10; i++) {
                link = document.createElement("div");
                link.innerHTML = i;
                link.addEventListener("click", function(){
                    for(var j = 0; j<visible.length-1; j++)
                    {
                        visible[j].style.display = "none";
                        visible[j].classList.remove("visible")
                    }
                    console.log()
                    for(var j = this.innerHTML*10-10; j<this.innerHTML*10-1; j++)
                    {
                        if(typeof(visible[j]) != "undefined")
                            visible[j].style.display = "";
                    }
                })
                links.appendChild(link);
            }
            for(var j = 9; j<visible.length-1; j++)
            {
                visible[j].style.display = "none";
                visible[j].classList.remove("visible")
            }
        }
    }

    function filter(){
        var search = document.querySelector("#searchUpdate");
        var type = document.querySelector("#Type");
        var indexType = 2;

        if(type.value == "Createur")
            indexType = 1;

        for (var i = table.length - 1; i >= 0; i--) {
            if(table[i].children[indexType].innerHTML.toUpperCase().indexOf(search.value.toUpperCase()) > -1)
            {
                table[i].style.display = "";
                table[i].classList.add("visible")
            }
            else
            {
                table[i].classList.remove("visible")
                table[i].style.display = "none";
            }
        }
        page();
    }
    </script>
@stop

