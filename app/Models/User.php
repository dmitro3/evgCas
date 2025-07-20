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
            'balance' => 'decimal:2',
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

    public function getCurrentRanksAttribute()
    {
        $userXp = $this->xp ?? 0;

        // Определяем какую группу из 5 рангов показать
        $allRanks = Rank::orderBy('xp_min')->get();

        // Находим в какой группе из 5 находится пользователь
        $groupIndex = floor($userXp / 500); // каждая группа из 5 рангов = 500 XP

        // Начальный индекс для группы из 5 рангов
        $startIndex = $groupIndex * 5;

        // Возвращаем 5 рангов с дополнительными данными
        return $allRanks->slice($startIndex, 5)->map(function($rank) {
            // Извлекаем уровень из названия (например, "silver 1" -> 1)
            $nameParts = explode(' ', $rank->name);
            $level = end($nameParts);

            return [
                'id' => $rank->id,
                'name' => $rank->name,
                'type' => $rank->type,
                'level' => $level,
                'xp_min' => $rank->xp_min,
                'xp_max' => $rank->xp_max,
            ];
        })->values();
    }

    public function getVipProgressAttribute()
    {
        $userXp = $this->xp ?? 0;

        // Определяем в какой группе из 5 рангов находится пользователь
        $groupIndex = floor($userXp / 500);

        // XP в начале текущей группы
        $groupStartXp = $groupIndex * 500;

        // Определяем какой ранг в группе (0-4)
        $rankInGroup = floor(($userXp - $groupStartXp) / 100);

        // Прогресс внутри текущего ранга (0-1)
        $progressInRank = (($userXp - $groupStartXp) % 100) / 100;

        // Общий прогресс: позиция до текущего ранга + прогресс внутри ранга
        $totalProgress = ($rankInGroup + $progressInRank) / 4 * 100;

        return min(100, max(0, $totalProgress));
    }

    protected $appends = ['kyc_step', 'notifications_count', 'chat_id', 'current_ranks', 'vip_progress'];

    public function getChatIdAttribute()
    {
        return Chat::where('user_id', $this->id)->first()->id;
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}