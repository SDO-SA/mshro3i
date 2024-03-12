<?php

namespace App\Models;

use App\Base\PermissionsList;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Supervisor extends Model
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

    protected function type(): Attribute
    {
        $type = null;

        if ($this->hasPermissionTo(PermissionsList::SUPERVISOR)) {
            $type = PermissionsList::SUPERVISOR;
        }

        return Attribute::make(
            get: fn () => $type
        );
    }
}
