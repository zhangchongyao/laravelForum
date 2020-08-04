<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);

        if(!$verifyData) {
            abort(403, '验证码已失效');
        }

        if(!hash_equals($verifyData['code'], $request->verification_code)) {
            //返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

        //清除验证码缓存
        Cache::forget($request->verification_key);

        return (new UserResource($user))->showSensitiveFields();
    }

    /**
     * 获取某个用户信息
     * @param User $user
     * @param Request $request
     * @return UserResource
     */
    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    /**
     * 获取当前登录用户的信息
     * @param Request $request
     * @return UserResource
     */
    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    public function update(UserRequest $request)
    {
        $user = $request->user();
        $attributs = $request->only(['name', 'email', 'introduction']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);
            $attributs['avatar'] = $image->path;
        }

        $user->update($attributs);
        return (new UserResource($user))->showSensitiveFields();
    }
}
