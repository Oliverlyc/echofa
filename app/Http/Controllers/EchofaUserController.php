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
        $users = $this->getUserInfo(new EchofaUser());

        return view('echofa.userTable')->with(['users' => $users]);
    }
}
