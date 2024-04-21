<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Base\PermissionsList;
use App\Base\RolesList;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'university_id',
        'email',
        'college_id',
        'department_id',
        'state',
        'password',
    ];

    protected $appends = ['type'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }

    protected function type(): Attribute
    {
        $type = null;
        if ($this->hasPermissionTo(PermissionsList::STUDENT)) {
            $type = PermissionsList::STUDENT;
        }
        // if ($this->hasPermissionTo(PermissionsList::SUPERVISOR)) {
        //     $type = PermissionsList::SUPERVISOR;
        // }
        // if ($this->hasPermissionTo(PermissionsList::ADMIN)) {
        //     $type = PermissionsList::ADMIN;
        // }
        // if ($this->hasPermissionTo(PermissionsList::GPC)) {
        //     $type = PermissionsList::GPC;
        // }

        return Attribute::make(
            get: fn () => $type
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(RolesList::ROLE_STUDENT);
    }
}
