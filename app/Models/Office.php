<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Office extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'code',
        'name',
        'address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $sortable = [
        'code',
        'name'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
        });
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
