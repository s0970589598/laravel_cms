<?php
/**
 * Date: 2019/2/25 Time: 10:34
 *
 * @author  Eddy <cumtsjh@163.com>
 * @version v1.0.0
 */

namespace App\Model\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{
    use HasRoles;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];

    protected $guard_name = 'admin';

    public static $searchField = [
        'name' => '用户名',
        'status' => [
            'showType' => 'select',
            'searchType' => '=',
            'title' => '狀態',
            'enums' => [
                0 => '禁用',
                1 => '启用',
            ],
        ],
        'created_at' => [
            'showType' => 'datetime',
            'title' => '創建時間'
        ]
    ];

    public static $listField = [
        'name' => '用户名',
        'statusText' => '狀態',
        'roleNames' => '角色',
    ];

    public function comments()
    {
        return $this->hasMany('App\Model\Admin\Comment', 'user_id');
    }
}
