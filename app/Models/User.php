<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\Vehicle;
use App\Models\Inventory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'gender' => Gender::class,
        'role_id' => Role::class
    ];

    /**
     * Get the inventories associated with the user.
     */
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'user_id', 'id');
    }

    /**
     * Get the vehicles associated with the user.
     */
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
