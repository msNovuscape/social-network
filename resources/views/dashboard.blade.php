@extends('layouts.master')

@section('content')
    @include('includes.errors')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say??</h3></header>
            {!! Form::open(['route' => 'post.create']) !!}
            <div class="form-group">

                {{Form::textarea('name',null, ['id' => 'new-post','name' => 'body','class' => 'form-control','rows'=>'5'])}}
            </div>
            {{Form::submit('Create Post',['class' => 'btn btn-primary'])}}

            {{Form::close()}}
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What other people say..</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                <p>{{$post->body}}</p>
                <div class="info">
                    Posted by {{$post->user->name}} at {{$post->created_at}}
                </div>
                    @php
                     $like = $post->likes;
                    @endphp
                <div class="interaction">
                    <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 1 ? 'You liked this post' :'Like' :'Like'}}</a>
                    <a href="" class="badge" id="likeNumber">{{$like->where('like',true)->isNotEmpty() ? $like->where('like',true)->count() : ''}}</a>|
                    <a href="" class="like">{{Auth::user()->likes()->where('post_id',$post->id)->first() ? Auth::user()->likes()->where('post_id',$post->id)->first()->like == 0 ? 'You disliked this post' :'Dislike' :'Dislike'}}</a>
                    <a href="" class="badge" id="dislikeNumber" d>{{$like->where('like',false)->isNotEmpty() ? $like->where('like',false)->count() : ''}}</a>

                @if($post->user_id === Auth::user()->id)
                        |
                    <a href="" class="edit">Edit</a> |
                    <a href="{{route('post.delete',['id' => $post->id])}}">Delete</a> |
                    @endif
                </div>
            </article>


                {{--<div id="likePeople">

                </div>--}}
            @endforeach
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open() !!}
                    <div class="form-group">
                        {{Form::textarea('name',null, ['id' => 'post-body','name' => 'post-body','class' => 'form-control','rows'=>'5'])}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="likeModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">People who liked</h4>
                </div>
                <div id="like-user" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        var editUrl = '{{route('post.update')}}';
        var token = '{{Session::token()}}';
        var likeUrl = '{{route('post.like')}}';
        var likePeopleUrl = '{{route('post.likePeople')}}';


    </script>

@endsection

