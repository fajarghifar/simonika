<?php

namespace App\Models;

use App\Enums\BrandCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = "brands";

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'category'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'category' => BrandCategory::class
    ];

    protected $sortable = [
        'name',
        'category'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
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
