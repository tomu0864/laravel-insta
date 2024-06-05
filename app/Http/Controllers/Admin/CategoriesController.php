<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $category;
    private $post;


    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $all_categoreis = $this->category->orderBy('name')->paginate(10);

        // count uncategorized posts
        $all_posts = $this->post->all();
        $count = 0;
        foreach ($all_posts as $post) {
            if ($post->categoryPosts->count() == 0) {
                $count++;
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categoreis)
            ->with('uncategorized_count', $count);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|max:50|unique:categories,name',
        ]);

        $this->category->create([
            'name' => ucwords($request->category),
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->category->findOrFail($id)->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $fieldName = "category$id";

        $request->validate([
            $fieldName => 'required|max:50|unique:categories,name,' . $id, //ignore
        ]);

        $category = $this->category->findOrFail($id);

        $category->update([
            'name' => ucwords($request->$fieldName),
        ]);

        return redirect()->back();
    }
}
