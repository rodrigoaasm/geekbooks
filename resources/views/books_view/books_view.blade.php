@include('../templates/headerbase')

        <div class='container container-body'>            
              
            <div class="row">
            @foreach($books as $book)  <!--Interando books-->         
                    <div class="col col-sm-4 col-md-3 .col-lg-2 .col-xl-2">
                      <div class="thumbnail cell">
                         
                            <a href="{{url('show').'/'.$book['ISBN']}}">
                            <img  class="img-rounded" src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$book["ISBN"].'.01.THUMBZZZ.jpg'}}" alt="{{$book["title"]}}">              
                            <div class="caption">
                                <h3>{{$book["title"]}}</h3>
                        </a>
                                <p class="text-justify" >{{$book["description"]}}<a>mais</a></p>                          
                            </div>
                      </div>
                    </div>
            @endforeach
            </div>
        </div>

    </body>
@include('../templates/footerBase')
