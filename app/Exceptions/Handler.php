<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * 重写 invalidJson 方法，实现验证失败是返回自定义状态码等内容
     * @param \Illuminate\Http\Request $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function invalidJson($request, ValidationException $exception)
    {
        if(Str::lower($request->segment(1)) === 'api'){
            if ($exception instanceof ValidationException) {
                return response()->json(
                    [
                        'code' => 1001,
                        'msg' => $exception->validator->errors()->first(),
                        'data' => $exception->errors(),
                    ],200);
            }

        }else{
            return parent::render($request, $exception);
        }
    }
}
