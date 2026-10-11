<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairRequest extends Model
{
    protected $fillable = [
        'request_no',
        'user_id',
        'building',
        'room',
        'problem_type',
        'description',
        'urgency',
        'status',
        'assigned_to',
        'due_date',
        'completion_date',
        'cost',
        'result'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function images(): HasMany
    {
        return $this->hasMany(RepairImage::class, 'repair_id');
    }
}
