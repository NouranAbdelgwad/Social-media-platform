<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'picture_path',
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
        'password' => 'hashed',
    ];

    public function followers()
    {
        return $this->hasMany(Friend::class, 'friend_id')
                    ->where('status', 'pending');
    }

    public function following()
    {
        return $this->hasMany(Friend::class, 'user_id')
                    ->where('status', 'accepted');
    }
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_user_id')
                    ->withPivot('status') // Include status in pivot table
                    ->withTimestamps(); // Include timestamps
    }

    // Check if a user is following another user
    public function isFollowing($userId)
    {
        return $this->friends()->where('friend_user_id', $userId)->exists();
    }
}

