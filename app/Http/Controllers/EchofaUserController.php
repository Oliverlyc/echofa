<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use App\EchofaUser;
class EchofaUserController extends Controller
{
    public function getUserInfo(EchofaUser $users)
    {
        return $users->getAllUserInfo();
    }
    public function showUserInfoTable()
    {
        $data = $this->getUserInfo(new EchofaUser());
        $table  = \Lava::DataTable();

        $table->addStringColumn('账号')
            ->addStringColumn('密码')
            ->addStringColumn('用户名');
        foreach ($data as $item){
            $table->addRow([$item['usercode'],$item['password'],$item['usercname']]);
        }
        \Lava::TableChart('Table', $table,[
            'height' => count($data)*70,
            'width' => '100%',
            'showRowNumber' => 'true',
        ]);
        return view('echofa.userTable');
    }
}
