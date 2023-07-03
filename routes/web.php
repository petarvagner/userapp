<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Laravel\Sanctum\PersonalAccessToken;

Route::get('/login',[ LoginController::class, 'login' ])->name('login');
Route::post('/login',[ LoginController::class, 'authenticate' ])->name('login');
Route::get('/register',[ RegisterController::class, 'register' ])->name('register');
Route::post('/users', [ UsersController::class, 'create' ])->name('users/create');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    });
    Route::get('/users/{id}',[ UsersController::class, 'edit' ]);

    Route::post('/users/{id}',[ UsersController::class, 'update' ]);

    Route::post('/tokens', function (HttpRequest $request) {
        $params = $request->validate([
            'name' => [
                'min:3',
                'string',
                Rule::unique('personal_access_tokens')->where(fn (Builder $query) => $query->where('tokenable_id', '=', $request->user()->id))
            ]
        ]);
        $token = $request->user()->createToken(...$params);

        return Inertia::render('Users/Edit', [
            'token' => $token->plainTextToken
        ]);
    });

    Route::delete('/tokens/{id}', function (HttpRequest $request, string $id) {
        $token = PersonalAccessToken::findOrFail($id);
//        dd($token, $request->user());
        if ($request->user()->id !== $token->tokenable_id) {
            abort(404);
        }

        $token->delete();

        return redirect('/users/'.$request->user()->id);
    });

    Route::post('/logout', function (HttpRequest $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    });
});

