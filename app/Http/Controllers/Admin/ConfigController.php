<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Cate;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ConfigController extends Controller
{
    /**
     *基础信息列表
     */
    public function configList(Request $request){
        $per_page = $request->input('per_page',15);
        $dataList = Config::where('status',1)->select('id','cate_id','title','text','body','pic','url','keyword','sort','type','status','created_at')
            ->orderBY('sort','asc')->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'','data'=>$dataList]);
    }

    /**
     * 基础信息详情
     *param id 基础信息主键id
     */
    public function configDetail(Request $request){
        $params = $request->input();
        $dataDetail = Config::where('status',1)->where('id',$params['id'])
            ->select('id','cate_id','title','text','body','pic','url','keyword','sort','type','status','created_at')
            ->first();
        return response()->json(['code'=>1000,'msg'=>'','data'=>$dataDetail]);
    }

    /**
     * 基础分类信息
     */
    public function configCreate(Request $request){
        $params= Validator::make($data = $request->all(),[
            'id'=>'integer',
            'cate_id'=>'integer',
            'title'=>'string',
            'text'=>'string',
            'body'=>'string',
            'pic'=>'string',
            'url'=>'string',
            'keyword'=>'string',
            'sort'=>'integer',
            'type'=>'integer',
            'status'=>'integer'
        ])->validate();

        try{
            Config::create($data);
            return response()->json(['code'=>1000,'msg'=>'添加成功']);
        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * 基础分类信息
     */
    public function configUpdate(Request $request){
        $params= Validator::make($data = $request->all(),[
            'id'=>'integer',
            'cate_id'=>'integer',
            'title'=>'string',
            'text'=>'string',
            'body'=>'string',
            'pic'=>'string',
            'url'=>'string',
            'keyword'=>'string',
            'sort'=>'integer',
            'type'=>'integer',
            'status'=>'integer'
        ])->validate();

        try{
            Config::where('id',$params['id'])->update($data);
            return response()->json(['code'=>200,'msg'=>'修改成功']);
        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * 删除基础分类信息
     */
    public function configDel(Request $request){
        $params = $request->input();
        try{
            Config::whereIn('id',$params['id'])->delete();
            return response()->json(['code'=>1000,'msg'=>'删除成功']);
        }catch (Exception $e){

        }
    }
}
