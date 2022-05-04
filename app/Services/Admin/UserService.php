<?php
namespace App\Services\Admin;

use Illuminate\Support\Facades\Hash;

class UserService 
{

    public function handle($user, $request)
    {
        $user->full_name = $request->full_name;
        
        $user->email = $request->email;
        
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->place_work = $request->place_work;
        $user->is_email_verified = $request->is_email_verified == 'true';
        $user->role_id = $request->role_id;
        
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        return $user;
    }

    public function save($user, $request)
    {

        $user = $this->handle($user, $request);
        return $user->save();
    }
}