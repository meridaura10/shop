<?php

namespace App\Models;

use App\Models\Traits\HasStaticLists;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Facade as Avatar;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Fomvasss\MediaLibraryExtension\HasMedia\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasStaticLists, InteractsWithMedia, HasRoles;

    const STATUS_ACTIVE = 'active';

    const STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id',
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

    protected $mediaSingleCollections = ['avatar'];

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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->where('type', Order::TYPE_ORDER);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Order::class)->where('type', Order::TYPE_CART);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query
            ->when($filters['email'] ?? null, fn($q, $v) => $q->where('email', 'like', "%{$v}%"))
            ->when($filters['date'] ?? null, fn($q, $v) => $q->whereDate('created_at', $v))
            ->when(isset($filters['role_id']), function ($q) use ($filters) {
                if($filters['role_id']){
                    $q->whereHas('roles', function ($q) use ($filters) {
                       $q->where('id', $filters['role_id']);
                    });
                }
            });

        if($filters['sort'] ?? null){
            $query->orderBy($filters['sort'] ?? null, $filters['order'] ?? 'asc');
        }

        return $query;
    }

    public static function statusesList(string $columnKey = null, string $indexKey = null, array $options = []): array
    {
        $records = [
            [
                'key' => self::STATUS_ACTIVE,
                'name' => trans('lists.users_statuses.' . self::STATUS_ACTIVE . '.name'),
            ],
            [
                'key' => self::STATUS_INACTIVE,
                'name' => trans('lists.users_statuses.' . self::STATUS_INACTIVE . '.name'),
            ],
        ];

        return self::staticListBuild($records, $columnKey, $indexKey, $options);
    }

    public function customMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('main')
            ->singleFile();

        $this->addMediaConversion('table')
            ->format('webp')->quality(93)
            ->fit(Fit::Crop, 360, 257);
    }

    public function getAvatar(): string
    {
        $media = auth()->user()->getFirstMediaUrl('avatar');

        return $media ?: Avatar::create($this->name ?? $this->email)->toBase64();
    }

    public function routeNotificationForSmsru()
    {
        return $this->phone;
    }
}
