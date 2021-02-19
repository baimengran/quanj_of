<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function store(Request $request)
    {
        $rule = ['image' => 'required|image'];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json(['code' => 1001, 'msg' => $validator->errors()->first(), 'data' => $validator]);
        }
        $path = $request->input('path', 'images');
        if (!$request->file('image')->isValid()) {
            return response()->json(['code' => 1001, 'msg' => '图片上传失败']);
        }
        $result = $request->image->store($path,'public');
        return response()->json(['code'=>1000,'msg'=>'上传成功','data'=>['path'=>'/uploads/'.$result]]);
    }

}
