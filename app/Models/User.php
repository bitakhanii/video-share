<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Topic\Badge;
use App\Models\Topic\Topic;
use App\Models\Topic\Reply as TopicReply;
use App\Models\Topic\UserStat;
use App\Services\MagicLogin\Traits\MagicallyAuthenticable;
use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use App\Services\TwoFactorAuth\Traits\HasTwoFactorAuth;
use App\Support\Coupon\Traits\Couponable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, MagicallyAuthenticable, HasTwoFactorAuth, HasPermissions, HasRoles, Couponable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'provider',
        'name',
        'email',
        'provider_id',
        'avatar',
        'password',
        'phone_number',
        'has_2fa',
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

    public function getGravatarAttribute()
    {
        $hash = md5($this->email);
        return "https://s.gravatar.com/avatar/$hash";
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'repliable');
    }

    public function isAdmin()
    {
        return $this instanceof Admin;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function topicReplies()
    {
        return $this->hasMany(TopicReply::class);
    }

    public function userStat()
    {
        return $this->hasOne(UserStat::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function incrementXP($number = 1)
    {
        $this->userStat->xp += $number;
        $this->userStat->save();
    }

    public function incrementTopicCount()
    {
        $this->userStat->topic_count++;
        $this->userStat->save();
    }

    public function incrementReplyCount()
    {
        $this->userStat->reply_count++;
        $this->userStat->save();
    }
}
