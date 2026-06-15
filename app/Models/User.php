<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        SoftDeletes,
        HasApiTokens,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [

        'uuid',

        'first_name',

        'middle_name',

        'last_name',

        'suffix',

        'username',

        'email',

        'phone',

        'gender',

        'birth_date',

        'avatar',

        'address',

        'password',

        'is_active',

        'last_login_at',
    ];

    /**
     * Hidden attributes.
     *
     * @var list<string>
     */
    protected $hidden = [

        'password',

        'remember_token',
    ];

    /**
     * Attribute casting.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'birth_date' => 'date',

            'last_login_at' => 'datetime',

            'is_active' => 'boolean',

            'password' => 'hashed',
        ];
    }

    /**
     * Boot model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            $user->uuid = Str::uuid();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim(

            $this->first_name . ' ' .

                ($this->middle_name
                    ? $this->middle_name . ' '
                    : '') .

                $this->last_name . ' ' .

                ($this->suffix
                    ? $this->suffix
                    : '')
        );
    }
}