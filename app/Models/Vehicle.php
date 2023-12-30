<?php

namespace App\Models;

use App\Enums\VehicleStatus;
use App\Enums\VehicleCategory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = "vehicles";

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'brand_id',
        'category',
        'model',
        'license_plate',
        'year',
        'stnk_number',
        'bpkb_number',
        'chassis_number',
        'engine_number',
        'stnk_period',
        'tax_period',
        'photo',
        'office_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'category' => VehicleCategory::class,
        'status' => VehicleStatus::class
    ];

    protected $with = [
        'brand',
        'office',
        'user'
    ];

    protected $sortable = [
        'model',
        'category',
        'status'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('stnk_number', 'like', "%{$search}%")
                    ->orWhere('license_plate', 'like', "%{$search}%");
        });
    }
}
