@include('../templates/headerbase')

<div class="container-body container footerAjust">
    <h1>Digite seu email:</h1>
    <form action="{{url('/user/login')}}" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <div class="form-group"><label>Email:</label> <input class="form-control" name="email"/></div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>

@include('../templates/footerBase')
