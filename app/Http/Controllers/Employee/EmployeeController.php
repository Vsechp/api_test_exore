<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Post\StorePostRequest;
use App\Http\Requests\Manager\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data['posts'] = Post::where('user_id', $user->id)->count();
        $data['categories'] = Category::count();

        return view('employee.main.index', compact('data', 'user'));
    }
    public function posts()
    {
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->paginate(10);
        return view('employee.post.index', compact('posts'));
    }
    public function createPost()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        return view('employee.post.create', compact('categories'));
    }
    public function storePost(StorePostRequest $request)
    {
        $data = $request->validated();

        $previewImageName = $request->file('preview_image')->store('public/images');
        $mainImageName = $request->file('main_image')->store('public/images');
        $post = new Post;
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->preview_image = str_replace('public/', '', $previewImageName);
        $post->main_image = str_replace('public/', '', $mainImageName);
        $post->category_id = $data['category_id'];
        $post->user_id = auth()->id();

        $post->save();

        return redirect()->route('employee.post.index');
    }
    public function showPost(Post $post)
    {
        $this->authorize('view', $post);
        return view('employee.post.show', compact('post'));
    }
    public function editPost(Post $post)
    {
        $categories = Category::all();
        return view('employee.post.edit', compact('post', 'categories',));
    }
    public function updatePost(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validated();

        if($request->hasFile('preview_image')) {
            $previewImageName = $request->file('preview_image')->store('images', 'public');
            $post->preview_image = $previewImageName;
        }

        if($request->hasFile('main_image')) {
            $mainImageName = $request->file('main_image')->store('images', 'public');
            $post->main_image = $mainImageName;
        }

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];

        $post->save();

        return view('employee.post.show', compact('post'));
    }
    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('employee.post.index');
    }
    public function categories()
    {
        $categories = Category::paginate(10);
        return view('employee.category.index', compact('categories'));
    }


}
