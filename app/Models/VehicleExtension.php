<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use App\Enums\VehicleExtensionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleExtension extends Model
{
    use HasFactory, Sortable;

    protected $table = "vehicle_extensions";

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'vehicle_id',
        'document',
        'stnk_period',
        'tax_period',
        'requested_by',
        'approved_by',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => VehicleExtensionStatus::class
    ];

    protected $with = [
        'vehicle',
        'approvedBy',
        'requestedBy'
    ];

    protected $sortable = [
        'status',
        'created_at',
        'updated_at',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by', 'id');
    }
}
