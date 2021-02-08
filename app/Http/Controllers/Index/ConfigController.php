<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Index\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //

    public function info(Request $request){
        $keyword = $request->input('keyword');
        if(!$keyword){
            return response(['code'=>1001,'msg'=>'参数丢失']);
        }
        try{
            $keyword = explode(',',$keyword);
            $config = Config::whereIn('keyword',$keyword)->where('status',1)
            ->get();
            $data = [];
            foreach($config as $v){
                $data[$v['keyword']][]=$v;
            }


            return response(['code'=>1000,'msg'=>'success','data'=>$data]);
        }catch (\Exception $e){
            return jsonErr($e);
        }
    }
}
