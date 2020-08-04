<?php

namespace App\Models;

use App\Models\Traits\ActiveUserHelper;
use App\Models\Traits\LastActivedAtHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContracts;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContracts
{
    use MustVerifyEmailTrait;
    use HasRoles;
    use ActiveUserHelper;
    use LastActivedAtHelper;

    use Notifiable {
        notify as protected laravelNotify;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone', 'email', 'password','introduction','avatar',
        'weixin_openid', 'weixin_unionid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 用户和话题一对多的关系
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * 用户的回复
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * 权限判断
     * @param $model
     * @return bool
     */
    public function isAuthOf($model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * 评论更新通知话题作者
     * @param $instance
     */
    public function notify($instance)
    {
        //如果要通知的人是当前用户，就不必通知了
        if($this->id == Auth::id()) {
            return;
        }

        //只有数据库类型通知才需提醒，直接发送Email或者其他的都Pass
        if(method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * 清除未读消息
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * 密码修改器，hash后存入数据库，后台管理使用
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        //如果值的长度等于60，即认为是已经做过加密的情况
        if(strlen($value) != 60) {
            //不等于60，做加密处理
            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        //如果不是`http`子串开头，那就是从后台上传的，需要补全URL
        if(!Str::startsWith($path, 'http')) {
            //拼接完整的URL
            $path = config('app.url')."/uploads/images/avatars/$path";
        }
        $this->attributes['avatar'] = $path;
    }
}
