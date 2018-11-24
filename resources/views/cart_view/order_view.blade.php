@include('../templates/headerbase')
<div class='container container-body footerAjust'>

    <h1>Your Orders</h1>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form action="{{url('/order/search')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input class="flipkart-navbar-input col-xs-5 searchAjust" type="text" placeholder="Email" 
                       name="email">
                <button class="flipkart-navbar-button col-xs-1 searchButtonAjust" type="submit">
                    <svg width="15px" height="15px"><!--Desenhando icon-->
                    <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @if (!isset($email))
    <br><br>
    <div><p>{{$message}}</p></div>
    @else
        <div class="row ajustOrder">
            @foreach ($orderItems as $key => $items)  
            <div class="well">
                <h1 class="text-center">Order: {{$key}}, made on: {{$orderDatas[$key]}} </h1>
                <div class="list-group">
                    <!--<div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">-->
                    @foreach($items as $ky => $item)
                    <div class="list-group-item active orderMasterCell">
                        <div class="media col-md-3">
                            <figure class="pull-left">
                                <img class="media-object img-rounded img-responsive imgSize" src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$item["ISBN"].'.01.MZZZZZZZ.jpg'}}"
                                     alt="{{$item['ISBN']}}">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h4 class="list-group-item-heading"> {{$item['title']}} </h4>
                            <p class="list-group-item-text">
                            <div><b>ISBN:</b>  {{$item['ISBN']}}</div>    
                            <div><b>Publisher:</b>  {{$item['publisher']}}</div>
                            <div> <b>Publication:</b>  {{$item['pubdate']}}</div>
                            <div><b>Edition:</b>  {{$item['edition']}}</div>
                            <div> <b>Pages:</b>  {{$item['pages']}}</div>
                            </p>
                        </div>
                        <div class="col-md-3 text-left">
                            <h3> <b>Price:</b> {{'$'.$item['price']}}<br> 
                                <b>Quantity:</b>  {{$item['qty']}}<br>
                                <b>Total Price:</b> {{'$'.$item['qty']*$item['price']}}
                            </h3>
                            <a href="{{url('show').'/'.$item['ISBN']}}">
                                <button type="button" class="btn btn-default btn-lg btn-block"> See Product </button>
                            </a>
                        </div>
                    </div>

                    <!--
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-2 col-xl-2">
                        <div class="thumbnail cell orderCell">
                            <a href="{{url('show').'/'.$item['ISBN']}}">
                                <img class="img-rounded"
                                     src="{{'http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/'.$item["ISBN"].'.01.MZZZZZZZ.jpg'}}"
                                     alt="{{$item['ISBN']}}">
                            </a>
                            <div class="caption">Order's Number: {{$key}}</div>
                            <div class="caption">Order's date: {{$orderDatas[$key]}}</div>
                            <div class="caption">Order's Item(s):</div>
                            <div class="caption">
                                <b>Price:</b> {{'$'.$item['price']}}
                            </div>
                            <div class="caption">
                                <b>Quantity:</b>  {{$item['qty']}}
                            </div>
                            <div class="caption">
                                <b>Total Price:</b> {{'$'.$item['qty']*$item['price']}}
                            </div>
                        </div>
                    </div>
                    -->
                    @endforeach
                </div>
            </div>
            <!--</div>
        </div>-->
            @endforeach
        </div>
    @endif
</div>

</body>

@include('../templates/footerBase')
