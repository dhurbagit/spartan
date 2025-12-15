<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('backend.userProfile.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();  // current logged-in user

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255', 'unique:users,name,' . $user->id],
            'organization' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'regex:/^\+?[0-9]{7,15}$/'],
            'birthday' => ['nullable', 'date'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // password optional
            // 'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            // avatar upload
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'], //5120 KB = 5 MB
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Handle password
        // if (!empty($validated['password'])) {
        //     $validated['password'] = Hash::make($validated['password']);
        // } else {
        //     unset($validated['password']);
        // }

        $user->update($validated);

        return redirect()
            ->route('profile.edit')
            ->with('status', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
