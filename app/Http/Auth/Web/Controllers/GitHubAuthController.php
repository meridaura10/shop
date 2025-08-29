<?php

namespace App\Http\Auth\Web\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitHubAuthController extends Controller
{
    public function redirectToGitHub(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->stateless()->user();

        $user = User::query()->firstOrCreate(
            ['github_id' => $githubUser->id],
            [
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
                'password' => bcrypt(str()->random(16)),
            ]
        );

        if ($githubUser->avatar) {
            $user
                ->addMediaFromUrl($githubUser->avatar)
                ->toMediaCollection('avatar');
        }

        Auth::login($user, true);

        return redirect()->route('home');
    }
}
