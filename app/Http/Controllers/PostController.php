<?php

namespace App\Http\Controllers;

use App\Event\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Jobs\ProcessPodcast;
use App\Jobs\UploadBigFile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostCreated as NotificationsPostCreated;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
        // $this->middleware('password.confirm')->except('edit');
    }

    public function index()
    {
        $posts=Post::latest()->paginate(3);

        return view('posts.index')->with('posts',$posts);
     }

    public function create()
    { 
        return view('posts.create')->with([
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        if($request->hasFile('photo')){
            $name=$request->file('photo')->getClientOriginalName();
            $path=$request->file('photo')->storeAs('post-photos',$name);
        }
        $post=Post::create([
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'short_content'=>$request->short_content,
            'content'=>$request->content,
            'photo'=>$path ?? null
        ]);

        if(isset($request->tags)){
            foreach($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }
        PostCreated::dispatch($post);
        ChangePost::dispatch($post)->onQueue('uploading');
        // auth()->user()->notify(new NotificationsPostCreated($post));
        Notification::send(auth()->user(),new NotificationsPostCreated($post));
        // auth()->user()->notify(new NotificationsPostCreated($post));


        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post'=>$post,
            'recent_posts'=>Post::latest()->get()->except($post->id)->take(5),
            'categories'=>Category::all(),
            'tags'=>Tag::all(),
        ]);
    }

    public function edit(Post $post)
    {
    // Gate::authorize('update-post', $post);
    Gate::authorize('update', $post);

        return view('posts.edit')->with(['post'=>$post]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // Gate::authorize('update-post', $post);
        Gate::authorize('update', $post);
        
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }
        if($request->hasFile('photo')){
            $name=$request->file('photo')->getClientOriginalName();
            $path=$request->file('photo')->storeAs('post-photos',$name);
        }

        $post->update([
            'title'=>$request->title,
            'short_content'=>$request->short_content,
            'content'=>$request->content,
            'photo'=>$path ?? $post->photo,
        ]);
        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    public function destroy(Post $post)
    {
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}