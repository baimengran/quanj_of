<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class TemplateController extends Controller
{
    /**
     * 导航下的模块列表查询
     * param category_id
     */
    public function templateList(Request $request){
        $per_page = $request->input('per_page',15);
        $category_id = $request->input('category_id');
        $dataList = Template::select('id','category_id','subhead_d','subhead_f','template_name','template_label','status','pid','level','path','created_at')
            ->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'首页导航栏列表','data'=>$dataList]);
    }

    /**
     * 添加导航下的模块
     */
    public function templateCreate(Request $request){
        Validator::make($data = $request->all(),[
            'category_id'=>'required|integer',
            'pid'=>'required|integer',
            'level'=>'required|integer',
            'path'=>'required|string',
            'subhead_d'=>'required|string',
            'subhead_f'=>'required|string',
            'template_name'=>'required|string',
            'template_label'=>'required|string'
        ])->validate();

        try{
            Template::create($data);
            return response()->json(['code'=>1000,'msg'=>'添加导航下的模块成功']);
        }catch (Exception $e){
            return response()->json(['code'=>1001,'msg'=>'添加或修改导航下的模块失败']);
        }
    }

    /**
     * 导航下的模块详情
     *params id 导航id
     */
    public function templateDetail(Request $request){
        $params = $request->input();
        $data = Template::where('id',$params['id'])->select('id','category_id','subhead_d','subhead_f','template_name','template_label','status','pid','level','path','created_at')->first();
        return response()->json(['code'=>1000,'msg'=>'首页导航栏详情','data'=>$data]);
    }

    /**
     * 修改导航下的模块
     */
    public function templateUpdate(Request $request){
        Validator::make($data = $request->all(),[
            'id'=>'integer',
            'category_id'=>'required|integer',
            'pid'=>'required|integer',
            'level'=>'required|integer',
            'path'=>'required|string',
            'subhead_d'=>'required|string',
            'subhead_f'=>'required|string',
            'template_name'=>'required|string',
            'template_label'=>'required|string'
        ])->validate();

        try{
            Template::where('id',$data['id'])->update($data);
            return response()->json(['code'=>1000,'msg'=>'修改导航下的模块成功']);
        }catch (Exception $e){
            return response()->json(['code'=>1001,'msg'=>'添加或修改导航下的模块失败']);
        }
    }

    public function templateDel(Request $request){
        $params = $request->input();
        try {
            Template::where('id',$params['id'])->delete();
            return response()->json(['code' => 1000, 'msg' => '删除成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '删除失败']);
        }
    }
}
