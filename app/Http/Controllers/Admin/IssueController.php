<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Models\Field;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    /**
     * 查询定义模版的数据列表
     * param category_id 栏目id
     * param template_id 模块id
     */
    public function issueList(Request $request){
        $params = $request->input();
        $per_page = $request->input('per_page',15);
        $fieldData = Field::where('module_id', $params['template_id'])->pluck('name')->toArray();
        $data = Issue::where('category_id',$params['category_id'])->where('template_id',$params['template_id'])->select($fieldData)->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'定义模版的数据列表','data'=>$data]);
    }

    /**
     * 查询定义模版的数据详情
     * param id 定义模版的数据id
     */
    public function issueDetail(Request $request){
        $id = $request->input('id');
        $issue = Issue::where('id',$id)->select('id','template_id')->first();
        $fieldData = Field::where('module_id', $issue->template_id)->pluck('name')->toArray();
        $data = Issue::where('id',$id)->select($fieldData)->first();
        return response()->json(['code'=>1000,'msg'=>'定义模版的数据详情','data'=>$data]);
    }

    /**
     * 添加定义模版的数据
     */
    public function issueCreate(Request $request){
        $template_id = $request->input('template_id');
        $category_id = $request->input('category_id');
        $fieldData = Field::where('module_id',$template_id)->pluck('name')->toArray();
        $params = [];
        foreach($fieldData as $key=>$value){
            $params[$value] = $value;
        }
        unset($params['id']);
        unset($params['created_at']);
        unset($params['updated_at']);
        foreach ($params as $k=>$v){
            $data[$v] = $v;
        }
        $data = $request->all();
        try {
            Issue::create($data);
            return response()->json(['code' => 1000, 'msg' => '添加模版成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '添加模版失败']);
        }
    }


    /**
     * 修改定义模版的数据
     * param id 定义模版id
     */
    public function issueUpdate(Request $request){
        $id = $request->input('id');
        $issue = Issue::where('id',$id)->select('id','template_id')->first();
        $fieldData = Field::where('module_id',$issue->template_id)->pluck('name')->toArray();
        foreach($fieldData as $key=>$value){
            $params[$value] = $value;
        }
        unset($params['id']);
        unset($params['created_at']);
        unset($params['updated_at']);
        foreach ($params as $k=>$v){
            $data[$v] = $v;
        }
        $data = $request->all();

        try {
            Issue::where('id',$id)->update($data);
            return response()->json(['code' => 1000, 'msg' => '修改模版成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '修改模版失败']);
        }
    }

    /**
     * 返回模块表内容的字段和详情
     */
    public function issue(){
        $sql = 'SELECT `COLUMN_NAME` AS `name`, `DATA_TYPE` AS `type`, `COLUMN_COMMENT` AS `comment` FROM `information_schema`.`COLUMNS` WHERE `table_name` = \'quanj_of_issue\' AND `table_schema` = \'jibu\'';
        $base_table_field = DB::select($sql);
        return response()->json(['code'=>1000,'msg'=>'模块表内容的字段和详情','data'=>$base_table_field]);
    }

    public function issueDel(Request $request){
        $params = $request->input();
        try {
            Issue::where('id',$params['id'])->delete();
            return response()->json(['code' => 1000, 'msg' => '删除成功']);
        } catch (Exception $e) {
            return response()->json(['code' => 1001, 'msg' => '删除失败']);
        }
    }

}
