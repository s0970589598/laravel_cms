<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Model\Admin;

class Tag extends Model
{
    protected $guarded = [];

    public static $searchField = [
        'name' => '名稱'
    ];

    public static $listField = [
        'name' => '名稱'
    ];
}
