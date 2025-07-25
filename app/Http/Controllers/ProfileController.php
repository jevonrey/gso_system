<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(Request $request)
{
    $user = Auth::user();
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]); 
    if ($request->hasFile('photo')) {
    $file = $request->file('photo');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('profile_pictures'), $filename);

    // Optional: delete old photo if exists
        // if ($user->photo) {
        //     Storage::delete('public/profile_pictures/' . $user->photo);
        // }
        $user->photo = $filename;
    }
    
    // Save other fields if needed
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
