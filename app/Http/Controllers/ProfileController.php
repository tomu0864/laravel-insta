<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {

        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.show')->with('user', $user_a);
    }

    public function edit()
    {
        return view('user.profiles.edit');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate(
            [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    'max:50',
                    // updating-- unique:[table],[column].[id to ignore]
                    // saving new --unique:[table],[column]
                    Rule::unique('users')->ignore($user->id),
                ],
                'introduction' => 'max:100',
                'avatar' => 'max:1048|mimes:jpeg,png,jpg,gif',
            ],
            [
                'name.required' => 'Name can not be empty',
                'email.required' => 'Email can not be empty',
                'email.email' => 'Input type should be email',
            ]
        );
        // Another way of email unique validation
        // 'email' => 'unique:users,email,' .Auth::user()->id,

        $profile = $this->user->findOrFail($id);
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->introduction = $request->introduction;

        if ($request->avatar) {
            $profile->avatar = "data:image/" . $request->avatar->extension() .
                ";base64," . base64_encode(file_get_contents($request->avatar));
        }
        $profile->save();

        return redirect()->route('profile.show', $id);
    }

    public function followers($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.followers')->with('user', $user_a);
    }

    public function following($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.following')->with('user', $user_a);
    }

    public function updatePassword(Request $request)
    {
        // Current password is incorrect
        $user_a = $this->user->findOrFail(Auth::user()->id);
        if (!Hash::check($request->old_password, $user_a->password)) {
            return redirect()->back()->with('old_password_error', 'Current password is incorrect.');
        }

        // new password and current password
        if ($request->old_password == $request->new_password) {
            return redirect()->back()->with('same_password_error', 'New password cannot be the same as current password.');
        }

        // password confirmation
        // validation should be added on the new password
        // comfimation name should have same prefix that is name of new password  ex.(new_passwprd)_confirmation
        $request->validate([
            'new_password' => 'required|min:8|string|confirmed',
        ]);

        $user_a->password = Hash::make($request->new_password);
        $user_a->save();

        return redirect()->back()->with('password_success', 'Changed password successfully!');
    }

    // use session() to display message on blade
}
