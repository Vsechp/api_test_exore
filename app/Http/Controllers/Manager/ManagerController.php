<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Employee\StoreRequest;
use App\Http\Requests\Manager\Post\StorePostRequest;
use App\Http\Requests\Manager\Post\UpdatePostRequest;
use App\Http\Requests\Manager\Category\StoreCategoryRequest;
use App\Http\Requests\Manager\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ManagerController extends Controller
{
    public function index()
    {
        $manager = Auth::user();
        $users = User::where('manager_id', $manager->id)->count();
        $posts = Post::count();
        $categories = Category::count();

        $data = compact('users', 'posts', 'categories');

        return view('manager.main.index', compact('data', 'manager'));
    }

    public function employees()
    {
        $managerId = Auth::id();
        $employees = User::where('manager_id', $managerId)->get();
        return view('manager.employee.index', compact('employees'));
    }

    public function createEmployee()
    {
        $manager = Auth::user();
        return view('manager.employee.create', compact('manager'));
    }
    public function storeEmployee(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'employee';
        $data['manager_id'] = Auth::id();
        $employee = User::create($data);
        return redirect()->route('manager.employee.index');
    }

    public function showEmployee(User $employee)
    {
        $this->authorize('view', $employee);
        $posts = $employee->posts;
        return view('manager.employee.show', compact('employee', 'posts'));
    }

    public function editEmployee(User $employee)
    {
        $roles = User::getRoles();
        return view('manager.employee.edit', compact('employee', 'roles'));
    }

    public function updateEmployee(Request $request, User $employee)
    {
        $this->authorize('update', $employee);
        $data = $request->all();
        $employee->update($data);
        return view('manager.employee.show', compact('employee'));
    }

    public function deleteEmployee(User $employee)
    {
        $this->authorize('delete', $employee);
        $employee->delete();
        return redirect()->route('manager.employee.index');
    }


    public function posts()
    {
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->paginate(10);
        return view('manager.post.index', compact('posts'));
    }

    public function createPost()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        return view('manager.post.create', compact('categories'));
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

        return redirect()->route('manager.post.index');
    }

    public function showPost(Post $post)
    {
        $this->authorize('view', $post);
        return view('manager.post.show', compact('post'));
    }

    public function editPost(Post $post)
    {
        $categories = Category::all();
        return view('manager.post.edit', compact('post', 'categories',));
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

        return view('manager.post.show', compact('post'));
    }

    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('manager.post.index');
    }


    public function categories()
    {
        $categories = Category::paginate(10);
        return view('manager.category.index', compact('categories'));
    }

    public function createCategory()
    {
        $this->authorize('create', Category::class);
        $categories = Category::all();
        return view('manager.category.create', compact('categories'));
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
            $data = $request->validated();
            Category::FirstOrcreate($data);
            return redirect()->route('manager.category.index');
    }

    public function showCategory(Category $category)
    {
        return view('manager.category.show', compact('category'));
    }

    public function editCategory(Category $category)
    {
        return view('manager.category.edit', compact('category'));
    }

    public function updateCategory(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $data = $request->validated();
        $category->update($data);
        return view('manager.category.show', compact('category'));
    }

    public function deleteCategory(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('manager.category.index');
    }

}
