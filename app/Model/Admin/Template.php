<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Model\Admin;

class Template extends Model
{
    protected $guarded = [];

    public static $searchField = [
        'name' => '名稱'
    ];

    public static $listField = [
        'name' => '名稱',
        'group' => '分組'
    ];
}
