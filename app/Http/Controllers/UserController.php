<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use App\Enums\Gender;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

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

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/profile'), $imageName);

            $validatedData['photo'] = $imageName;
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
