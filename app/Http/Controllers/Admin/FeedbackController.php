<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * 反馈列表
     */
    public function feedbackList(Request $request){
        $per_page = $request->input('per_page',15);
        $dataList = Feedback::select('id','username','phone')->orderBy('id','desc')->paginate($per_page);
        return response()->json(['code'=>1000,'msg'=>'','data'=>$dataList]);
    }

}
