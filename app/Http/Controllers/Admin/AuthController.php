<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    //

    public function __construct(){
        $this->middleware('authJwt')->except('login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->all();
        try {
            if (!$token = auth()->attempt($data)) {
                return response()->json(['code' => 1001, 'msg' => '用户名或密码错误']);
            }
            $user = auth()->user();
            return response()->json([
                'code' => 1000,
                'data' => [
                    'access_token' => $token,
                    'msg' => '登录成功',
                    'token_type' => 'Bearer',
                    'expires_in' => \Auth::guard()->factory()->getTTL() * 60,
                    'is_info' => $user,
                ]
            ]);
        } catch (\Exception $e) {
            return jsonErr($e);
        }
    }

    public function userInfo(Request $request){
        try{
            $user =auth()->user();
            if(!$user){
                return response(['code'=>1001,'msg'=>'请登录后重试']);
            }
            $user['roles']=['admin'];
            return response(['code'=>1000,'msg'=>'success','data'=>$user]);
        }catch (\Exception $e){
            return jsonErr($e);
        }
    }


    public function destroy(){
        try{
            auth()->logout();
            return response()->json(['code' => 1000, 'msg' => "退出成功"]);
        }catch (\Exception $e){
            return jsonErr($e);
        }
    }


}
