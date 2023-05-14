<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Tables\Posts;
use ProtoneMedia\Splade\Facades\Toast;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Posts::class
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        Toast::title('New post created successfully!');

        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        Toast::title('Post ' . $post->title . ' updated successfully!');

        return to_route('posts.index');
    }

    public function destroy(Post $post)
    {
        $destroy_post = $post->title;
        $post->delete();

        Toast::title('Post ' . $destroy_post . ' has been deleted!')->autoDismiss(3);

        return redirect()->back();
    }
}
