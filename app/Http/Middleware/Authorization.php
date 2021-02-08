<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Authorization extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        #检测request中header头是否带了token
        if (is_null($token = $request->header('authorization'))) {
            return response()->json(['code' => -2, 'msg' => 'Authorization not exists']);
        }
        #提取token中用户数据
        try {

            if ($this->auth->parseToken()->authenticate()) {
                //如果redis内有token记录，证明被刷新过，返回redis score次token到前端
                if($redis = Redis::get('Barer:'.$token)){
                    if($redis!=1){
                        Redis::decr('Barer:'.$token);
                    }else{
                        Redis::del('Barer:'.$token);
                    }
                    $token = substr($token,7);
                    return $this->setAuthenticationHeader($next($request), $token);
                }
//                return $this->setAuthenticationHeader($next($request), $token);
                return $next($request);
            }
            return response()->json(['code' => -1, 'msg' => '请登录后重试']);
        } catch (TokenExpiredException $exception) {

            #异常处理 token过有效期,进行刷新
            try {
                $token = $this->auth->refresh();
//                $token = 'Bearer' . $token;
//                $request->headers->set('Authorization', $access_token);
                auth()->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            } catch (JWTException $exception) {
                #refresh 也过期,重新登录
                return response()->json(['code' => -1, 'msg' => '登录状态已过期，请重新登录']);
            }
        }
        //记录token到redis，初始5次
        Redis::setex('Barer:'.'Bearer '.$token,60*60*24*5,11);

        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);

    }
}
