<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $category;
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post; //$this->post = new Post;
        //create connection to posts table; and create a new empty row in posts table
        $this->category = $category;
    }

    public function create()
    {
        // get all categories
        $all_categories = $this->category->all();

        return view('user.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required|array|between:1,3', // between min and max
            'description' => 'required|max:1000',
            'image'  => 'required|max:1048|mimes:jpeg,png,jpg,gif'
        ]);

        // Post table
        $this->post->description = $request->description;
        $this->post->image = "data:image/" . $request->image->extension() .
            ";base64," . base64_encode(file_get_contents($request->image));
        $this->post->user_id = Auth::user()->id;
        $this->post->save();

        // Pivot table(postCategories table)
        $category_posts = [];
        foreach ($request->categories as $category_id) {
            // Converts to associative array
            $category_posts[] = ['category_id' => $category_id];
        }

        // Create is just one row but create many is multiple rows
        $this->post->categoryPosts()->createMany($category_posts);

        return redirect()->route('home');
    }

    public function show($id)
    {
        $post_a = $this->post->findOrFail($id);

        return view('user.posts.show')->with('post', $post_a);
    }

    public function edit($id)
    {
        $all_categories = $this->category->all();
        $post = $this->post->findOrFail($id);

        // Make an array ot the post's categories
        $selected_categories = [];
        foreach ($post->categoryPosts as $category_post) {
            $selected_categories[] = $category_post->category_id;
        }

        return view('user.posts.edit', compact('all_categories', 'post', 'selected_categories'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'categories' => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image'  => 'max:1048|mimes:jpeg,png,jpg,gif'
        ]);

        // post
        $post_a = $this->post->findOrFail($id);

        $post_a->description = $request->description;
        if ($request->image) {
            $post_a->image = "data:image/" . $request->image->extension() .
                ";base64," . base64_encode(file_get_contents($request->image));
        }
        $post_a->save();

        // categories

        // delete current category_posts once easiest way
        $post_a->categoryPosts()->delete();

        $category_posts = [];
        foreach ($request->categories as $category_id) {
            // Converts to associative array
            $category_posts[] = ['category_id' => $category_id];
        }

        // Create is just one row but create many is multiple rows
        $post_a->categoryPosts()->createMany($category_posts);

        return redirect()->route('post.show', $id);
    }

    public function delete($id)
    {
        $post_a = $this->post->findOrFail($id);
        $post_a->forceDelete(); //permanent delete

        return redirect()->back();
    }
}
