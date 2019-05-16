<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('user.index');
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $user = UserModel::where(['email'=>$name])->first();
        if($user){
            //用户存在   验证密码
            if (password_verify($password,$user->password)){
                //获取token redis存储
                $token = $this->getLoginToken($user->id);
                $login_token_key = 'login_token:id:'.$user->id;
                Redis::set($login_token_key,$token);
                Redis::expire($login_token_key,7*24*3600);

                //登录成功
                setcookie('token',Str::random(6),time()+200,'/','may.com',false,true);
                setcookie('user'.$user->id,$token,time()+200,'/','may.com',false,true);

                $response = [
                    'errcode' => 0,
                    'errmsg' => 'SUCCESS'
                ];
            }else{
                //密码不正确
                $response = [
                    'errcode' => 22010,
                    'errmsg' => '密码错误'
                ];
            }
        }else{
            //用户不存在
            $response = [
                'errcode' => 22021,
                'errmsg' => '用户不存在'
            ];
        }
        die(json_encode($response,JSON_UNESCAPED_UNICODE));

    }

    /**
     * 获取loginToken
     * @param $id
     * @return bool|string
     */
    public function getLoginToken($id){
        return substr(sha1($id.time().Str::random(15)),5,20);
    }
}
