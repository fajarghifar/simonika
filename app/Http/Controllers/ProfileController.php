<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    public function changePassword(Request $request): View
    {
        return view('profile.change-password');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
            'genders' => Gender::cases(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $updateData = $request->validated();

        if ($request->hasFile('photo')) {
            $filePath = public_path('images/profile/' . $user->photo);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/profile'), $imageName);

            $updateData['photo'] = $imageName;
        }

        $user->update($updateData);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     // Delete an old image if it exists.
    //     if ($user->photo) {
    //         $path = 'public/profile/';
    //         $oldPhotoPath = $path . $user->photo;

    //         // Check if the old photo exists and is a file
    //         if (Storage::exists($oldPhotoPath) && is_file(storage_path('app/' . $oldPhotoPath))) {
    //             Storage::delete($oldPhotoPath);
    //         }
    //     }

    //     $user->delete();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()
    //         ->to('/');
    // }
}
