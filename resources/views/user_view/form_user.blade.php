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
    <h1>Nova Notícia</h1>
    <form action="{{url('/user/add')}}" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <div class="form-group"><label>Email:</label> <input class="form-control" name="email" value="{{$e}}"></div>
        <div class="form-group"><label>First Name:</label> <input class="form-control" name="fname"></div>
        <div class="form-group"><label>Last Name:</label> <input class="form-control" name="lname"></div>
        <div class="form-group"><label>Street:</label> <input class="form-control" name="street"></div>
        <div class="form-group"><label>City:</label> <input class="form-control" name="city"></div>
        <div class="form-group"><label>State:</label> <input class="form-control" name="state"></div>
        <div class="form-group"><label>Zip:</label> <input class="form-control" name="zip"></div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>
</body>

@include('../templates/footerBase')