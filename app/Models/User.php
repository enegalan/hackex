<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'ip',
        'level',
        'exp',
        'oc',
        'checking_bitcoins',
        'secured_bitcoins',
        'log',
        'antivirus_level',
        'spam_level',
        'spyware_level',
        'firewall_level',
        'bypasser_level',
        'password_cracker_level',
        'password_encryptor_level',
        'notepad_level',
        'platform_id',
        'network_id',
        'max_savings',
        'reputation',
        'score',
        'monthly_score',
    ];
    function Platform() {
        return $this->belongsTo(Platform::class);
    }
    public function Network() {
        return $this->belongsTo(Network::class);
    }
    public function Bypass() {
        return $this->hasMany(Bypass::class);
    }
    public function Transfer() {
        return $this->hasMany(Transfer::class);
    }
    public function Crack() {
        return $this->hasMany(Crack::class);
    }
    public function DailyLogin() {
        return $this->hasMany(DailyLogin::class);
    }
    public function UserWallpaper() {
        return $this->hasOne(UserWallpaper::class);
    }
    public function Friend() {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('accepted', true);
    }
    public function FriendRequest() {
        return $this->hasMany(Friendship::class, 'user_id');
    }
    public function SentMessage() {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function ReceivedMessage() {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function Wallpaper() {
        return $this->hasOneThrough(
            Wallpaper::class,
            UserWallpaper::class,
            'user_id',       // Foreign key on user_wallpapers
            'id',            // Foreign key on wallpapers
            'id',            // Local key on users
            'wallpaper_id'   // Local key on user_wallpapers
        );
    }
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
    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }
}
