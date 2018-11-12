@include('../templates/headerbase')

        <div class='container container-body'>
            
            <div class="row">
                <div class="col-sm-12 col-md-12">
                <h1><a href="{{url('/')}}"><small>Home > </small></a><small>{{$title_body}}</small></h1>
                </div>
            </div>
            
            
            <div class="row">
            @foreach($books as $book)           
                    <div class="col col-sm-4 col-md-3 ">
                      <div class="thumbnail cell">
                        <img  class="img-rounded" src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$book["ISBN"].'.01.THUMBZZZ.jpg'}}" alt="{{$book["title"]}}">
                        <div class="caption">
                          <h3>{{$book["title"]}}</h3>
                          <p>{{$book["description"]}}<a>mais</a></p>                          
                        </div>
                      </div>
                    </div>
            @endforeach
            </div>
        </div>

    </body>
</html>
