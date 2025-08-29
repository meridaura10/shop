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

    public function update(ProfileRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if($user->id != auth()->id()){
            return redirect()->route('admin.profile.edit', $user);
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        if($data['password']) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        $user->mediaManage($request);

        return redirect()->route('admin.profile.edit',compact('user'));
    }
}
