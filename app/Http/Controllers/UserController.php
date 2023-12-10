<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Enums\Gender;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $users = User::filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        return view('users.create', [
            'genders' => Gender::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request) : RedirectResponse
    {
        $validatedData = $request->all();
        $validatedData['password'] = Hash::make($request->password);

        /**
         * Handle upload image
         */
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            $file->storeAs('user/', $filename, 'public');
            $validatedData['photo'] = $filename;
        }

        User::create($validatedData);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) : View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function showUserInventories(User $user) : View
    {
        // Menggunakan eager loading untuk memuat relasi inventories dan user
        $userInventories = $user->load('inventories');

        return view('users.user-inventories', [
            'user' => $user,
            'inventories' => $userInventories->inventories
        ]);
    }

    public function showUserVehicles(User $user) : View
    {
        // Menggunakan eager loading untuk memuat relasi vehicles dan user
        $userVehicles = $user->load('vehicles');

        return view('users.user-vehicles', [
            'user' => $user,
            'vehicles' => $userVehicles->vehicles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) : View
    {
        return view('users.edit', [
            'user' => $user,
            'genders' => Gender::cases(),
            'roles' => Role::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {
        $updateData = $request->validated();

        /**
        * Handle upload image
        */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $path = 'public/profile/';

            // Delete an old image if it exists.
            if ($user->photo) {
                $oldPhotoPath = $path . $user->photo;

                // Check if the old photo exists and is a file
                if (Storage::exists($oldPhotoPath) && is_file(storage_path('app/' . $oldPhotoPath))) {
                    Storage::delete($oldPhotoPath);
                }
            }

            // Store the new image to Storage.
            $file->storeAs($path, $fileName);
            $updateData['photo'] = $fileName;
        }

        $user->update($updateData);

        return redirect()
            ->route('users.edit', $user)
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
