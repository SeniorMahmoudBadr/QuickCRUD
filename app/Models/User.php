<?php

namespace App\Models;

use App\Traits\StatusScopes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, StatusScopes;

    protected $table = "users";

    protected string $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
    ];

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
    ];

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::needsRehash($value) ? bcrypt($value) : $value
        );
    }

    public function role(): HasOneThrough
    {
        return $this->hasOneThrough(
            Role::class,
            ModelHasRole::class,
            'model_id', // Foreign key on the ModelHasRole table...
            'id', // Foreign key on the Role table...
            'id', // Local key on the User table...
            'role_id' // Local key on the ModelHasRole table...
        );
    }

    public function scopeApplyFilters($query)
    {

    }

    public static function datatableColumnNames(): array
    {
        return [
            [
                'title' => '#',
                'data' => 'id',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => __('app.Name'),
                'data' => 'name',
                "searchable" => false,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => __('app.Email'),
                'data' => 'email',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => __('app.Status'),
                'data' => 'status',
                "searchable" => true,
                "orderable" => true,
                'visible' => true,
                "className" => "text-center"
            ],
            [
                'title' => __('app.Actions'),
                'data' => 'actions',
                "searchable" => false,
                "orderable" => false,
                'visible' => true,
                "className" => "text-center"
            ],
        ];
    }
}
