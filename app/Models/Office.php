<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = "offices";

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name',
        'address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
