<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
class BlogController extends Controller {
    public function index() {
        $posts = BlogPost::active()->with('media')->latest('published_at')->paginate(12);
        return view('blog.index', compact('posts'));
    }
    public function show(BlogPost $post) {
        abort_unless($post->is_active, 404);
        $post->load('media');
        $related = BlogPost::active()->where('id','!=',$post->id)->latest('published_at')->limit(3)->get();
        return view('blog.show', compact('post','related'));
    }
}
