<!DOCTYPE html>
    <html lang="pt-br">
    <head>
    	<meta charset="utf-8"/>
    	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    	<title>GeekBooks</title>   
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"> </script>
        
        <link href="{{url('css/headerbase.css')}}" rel="stylesheet" >
        <script src="{{url('js/headerbase.js')}}"></script>
        

    </head>    
    <body>     
        <div id="flipkart-navbar" class="flipkart-navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="container">
                <div class="row row1">
                    <div class="col-sm-4 col-md-3 col">
                        <h2 style="margin:0px;" id="title_page"><span class="smallnav menu" >☰ GeekBooks</span></h2>
                        <h1 style="margin:0px;"><span class="largenav">GeekBooks</span></h1>
                    </div>
                    <div class="flipkart-navbar-search text-primary smallsearch col-sm-6 col-md-7 col-xs-11">
                        <div class="row">
                            <form action="{{url('/search')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input class="flipkart-navbar-input col-xs-11" type="text" placeholder="Search for Books" 
                                       name="search_books" @if(isset($keyWord)) value="{{$keyWord}}" @endif >
                                <button class="flipkart-navbar-button col-xs-1" type="submit">
                                    <svg width="15px" height="15px"><!--Desenhando icon-->
                                        <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="cart largenav  col-sm-2">
                        <a class="cart-button" href="{{url('/cart')}}">
                            <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 "><!--Desenhando icon-->
                                <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                            </svg> Link
                            <span class="item-number ">0</span>
                        </a>
                    </div>
                </div>
                </div> 
            </div>
            <div class="container-fluid row2">
                <div class='container'>
                   <ul class="pull-left largenav">                
                       <li class="upper-links dropdown"><a class="links" href="#">Categories</a>
                        <ul class="dropdown-menu">
                            <!--Interando categorias, para o menu principal-->
                            @foreach($categories as $cat)
                                <li class="profile-li"><a class="profile-links" href="{{url('/').'/'.$cat['CategoryID']}}">{{$cat['CategoryName']}}</a></li>                            
                            @endforeach
                        </ul>
                        </li>
                        <li class="upper-links"><a class="links" href="#">Order History</a>                        
                    </ul>
                </div>
            </div>   
            
            <div id="mySidenav" class="sidenav">
                <div class="container" style="background-color: #2874f0; padding-top: 10px;">
                    <span class="sidenav-heading">GeekBooks</span>
                    <a href="javascript:void(0)" class="closebtn" id="closeMySideNav">×</a>
                </div>   
                <a class="links" href="#">
                    <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                        <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                    </svg> Link                     
                </a>   
                <div class="dropdown dropdown-side"><a class="links" href="#">Categories</a>
                        <ul class="dropdown-menu">
                            <!--Interando categorias, para o menu menor-->
                            @foreach($categories as $cat)
                                <li class="profile-li"><a class="profile-links" href="{{url('/').'/'.$cat['CategoryID']}}">{{$cat['CategoryName']}}</a></li>                            
                            @endforeach                            
                        </ul>
                </div>                
                <a class="links" href="#">Order History</a>
            </div>
        
        </div>
 

