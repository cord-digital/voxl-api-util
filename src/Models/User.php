<?php

namespace Voxl\Util\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'property_id',
        "last_name",
        'staff_role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'property_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return Collection
     */
    public function getPropertiesByIdAttribute() : Collection
    {
        return $this->properties->keyBy('id');
    }

    /**
     * The properties the user is on.
     */
    public function properties()
    {
        return $this->belongsToMany(
            WebProperty::class,
            "web_property_user",
            "user_id",
            "property_id"
        )->withPivot(["role"]);
    }

    // protected $attributes = [
    //     'channel_groupings' => array(
    //         "ordering"=>array(
    //             "fb_ads",
    //             "default"
    //         ),
    //         "groupings" => array(
    //             "default" => array(
    //                 "display" => "Other",
    //                 "key" => "default",
    //                 "type" => "default",
    //                 "definition" => [],
    //                 "subgroupings" => array(
    //                     array(
    //                         "key" => "source",
    //                         "display" => "Source",
    //                         "definition" => "utm_source"
    //                     ),
    //                     array(
    //                         "key" => "medium",
    //                         "display" => "Medium",
    //                         "definition" => "utm_medium"
    //                     ),
    //                     array(
    //                         "key" => "campaign",
    //                         "display" => "Campaign",
    //                         "definition" => "utm_campaign"
    //                     )
    //                 )
    //             ),
    //             "fb_ads" => array(
    //                 "display" => "Facebook Ads",
    //                 "key" => "fb_ads",
    //                 "type" => "integration",
    //                 "definition" => array(
    //                     array(
    //                         "key" => "vxl_channel",
    //                         "value" => "fb_ads"
    //                     )
    //                 ),
    //                 "subgroupings" => array(
    //                     array(
    //                         "key" => "campaign",
    //                         "display" => "Campaign",
    //                         "definition" => "ad.vxl_campaign"
    //                     ),
    //                     array(
    //                         "key" => "set",
    //                         "display" => "Ad Set",
    //                         "definition" => "ad.vxl_set"
    //                     ),
    //                     array(
    //                         "key" => "ad",
    //                         "display" => "Ad",
    //                         "definition" => "vxl_ad"
    //                     )
    //                 )
    //             )
    //         )
    //     )
    // ];
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
}
