<?php

namespace App\Providers;

use Encore\Admin\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable ;
use Illuminate\Contracts\Auth\UserProvider;
class EChofaUserProvider implements UserProvider
{
    protected $model;
    public function __construct()
    {
        $this->model = '\App\EchofaUser';
    }

    public function retrieveById($identifier)
    {}

    public function retrieveByToken($identifier, $token)
    {}

    public function updateRememberToken(Authenticatable $user, $token)
    {}

    public function retrieveByCredentials(array $credentials)
    {
        // 用$credentials里面的用户名密码去获取用户信息，然后返回Illuminate\Contracts\Auth\Authenticatable对象
//        $UserInfo = new EchofaUser();
//        $UserInfo = $UserInfo->getEchofaUserInfoByUsercodeAndPassword($credentials);
//        if(!$UserInfo->isEmpty()){
//            return $UserInfo;
//        }else{
//            return false;
//        }
//        dd(2);
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where('usercode', $value);
            }
        }
        return $query->first();

    }

    public function createModel()
    {
        $class = '\\'.ltrim($this->model, '\\');

        return new $class;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // 用$credentials里面的用户名密码校验用户，返回true或false
        $password = $credentials['password'];
        return $password == $user->password;
    }
}
