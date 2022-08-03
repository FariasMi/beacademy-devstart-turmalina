<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'cpf',
        'phone',
        'date_of_birth',
        'email',
        'password',
        'is_admin',
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

    public function getUsers(string $search = null) {
        $users = $this->where(function ($query) use ($search) {
            if ($search) {
                $query->where("email", $search);
                $query->orWhere("name", "LIKE", "%{$search}%");
                $query->orWhere("last_name", "LIKE", "%{$search}%");
                $query->orWhere("id", "LIKE","%{$search}%");
            }
        })->paginate(8);

        return $users;
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }

}