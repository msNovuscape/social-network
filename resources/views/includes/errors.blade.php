<div class="row error">
    <div class="col-md-6 col-md-offset-3">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
</div>

<div class="row success">
    @if(Session::has('message'))
        <div class="col-md-6 col-md-offset-3">
            {{Session::get('message')}}
        </div>
    @endif

</div>

