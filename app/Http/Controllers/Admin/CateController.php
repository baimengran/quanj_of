<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Cate;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class CateController extends Controller
{
    /**
     *基础信息分类列表
     */
    public function cateList(Request $request){
        $per_page = $request->input('per_page',15);
        $dataList = Cate::where('status',1)->select('id','title','sort','status','type','num','explain','created_at')
            ->orderBY('sort','asc')->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'','data'=>$dataList]);
    }

    /**
     * 基础信息分类详情
     * param id 基础信息主键id
     */
    public function cateDetail(Request $request){
        $params = $request->input();
        $dataDetail = Cate::where('status',1)->where('id',$params['id'])->select('id','title','sort','status','type','num','explain','created_at')
          ->first();
        return response()->json(['code'=>1000,'msg'=>'','data'=>$dataDetail]);
    }

    /**
     * 基础分类添加
     */
    public function cateCreate(Request $request){
        Validator::make($data = $request->all(),[
            'keyword'=>'required|string',
            'title'=>'required|string',
            'sort'=>'required|integer',
            'num'=>'required|integer',
            'type'=>'integer',
            'explain'=>'string',
        ])->validate();

        try{
           $cate = Cate::create($data);
           return response()->json(['code'=>1000,'msg'=>'添加成功']);
        }catch (\Exception $e){
            return $e;
        }
    }

    /**
     * 基础分类修改
     */
    public function cateUpdate(Request $request){
        Validator::make($data = $request->all(),[
            'id'=>'integer',
            'keyword'=>'required|string',
            'title'=>'required|string',
            'sort'=>'required|integer',
            'num'=>'required|integer',
            'type'=>'integer',
            'explain'=>'string',
        ])->validate();

        try{
            $dataDetail = Cate::where('status',1)->where('id',$data['id'])->select('id','title','sort','status','type','num','explain')
                ->orderBY('sort','asc')->first();
            if($data['num'] > $dataDetail->num){
                return response()->json(['code'=>1001,'msg'=>'当前分类超过最大数量']);
            }
            Cate::where('id',$data['id'])->update($data);
            return response()->json(['code'=>200,'msg'=>'修改成功']);

        }catch (\Exception $e){
            return $e;
        }
    }


    /**
     * 删除分类
     */
    public function cateDel(Request $request){
        $params = $request->input();
        try{
            Cate::where('id',$params['id'])->delete();
            return response()->json(['code'=>1000,'msg'=>'删除成功']);
        }catch (Exception $e){

        }
    }
}
