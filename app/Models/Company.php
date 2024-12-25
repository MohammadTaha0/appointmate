<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['name', 'image', 'is_active'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'company', 'id');
    }
    public function getUserCountAttribute()
    {
        return $this->users()->count();
    }

    public function getIsActiveNameAttribute()
    {
        return $this->attributes['is_active'] == 1 ? 'Yes' : 'No';
    }

    public function getIsActiveNameBadgeAttribute()
    {
        return $this->attributes['is_active'] == 1 ? '<span class="badge text-success border border-success border-2 updates" data-status="' . $this->attributes['is_active'] . '" data-id="' . $this->attributes['id'] . '" data-type="is_active">Yes</span>' : '<span class="badge text-danger border border-danger border-2 updates" data-status="' . $this->attributes['is_active'] . '" data-id="' . $this->attributes['id'] . '" data-type="is_active">No</span>';
    }

    public function getImageUrlAttribute()
    {
        return asset("storage/" . $this->attributes['image']);
    }

    public function getImagePathAttribute()
    {
        return public_path("storage/" . $this->attributes['image']);
    }
    public function getImageExistAttribute()
    {
        $path  = public_path("storage/" . $this->attributes['image']);
        if ($path && file_exists($path) && !is_dir($path)) {
            return true;
        }
        return false;
    }


    protected $appends = ['is_active_name', 'is_active_name_badge', 'image_url', 'image_path', 'image_exist', 'user_count'];
}
