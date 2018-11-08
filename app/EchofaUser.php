<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EchofaUser extends Authenticatable
{
    use Notifiable;

    protected $table = 't_sy_userinfo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id','usercode', 'password', 'usercname', 'deptcode', 'jobtype', 'email', 'createdate','state'
    ];

    public function getRememberTokenName()
    {
        return 'token';//自定义token字段
    }

    public function getEchofaUserIdByUsercodeAndPassword($arr)
    {
        $id = $this->select('id')->where(['usercode' => $arr['usercode'], 'password' => $arr['password']])->first();
        if ($id === null){
            return false;
        }else{
            return $id->id;
        }
    }

    public function getAllUserInfo()
    {
        return $this->select('usercode','password','usercname')->get();
    }



}
