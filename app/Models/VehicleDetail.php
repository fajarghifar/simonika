<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vehicle;
use App\Enums\VehicleDetailStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'vehicle_id',
        'user_id',
        'borrowed_date',
        'returned_date',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => VehicleDetailStatus::class,
    ];

    protected $with = [
        'vehicle',
        'user'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
