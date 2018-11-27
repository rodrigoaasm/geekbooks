<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>GeekBooks</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <link href="{{url('css/headerbase.css')}}" rel="stylesheet">
    <script src="{{url('js/headerbase.js')}}"></script>


</head>
<body>
<div class="container">
    <h1>Novo usuário</h1>

    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach( $errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif

    <form action="{{url('/user/check')}}" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <div class="form-group"><label>Email:</label> <input readonly="readonly" class="form-control" name="email"
                                                             value="{{$e or $usr['email']}}"></div>
        <div class="form-group"><label>First Name:</label> <input class="form-control" name="fname"
                                                                  value="{{$usr['fname'] or ''}}"></div>
        <div class="form-group"><label>Last Name:</label> <input class="form-control" name="lname"
                                                                 value="{{$usr['lname'] or ''}}"></div>
        <div class="form-group"><label>Street:</label> <input class="form-control" name="street"
                                                              value="{{$usr['street'] or ''}}"></div>
        <div class="form-group"><label>City:</label> <input class="form-control" name="city"
                                                            value="{{$usr['city'] or ''}}"></div>
        <div class="form-group"><label>State:</label> <input class="form-control" name="state"
                                                             value="{{$usr['state'] or ''}}"></div>
        <div class="form-group"><label>Zip:</label> <input class="form-control cep-mask" name="zip"
                                                           value="{{$usr['zip'] or ''}}"></div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>
</body>

@include('../templates/footerBase')