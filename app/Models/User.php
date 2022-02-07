<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'id_number',
        'image',
        'date_birth',
        'id_image',
        'type',
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


    public function details()
    {
        return $this->hasOne(Orphan::class,'user_id');
    }

    public function orphans()
    {
        return $this->belongsToMany(User::class,'sponsor_orphans','sponsor_id','orphan_id')->withPivot(['warranty_value','warranty_period','start_warranty_date']);
    }

    public function sponsors()
    {
        return $this->belongsToMany(User::class,'sponsor_orphans','orphan_id','sponsor_id')->withPivot(['warranty_value','warranty_period','start_warranty_date']);
    }
}
