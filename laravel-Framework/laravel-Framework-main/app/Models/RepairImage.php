<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairImage extends Model
{
    protected $fillable = ['repair_id', 'image_type', 'image_path'];

    public function repairRequest(): BelongsTo
    {
        return $this->belongsTo(RepairRequest::class, 'repair_id');
    }
}
