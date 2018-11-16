<div class="container-fluid row-nav">
    <div class="container">
        <div class="col-sm-12 col-md-12">
            <span class="h3">
                <a href="{{url('/')}}"><small>Home</small></a>
                @if(isset($histAcess))
                @foreach($histAcess as $ha)
                <small> > </small><a href="{{url($ha->getLink())}}"><small>{{$ha->getTitle()}}</small></a>
                @endforeach
                @endif
            </span>
        </div>
    </div>
</div>
