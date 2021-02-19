<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Template;
use App\Models\Field;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * 首页导航栏列表查询
     */
    public function categoryList(){
        $dataList = Category::where('status',1)->select('id','title','pid','level','path','ad','icon','sort','status','class_type','is_nav_display','is_add_body','num','pic','text','is_list','created_at')->get();
        return response()->json(['code'=>1000,'msg'=>'首页导航栏列表','data'=>$dataList]);
    }

    /**
     * 添加导航
     */
    public function categoryCreate(Request $request){
        Validator::make($data = $request->all(),[
            'title'=>'required|string',
            'pid'=>'required|integer',
            'level'=>'required|integer',
            'num'=>'integer',
            'explain'=>'string',
            'icon'=>'string',
            'pic'=>'string',
            'text'=>'string'
        ])->validate();
        try{
            Category::create($data);
            return response()->json(['code'=>1000,'msg'=>'添加导航成功']);
        }catch (Exception $e){
            return response()->json(['code'=>1001,'msg'=>'添加或修改导航失败']);
        }
    }

    /**
     * 导航详情
     *params id 导航id
     */
    public function categoryDetail(Request $request){
        $params = $request->input();
        $data = Category::where('id',$params['id'])->select('id','title','pid','level','path','ad','icon','sort','status','class_type','is_nav_display','is_add_body','num','pic','text','is_list','created_at')->first();
        return response()->json(['code'=>1000,'msg'=>'首页导航栏详情','data'=>$data]);
    }

    /**
     * 修改导航
     */
    public function categoryUpdate(Request $request){
        Validator::make($data = $request->all(),[
            'id'=>'integer',
            'title'=>'required|string',
            'pid'=>'required|integer',
            'level'=>'required|integer',
            'num'=>'integer',
            'explain'=>'string',
            'icon'=>'string',
            'pic'=>'string',
            'text'=>'string'
        ])->validate();
        try{
            Category::where('id',$data['id'])->update($data);
            return response()->json(['code'=>1000,'msg'=>'修改导航成功']);
        }catch (Exception $e){
            return response()->json(['code'=>1001,'msg'=>'添加或修改导航失败']);
        }
    }

    public function categoryDel(Request $request){
        $params = $request->input();
        Category::where('id',$params['id'])->delete();
    }

}
