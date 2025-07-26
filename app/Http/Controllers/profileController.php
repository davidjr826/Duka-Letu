<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        
        return view('admin.profile', [
            'user' => $user,
            'photo' => $user->photo ? Storage::url($user->photo) : asset('/images/login.jpg')
        ]);
    }

    // public function update(Request $request)
    // {
    //     $user = auth()->user();
        
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'middle_name' => 'nullable|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'username' => 'required|string|max:255|unique:users,username,'.$user->id,
    //         'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
    //         'phone' => 'nullable|string|max:20',
    //         'gender' => 'nullable|in:Male,Female,Other',
    //         'birth_date' => 'nullable|date',
    //         'joining_date' => 'nullable|date',
    //         'about' => 'nullable|string|max:500',
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     if (!empty($validated['password'])) {
    //         $validated['password'] = Hash::make($validated['password']);
    //     } else {
    //         unset($validated['password']);
    //     }

    //     $user->update($validated);

    //     return back()->with('success', 'Profile updated successfully');
    // }


    public function updateProfile(Request $request)
    {

        //dd('Update Profile Method Called'); // Placeholder for debugging
        $user = auth()->user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'about_me' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        //dd($user); // Debugging output

        return back()->with('success', 'Profile updated successfully');
    }


    // public function updatePicture(Request $request)
    // {
    //     $request->validate([
    //         'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

   

    //     if ($request->hasFile('photo')) {
    //         // Delete old photo if exists
    //         if (auth()->user()->photo) {
    //             Storage::disk('public')->delete(auth()->user()->photo);
    //         }
            
    //         $path = $request->file('photo')->store('profile-photos', 'public');
    //         auth()->user()->update(['photo' => $path]);
    //     }

    //     return back()->with('success', 'Profile picture updated successfully');
    // }



    public function updatePicture(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $user = auth()->user();
    
    if ($request->hasFile('photo')) {
        // Delete old photo if exists
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        
        // Store new photo and get full public URL
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->update(['photo' => $path]);

        // dd($user->photo); // Debugging output to check the stored path
        
        // Return the new photo URL in the response
        return back()
            ->with('success', 'Profile picture updated successfully')
            ->with('photo_url', Storage::url($path));
    }

    return back()->with('error', 'No photo was uploaded');
}


}