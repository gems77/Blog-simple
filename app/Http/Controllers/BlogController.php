<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
        /* Méthodes pour les posts*/
    public function addPost(Request $request){
        $validate=$request->validate([
            "title"=>"required|string|min:3",
            "content"=>"required"
        ]);
        
        if($validate){
            $post=new Post();
            $post->title=$request->title;
            $post->content=$request->content;
            $post->save();
            return redirect("/")->with("success","Succès");
        }
    }
    public function updatePost(Request $request, string $id){
        $validate=$request->validate([
            "title"=>"required|string|min:3",
            "content"=>"required"
        ]);
        $post=Post::find($id);
        if($validate){
            $post->title=$request->title;
            $post->content=$request->content;
            $post->save();
            return redirect("/")->with("success","Succès");
        }
    }
    public function deletePost(Request $request, string $id){
        $post=Post::findOrFail($id);
        
        if($post){
            $post->delete();
            return redirect("/")->with("success","Succès");
        }
    }
    
    public function getPostDetail(String $id){
        $post=Post::where("id", $id)->first();
        $comments=Comment::where("post_id", $id)->get();
        $NbrComment=Comment::where("post_id", $id)->count();
        
        return view("welcomeDetail", compact('post','comments','NbrComment'));
    }
    
    /* Méthodes pour les commentaires*/
    public function addComment(Request $request){
        $validate=$request->validate([
            "post_id"=>"required",
            "author_name"=>"required|string|min:3",
            "content"=>"required"
        ]);
        
        if($validate){
            $comment=new Comment();
            $comment->post_id=$request->post_id;
            $comment->author_name=$request->author_name;
            $comment->content=$request->content;
            $comment->save();
            return redirect("/")->with("success","Succès");
        }
    }
    public function updateComment(Request $request, string $id){
        $validate=$request->validate([
            "post_id"=>"required",
            "author_name"=>"required|string|min:3",
            "content"=>"required"
        ]);
        $comment=Comment::find($id);
        if($validate){
            $comment->post_id=$request->post_id;
            $comment->author_name=$request->author_name;
            $comment->content=$request->content;
            $comment->save();
            return redirect("/")->with("success","Succès");
        }
    }
    public function deleteComment(Request $request, string $id){
        $comment=Comment::findOrFail($id);
        
        if($comment){
            $comment->delete();
            return redirect("/")->with("success","Succès");
        }
    }
    
    
        /* Méthodes communes*/
        public function getInfos(){
            $posts=Post::all();
            $comments=Comment::all();
            
            return view("welcome", compact('posts','comments'));
        }
}
