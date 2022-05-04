<?php


namespace App\Services\V1;


class AuthCreateTokenService
{
    public function create($user, $provider)
    {
//        $roles = $user->roles->pluck('name')->toArray();
//        $scope = in_array('admin', $roles) ? 'admin' : (in_array('manager', $roles) ? 'manager' : '');
        $token = $user->createToken($provider, [
//            $scope
        ])->toArray();
//        $isAdmin = !empty($scope);
//        return compact('token', 'user', 'isAdmin');
        return compact('token', 'user');
    }

}   