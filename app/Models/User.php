<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Usamamuneerchaudhary\Commentify\Traits\HasUserAvatar;
use App\Notifications\EmailVerificationNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    use HasApiTokens, HasFactory, Notifiable, HasUserAvatar, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Return the primary key of the user (id)
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

    protected $fillable = [
        'username',
        'name',
        'email',
        'phone_number',
        'user_avatar',
        'password',
        'otp',
        'otp_created_at',
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

    public function PasswordResetNotification()
    {
        $otp = rand(1000, 9999);
        //dd($otp);
        $this->notify(new EmailVerificationNotification($otp));
        return $otp;
    }
    
    public function course_purchases() {
        return $this->hasMany( CoursePurchase::class );
    }

    public function cashonpurchases() {
        return $this->hasMany( Purchase::class );
    }

    public static function getPermissionGroups() {
        return DB::table( 'permissions' )->select( 'group_name' )->groupBy( 'group_name' )->get();
    }
    public static function getPermissionByGroupName( $groupName ) {
        return DB::table( 'permissions' )->select( 'name', 'id' )->where( 'group_name', $groupName )->get();
    }
    public static function roleHasPermissions( $role, $permissions ) {
        $hasPermission = true;
        foreach ( $permissions as $permission ) {
            if ( !$role->hasPermissionTo( $permission->name ) ) {
                $hasPermission = false;
            }
            return $hasPermission;
        }

    }

    public function appliedJobPosts()
    {
        return $this->hasManyThrough(JobPost::class, JobApplication::class, 'user_id', 'id', 'id', 'job_post_id');
    }
}
