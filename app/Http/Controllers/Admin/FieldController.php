<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class FieldController extends Controller
{

    /**
     * 查询模版列表
     */
    public function fieldList(Request $request){
        $per_page = $request->input('per_page',15);
        $data = Field::where('display_list',1)
            ->select('id','module_id','name','module_type','title','status','class_name','class_type','sort','display_list','display_form')
            ->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'查询模版','data'=>$data]);
    }

    /**
     * 查询模版详情
     * param module_id
     */
    public function fieldDetail(Request $request){
        $params = $request->input();
        $data = Field::where('display_form',1)->where('module_id',$params['module_id'])
            ->select('id','module_id','name','module_type','title','status','class_name','class_type','sort','display_list','display_form')
            ->get();
        return response()->json(['code'=>1000,'msg'=>'查询模版','data'=>$data]);
    }

    /**
     * 添加指定的模版
     */
    public function fieldCreate(Request $request){
        Validator::make($data[] = $request->all(),[
            'module_id'=>'required|integer',
            'name'=>'required|string',
            'title'=>'required|string',
            'class_name'=>'string',
            'sort'=>'integer',
            'class_type'=>'string',
            'module_type'=>'required|integer',
            'display_list'=>'required|integer',
            'display_form'=>'required|integer',
        ])->validate();

        try{
            foreach ($data as $k=>$v){
                Field::create($v);
            }
            return response()->json(['code'=>1000,'msg'=>'添加模版成功']);
        }catch (Exception $e){
            return response()->json(['code'=>1001,'msg'=>'添加模版失败']);
        }

    }

    /**
     * 修改指定的模版
     */
    public function fieldUpdate(Request $request)
    {
        Validator::make($data[] = $request->all(), [
            'module_id' => 'required|integer',
            'name' => 'required|string',
            'title' => 'required|string',
            'class_name' => 'string',
            'sort' => 'integer',
            'class_type' => 'string',
            'module_type' => 'required|integer',
            'display_list' => 'required|integer',
            'display_form' => 'required|integer',
        ])->validate();
        try {
            foreach($data as $k=>$v){
                Field::where('module_id',$v['module_id'])->delete();
                Field::create($v);
            }
            return response()->json(['code' => 1000, 'msg' => '修改模版成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '修改模版失败']);
        }
    }


    public function fieldDel(Request $request){
        $params = $request->input();
        try {
            Field::where('id',$params['id'])->delete();
            return response()->json(['code' => 1000, 'msg' => '删除成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '删除失败']);
        }
    }
}
