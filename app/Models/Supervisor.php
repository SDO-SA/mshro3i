<?php

namespace App\Models;

use App\Base\PermissionsList;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Supervisor extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'university_id',
        'email',
        'department_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function group(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    protected function type(): Attribute
    {
        $type = null;

        // if ($this->hasPermissionTo(PermissionsList::SUPERVISOR)) {
        //     $type = PermissionsList::SUPERVISOR;
        // }

        return Attribute::make(
            get: fn () => $type
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
