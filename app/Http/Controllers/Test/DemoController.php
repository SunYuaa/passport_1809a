<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Str;

class DemoController extends Controller
{
    //注册
    public function reg()
    {
    	$res = file_get_contents('php://input');
    	$data = json_decode($res);

    	$e = UserModel::where(['email'=>$data->email])->first();
        if($e){
            $response = [
                'errcode' => 2001,
                'errmsg' => '该邮箱已存在'
            ];
        }else{
        	$info = [
        		'user_name' => $data->user_name,
        		'password' => $data->password,
        		'email' => $data->email
        	];
            $id = UserModel::insertGetId($info);
            if($id){
                $response = [
                    'errcode' => 0,
                    'errmsg' => 'success'
                ];
            }else{
                $response = [
                    'errcode' => 1001,
                    'errmsg' => 'fail'
                ];
            }
        }
        return json_encode($response);
    }
    //登录
    public function login()
    {
    	$res = file_get_contents('php://input');
    	$data = json_decode($res);

    	$res = UserModel::where(['user_name'=>$data->user_name,'password'=>$data->password])->first();
        if($res){
            $token = Str::random(6);
            $response = [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => [
                    'token' => $token,
                    'uid' => $res->id
                ]
            ];
        }else{
            $response = [
                'errcode' => 2002,
                'errmsg' => 'fail'
            ];
        }
        return json_encode($response);
    }
    //个人中心
    public function center()
    {
    	$res = file_get_contents('php://input');
    	$data = json_decode($res);

        $userInfo = UserModel::where(['id'=>$data->uid])->first()->toArray();
        if($userInfo){
            $response = [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => [
                    'userInfo' => $userInfo
                ]
            ];
        }else{
            $response = [
                'errcode' => 1002,
                'errmsg' => '用户不存在'
            ];
        }
        return json_encode($response);
    }
}
