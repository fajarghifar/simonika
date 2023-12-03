<?php

namespace App\Models;

use App\Enums\BrandCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'category'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'category' => BrandCategory::class
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }

    // public function inventories()
    // {
    //     return $this->hasMany(Inventory::class);
    // }

    // public function vehicles()
    // {
    //     return $this->hasMany(Vehicle::class);
    // }
}
