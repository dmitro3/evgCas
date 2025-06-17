<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'balance',
        'domain_id',
        'worker_id',
        'xp',
        'abuse_mode',
        'banned',
        'win_mode',
        'fake_withdrawal',
        'min_deposit',
        'min_withdrawal',
        'registered_ip',
        'country_info',
    ];

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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'country_info' => 'array',
            'notifications_count' => 'integer',
        ];
    }

    public function slotSessions()
    {
        return $this->hasMany(SlotSession::class);
    }

    public function kycApplications()
    {
        return $this->hasMany(VerificationApplication::class);
    }

    public function wallets()
    {
        return $this->hasMany(UserWallet::class);
    }

    public function getKycStepAttribute()
    {
        $latestApplication = $this->kycApplications()->latest()->first();

        if (!$latestApplication) {
            return 1;
        }

        switch ($latestApplication->status) {
            case 'pending':
                return 2;
            case 'approved':
            case 'rejected':
                return 3;
            default:
                return 1;
        }
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getNotificationsCountAttribute()
    {
        return $this->notifications()->where('is_read', false)->count();
    }

    public function domain()
    {
        return $this->belongsTo(Panel\Domain::class);
    }

    protected $appends = ['kyc_step', 'notifications_count', 'chat_id'];

    public function getChatIdAttribute()
    {
        return Chat::where('user_id', $this->id)->first()->id;
    }
}