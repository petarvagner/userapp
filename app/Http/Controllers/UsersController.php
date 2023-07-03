<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // validate the request
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ]
        ]);
        // create new user
        User::create($attributes);
        // redirect to login page
        return redirect('/login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->user()->cannot('view', $request->user())) {
            abort(404);
        }
        return Inertia::render('Users/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attributes = $request->validate([
            'name' => 'max:80',
            'email' => ['email', Rule::unique('users')->ignore($id)],
            'newPassword' => [
                'sometimes',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ]
        ]);
        $user = User::find($id);
        $user->fill($attributes)->save();
        return isset($attributes['newPassword']) ? redirect('/login') : redirect('/users/'.$request->user()->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateApi(Request $request, string $id)
    {
        $attributes = $request->validate([
            'name' => 'max:80',
            'email' => ['email', Rule::unique('users')->ignore($id)],
            'newPassword' => [
                'sometimes',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ]
        ]);
        $user = User::find($id);
        $user->fill($attributes)->save();
//        dd();
        return new UserResource($user);
    }
}
