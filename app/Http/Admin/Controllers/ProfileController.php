<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController
{
    public function edit(): View
    {
        $user = auth()->user();

        return view('admin.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = auth()->user();

        $userData = [
            'name' => $data['name'] ?? '',
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
        ];

        if(isset($data['password'])) {
           $userData['password'] = Hash::make($data['password']);
        }

        $user->update($userData);

        $user->mediaManage($request);

        return redirect()->route('admin.profile.edit',compact('user'));
    }
}
