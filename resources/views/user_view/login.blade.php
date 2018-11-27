@include('../templates/headerbase')

<div class="container-body container footerAjust">
    <h1>Digite seu email:</h1>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach( $errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <form action="{{url('/user/login')}}" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <div class="form-group"><label>Email:</label> <input class="form-control" name="email" value="{{$e or ''}}"/></div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>

@include('../templates/footerBase')
