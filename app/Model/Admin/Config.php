<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Model\Admin;

class Config extends Model
{
    public static $searchField = [
        'name' => '名稱',
        'key' => '標誌符',
    ];

    public static $listField = [
        'group' => '分組',
        'name' => '名稱',
        'key' => '標誌符',
        'type' => '類型',
        'value' => '值',
    ];

    const TYPE_NUM = 0;
    const TYPE_STR = 1;
    const TYPE_JSON = 2;

    public static $types = [
        self::TYPE_NUM => '數值',
        self::TYPE_STR => '字符串',
        self::TYPE_JSON => 'JSON',
    ];

    protected $guarded = [];
}
