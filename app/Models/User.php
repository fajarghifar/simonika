<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\Vehicle;
use App\Models\Inventory;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $fillable = [
        'name',
        'nip',
        'nik',
        'gender',
        'address',
        'place_of_birth',
        'date_of_birth',
        'email',
        'phone',
        'photo',
        'role_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'gender' => Gender::class,
        'role_id' => Role::class
    ];

    protected $sortable = [
        'name',
        'role_id'
    ];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'user_id', 'id');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'user_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
        });
    }
}
