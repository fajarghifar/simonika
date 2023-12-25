<?php

namespace App\Models;

use App\Models\Role;
use App\Enums\Gender;
use App\Models\Vehicle;
use App\Models\Inventory;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Sortable;

    protected $table = "users";

    protected $dates = ['deleted_at'];

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
        'deleted_at' => 'datetime',
        'gender' => Gender::class
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
        });
    }
}
