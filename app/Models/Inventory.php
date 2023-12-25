<?php

namespace App\Models;

use App\Enums\InventoryStatus;
use App\Enums\InventoryCategory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $table = "inventories";

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'brand_id',
        'model',
        'category',
        'serial_number',
        'purchased_date',
        'photo',
        'office_id',
        'user_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'category' => InventoryCategory::class,
        'status' => InventoryStatus::class
    ];

    protected $with = [
        'brand',
        'office',
        'user',
    ];

    protected $sortable = [
        'model',
        'category',
        'status'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function office(){
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                    ->where('model', 'like', '%' . $search . '%')
                    ->orWhere('serial_number', 'like', '%' . $search . '%');
        });
    }
}
