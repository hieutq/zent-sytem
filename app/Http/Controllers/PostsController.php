<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use DB;


class PostsController extends Controller
{

    public function getPosts()
    {
      
       $posts = Post::orderBy('id','DESC')->paginate(5);
        $users = User::all();
       return view('posts.posts',['posts' => $posts,'users' => $users]);
    }

    public function getCreatePosts(){
    $posts = Post::orderBy('id','DESC')->get();
        $users = User::all();
        return view('posts.createpost',['posts' => $posts,'users' => $users]);
    }
   
    public function postCreatePosts(Request $data)
    {   

        $post = new Post;
        $post->title = $data->title;
        $post->description = $data->description;
        $post->content = $data->content;
        $post->slug = $data->slug;
        $post->video = $data->video;
        $post->user_id = $data->user_id;
        $post->type = $data->type;
        $post->status = $data->status;
        
        if ($data->hasFile('image')) {
          $file = $data->file('image');

          $name = $file->getClientOriginalName();
          $image = str_random(4)."_".$name;
          while (file_exists("upload/tintuc/".$image)) {
            $image = str_random(4)."_".$name;
          }
          $file->move("upload/tintuc",$image);
          $post->image = $image;
          $post->image_icon = $image;
          
        }
        else{
          $data->image = "";
           $data->image_icon = "";
          
        }

        $post->save();

         return Redirect(url('tintuc/danhsach'));
        

    }

    public function viewPosts($id){
      $post = Post::find($id);
      $users = User::all();
      return view('posts.viewpost',['post' => $post,'users' => $users]);
    }

    public function deletePosts($id){
      $post = Post::find($id);
      $post->delete();
      return Redirect(url('tintuc/danhsach'));
    }

    public function getEditPosts($id){
      $post = Post::find($id);
      $users = User::all();
      return view('posts.editpost',['post' => $post,'users' => $users]);
    }
    public function postEditPosts(Request $data,$id)
    {
         $post = Post::find($id);
        $post->title = $data->title;
        $post->description = $data->description;
        $post->content = $data->content;
        $post->slug = $data->slug;
        $post->video = $data->video;
        $post->user_id = $data->user_id;
        $post->type = $data->type;
        $post->status = $data->status;


        if ($data->hasFile('image')) {
          $file = $data->file('image');

          $name = $file->getClientOriginalName();
          $image = str_random(4)."_".$name;
          while (file_exists("upload/tintuc/".$image)) {
            $image = str_random(4)."_".$name;
          };
          if(isset($post) && $post->image > 0){
          unlink("upload/tintuc/".$post->image);
          $file->move("upload/tintuc",$image);
          $post->image = $image;}
          else {
          $file->move("upload/tintuc",$image);
          $post->image = $image;
          $post->image_icon = $image;
          }
          
        }
        // if ($data->hasFile('image_icon')) {
        //   $file = $data->file('image_icon');

        //   $name = $file->getClientOriginalName();
        //   $images = str_random(4)."_".$name;
        //   while (file_exists("upload/tintuc/".$images)) {
        //     $images = str_random(4)."_".$name;
        //   };
        //    if(isset($post) && $post->image_icon > 0){
        //   unlink("upload/tintuc/".$post->image_icon);
        //   $file->move("upload/tintuc",$images);
        //   $post->image_icon = $images;
        //   } else {
        //   $file->move("upload/tintuc",$images);
        //   $post->image_icon = $images;
        //   }
      
        // }
        $post->save();
        return Redirect(url('tintuc/danhsach'));
        

    }

}
