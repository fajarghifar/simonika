<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Enums\Gender;
use Illuminate\View\View;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\VehicleDetail;
use App\Models\InventoryDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function index() : View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $users = User::filter(request(['search']))
            ->sortable()
            ->paginate($perPage)
            ->appends(request()->query());

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create() : View
    {
        return view('users.create', [
            'genders' => Gender::cases(),
            'roles' => Role::all()
        ]);
    }

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

    public function show(User $user) : View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function showUserInventories(User $user) : View
    {
        $userInventories = $user->load('inventories');

        return view('users.user-inventories', [
            'user' => $user,
            'inventories' => $userInventories->inventories
        ]);
    }

    public function showUserVehicles(User $user) : View
    {
        $userVehicles = $user->load('vehicles');

        return view('users.user-vehicles', [
            'user' => $user,
            'vehicles' => $userVehicles->vehicles
        ]);
    }

    public function edit(User $user) : View
    {
        return view('users.edit', [
            'user' => $user,
            'genders' => Gender::cases(),
            'roles' => Role::all()
        ]);
    }

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

    public function destroy(User $user) : RedirectResponse
    {
        VehicleDetail::where('user_id', $user->id)->delete();
        InventoryDetail::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }

    public function showRecycled(): View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $users = User::onlyTrashed()
            ->sortable()
            ->filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('users.recycle', [
            'users' => $users,
        ]);
    }

    public function restoreRecycled($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        return redirect()
            ->route('users.recycle.show')
            ->with('success', 'User berhasil dipulihkan!');
    }

    public function deleteRecycled($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $filePath = public_path('images/profile/' . $user->photo);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $user->forceDelete();

        return redirect()
            ->route('users.recycle.show')
            ->with('success', 'Pengguna berhasil dihapus permanen!');
    }

    // Import Excel
    public function import(Request $request)
    {
        return view('users.import');
    }

    public function importHandler(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new UsersImport, $file);

        return redirect()
            ->route('users.index')
            ->with('success', 'Excel file imported successfully!');
    }

    // Excel Export
    public function export(){
        $file_name = 'users_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new UsersExport, $file_name);
    }
}
