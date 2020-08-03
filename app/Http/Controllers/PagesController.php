<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class PagesController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function root()
    {
        return view('pages.root');
    }

    public function permissionDenied()
    {
        //如果当前用户有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrtor.uri')), 302);
        }
        //否则使用视图
        return view('pages.permission_denied');
    }

    /**
     * 短信调试
     */
    public function sms()
    {
        $sms = app('easysms');
        try {
            $sms->send(15754307623, [
                'template' => 'SMS_192570772',
                'data' => [
                    'code' => 1234
                ],
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('aliyun')->getMessage();
            dd($message);
        }
    }
}
