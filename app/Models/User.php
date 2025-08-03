<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
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
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
