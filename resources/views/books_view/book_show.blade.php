@include('../templates/headerbase')

        <div class='container container-body'>
            <div class="row row-nav">
                <div class="col-sm-12 col-md-12"> <!--Construido aba de navegação-->
                    <span class="h2"><a href="{{url('/')}}"><small>Home > </small></a>
                    @if(isset($route_link))<!-- Caso o usuário tenha vindo da home não existe nenhum link a ser lido-->
                    <a href="{{url($route_link)}}"><small>{{$title_body.' > '}}</small></a>
                    @endif
                    <small>Book</small>
                    </span>
                </div>
            </div>
            
            <div class="col-sm-2"></div>
            <div class="col col-sm-8 thumbnail">                      
                <div class="caption">
                    <h3>{{$book["title"]}}</h3>
                    <h5>by Rodrigo Maia</h5>
                </div>
                
                    <img  class="img-responsive" src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$book["ISBN"].'.01.MZZZZZZZ.jpg'}}" alt="{{$book["title"]}}">              
                                                           
                    <span class="h4">Price: {{$book["price"]}}</span></br>
                    <span class="h5">ISBN: {{$book["ISBN"]}}</span></br>
                    <span class="h5">Publisher: {{$book["publisher"]}}</span></br>
                    <span class="h5">Pages: {{$book["pages"]}}</span></br>
                    <span class="h5">Edition: {{$book["edition"]}}</span></br>

                    <a class="btn btn-danger">
                            <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 "><!--Desenhando icon-->
                                <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                            </svg> Add to cart                            
                    </a>
                    <p class="text-justify caption">
                        {{$book["description"]}}
                    </p>
                    <a class="btn btn-danger">
                            <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 "><!--Desenhando icon-->
                                <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                            </svg> Add to cart                            
                    </a>
            </div>
            <div class="col-sm-2"></div>
        </div>    

    </body>
</html>
