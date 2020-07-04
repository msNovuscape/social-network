<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class PostController extends Controller
{
    public  function dashboard(){
        $posts = Post::orderBy('created_at','desc')->get();
        /*foreach ($posts as $post){
            $post->likes() ? $post->likes()->where('user_id',Auth::user()->id);
        }*/
        return view('dashboard',compact('posts'));
    }

    public function create(Request $request){
        $this->validate($request,[
           'body' => 'required'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = "There was an error!Please try again.";
        if ($request->user()->posts()->save($post)){
            $message = "Post Successfully created!";
        }
        return redirect()->route('dashboard')->with(['message' => $message]);

    }

    public function update(Request $request){
        $validator = \Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json(['validationErrors' => $validator->errors()->all()],422);
        }
        $post = Post::find($request['id']);
        if (!$post || Auth::user() != $post->user){
            return response()->json(['msg' => 'You cannot perform this action!'],200);
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['body' => $post->body,'msg' => 'Successfully edited!'],200);
    }

    public function delete($id){
        $post = Post::find($id);
        if (!$post || Auth::user() != $post->user){
            return redirect()->route('dashboard');
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Post wss successfully deleted!']);

    }

    public function like(Request $request){
        $update = false;
        $isLike = $request['isLike'] === 'true';
        $user = Auth::user();
        $post = Post::find($request['postId']);
        $like = $user->likes()->where('post_id',$post->id)->first();
        if ($like){
            $update = true;
            $already_like = $like->like;
            if($already_like == $isLike){
                $like->delete();
                return null;
            }
        }else{
                $like = new Like();
        }
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->like = $isLike;
        if ($update){
            $like->update();
        }else{
            $like->save();
        }
       return null;
    }

    public function likePeople(Request $request){
        $post = Post::find($request->postId);
        $isLike = $request['isLike'] === 'true';
        $likes = $post->likes()->where('like',$isLike)->get();
        $likes->transform(function ($value){
            return $value->user->name;
        });
        return response()->json(['user' => $likes],200);
    }
}
