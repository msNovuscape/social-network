@extends('layouts.master')

@section('title')
    Welcome Page
@endsection

@section('content')
<div class="row">

    <div class="col-md-6 col-sm-offset-3 signup" style="display: none">
        <h1>Sign Up</h1>
        {!! Form::open(['route' => 'user.signup']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}

            {{Form::text('name',null, ['id' => 'name','class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('address', 'Address')}}

            {{Form::text('address',null, ['id' => 'address','class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('email', 'E-Mail')}}

            {{Form::email('email',null, ['id' => 'email','class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('password', 'Password')}}

            {{Form::password('password', ['class' => 'form-control','id'=>'password'])}}
        </div>
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}

        {!! Form::close() !!}
    </div>


    <div class="col-md-6 col-md-offset-3 signin">
        <h1>Sign In</h1>
        {!! Form::open(['route' => 'user.signin']) !!}

            <div class="form-group">
                {{Form::label('email', 'E-Mail')}}

                {{Form::email('email',null, ['id' => 'email','class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {{Form::label('password', 'Password')}}

                {{Form::password('password', ['class' => 'form-control','id'=>'password'])}}
            </div>
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}

        {!! Form::close() !!}
        <p id= "sign-up">Don't have an account?<a href="">Sign up</a></p>

    </div>
</div>
    <script>
        var siginRoute  = {{route('user.signin')}}
    </script>
@endsection
