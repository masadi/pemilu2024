<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use App\Traits\Uuid;
use Carbon\Carbon;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, Uuid;
    public $incrementing = false;
    public $keyType = 'string';
	protected $primaryKey = 'user_id';
    protected $appends = ['login_terakhir'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    public function getProfilePhotoPathAttribute()
	{
        if(!$this->attributes['profile_photo_path']){
            return 'images/profile/no-photo.png';
        }
        return 'storage/'.$this->attributes['profile_photo_path'];
	}
    public function getLoginTerakhirAttribute()
	{
        if($this->attributes['last_login_at']){
            return Carbon::parse($this->attributes['last_login_at'])->translatedFormat('d F Y').' Pukul '.Carbon::parse($this->attributes['last_login_at'])->format('H:i:s');
        } else {
            return '-';
        }
	}
    public function scan()
    {
        return $this->hasMany(Scan::class, 'user_id', 'user_id');
    }
}
