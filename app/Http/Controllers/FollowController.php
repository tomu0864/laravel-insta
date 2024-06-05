<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    public function store($user_id)
    {
        $this->follow->follower_id = Auth::user()->id;
        $this->follow->followed_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($user_id)
    {
        $this->follow->where('followed_id', $user_id)->where('follower_id', Auth::user()->id)->delete();

        return redirect()->back();
    }
}
