<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = ['name', 'company'];

    public function getCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }
    public function getIsActiveNameAttribute()
    {
        return $this->attributes['is_active'] == 1 ? 'Yes' : 'No';
    }

    public function getIsActiveNameBadgeAttribute()
    {
        return $this->attributes['is_active'] == 1 ? '<span class="badge text-success border border-success border-2 updates" data-status="' . $this->attributes['is_active'] . '" data-id="' . $this->attributes['id'] . '" data-type="is_active">Yes</span>' : '<span class="badge text-danger border border-danger border-2 updates" data-status="' . $this->attributes['is_active'] . '" data-id="' . $this->attributes['id'] . '" data-type="is_active">No</span>';
    }
    protected $appends = ['is_active_name', 'is_active_name_badge'];
}
