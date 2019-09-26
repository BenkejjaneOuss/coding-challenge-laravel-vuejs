<?php
namespace App\Services;
 
use Auth;
use Illuminate\Support\Facades\Hash;
use \App\User;

class ProfileService
{
    public function createUser(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function changePwd(Object $data)
    {
        $result = false;

        if ($data->email != null) {
            $email = $data->email;
        }else{
            $email = Auth::user()->email;
        }
        $user = User::where('email', $email)
                        ->first();
        $user->password = Hash::make($data->password);
        if($user->save())
        {
            $result = true;
        }      
        return $result;
    }
}
