<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
        'is_active',
        'company'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company', 'id');
    }

    public function getRoleNameAttribute()
    {
        return $this->attributes['role'] === 'SA' ? 'Super Admin' : '';
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


    protected $appends = ['role_name', 'is_active_name', 'is_active_name_badge', 'image_url', 'image_path', 'image_exist'];
}
