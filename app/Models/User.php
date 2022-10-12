<?php

namespace App\Models;


use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

     const VERIFIED_USER = '1';

     const UNVERIFIED_USER = '0';

     const ADMIN_USER = 'true';
     
     const REGULAR_USER = 'false';

     protected $dates = ['created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];
    public $transformer = UserTransformer::class;
    protected $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',

    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name']= strtolower($name);
    } 

    public function setEmailAttribute($email)
    {
        $this->attributes['email']=strtolower($email);
    } 

    public function getNameAttribute($name)
    {
         return ucfirst($name);
    }

    public function getEmailAttribute($email)
    {
         return ucfirst($email);
    }

    public function is_verified()
    {
       return  $this->verified == User::VERIFIED_USER;
    }

    public function is_admin()
    {
       return $this->admin == User::ADMIN_USER;
    }

    public static function generate_verification_token()
    {
       
        return   Str::random(6);
        
    }

    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}