<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        if ($request->search) {
            $all_posts = $this->post
                ->where('description', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')->withTrashed()->paginate(10);
        } else {
            $all_posts = $this->post->orderBy('created_at', 'desc')->withTrashed()->paginate(10);
        }

        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    public function hide($id)
    {
        $this->post->destroy($id);

        return redirect()->back();
    }

    public function unhide($id)
    {
        $this->post->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
