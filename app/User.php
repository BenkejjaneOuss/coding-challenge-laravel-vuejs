<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items() {
        return $this->hasMany('App\Alert');
    }

    /**
     * Create user.
     *
     * @param array $details
     * @return array
     */
    public function createUser(array $details) : self
    {
        $user = new self($details);
        $user->password = Hash::make($details['password']);
        $user->save();
        return $user;
    }

    /**
     * Change password.
     *
     * @param array $details
     * @return array
     */
    public function changePassword(array $details) : self
    {
        $user = User::where('email', $details['email'])
                        ->first();
        $user->password = Hash::make($details['password']);
        $user->save();
        return $user;
    }

}
