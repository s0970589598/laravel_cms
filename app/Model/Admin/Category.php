<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Model\Admin;

class Category extends Model
{
    protected $guarded = [];

    public static $searchField = [
        'name' => '名稱',
    ];

    public static $listField = [
        'parentName' => '上級分類',
        'entityName' => '關聯模型',
        'order' => '排序',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Model\Admin\Category', 'pid');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Admin\Category', 'pid');
    }

    public function entity()
    {
        return $this->belongsTo('App\Model\Admin\Entity', 'model_id');
    }
}
