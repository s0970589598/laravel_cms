<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Repository\Admin;

use App\Model\Admin\Content;
use App\Model\Admin\ContentTag;
use App\Model\Admin\Entity;
use App\Model\Admin\EntityField;
use App\Repository\Searchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * 使用當前類時必须先调用 setTable 方法設置所要操作的資料庫表
 * @package App\Repository\Admin
 */
class ContentRepository
{
    use Searchable;

    /**
     * @var \App\Model\Admin\Model
     */
    protected static $model = null;

    public static function list($entity, $perPage, $condition = [], $user_id)
    {
        $sortField = 'id';
        $sortType = 'asc';
        if (isset($condition['light_sort_fields'])) {
            $tmp = explode(',', $condition['light_sort_fields']);
            $sortField = isset($tmp[0]) && ($tmp[0] != '') ? $tmp[0] : $sortField;
            $sortType = isset($tmp[1]) && in_array($tmp[1], ['asc', 'desc'], true) ? $tmp[1] : $sortType;
            unset($condition['light_sort_fields']);
        }

        if ($user_id <> 1) {
            
            switch ($entity) {
                case 7:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select('app_beacon.*' , 'app_official_location.name')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 9:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select('app_official_location_broadcast.*' ,'app_official_location.name')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 10:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location_broadcast', 'app_official_location_broadcast.id', '=', 'app_official_location_broadcast_message.broadcast_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select('app_official_location_broadcast_message.*', 'app_official_location.name', 'app_official_location_broadcast.title')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 11:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_beacon', 'app_beacon.id', '=', 'log_beacon_event.beacon_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select('log_beacon_event.*')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 12:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location_broadcast', 'app_official_location_broadcast.id', '=', 'log_broadcast.broadcast_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_beacon.location_id', '=', 'app_official_location.id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select('log_broadcast.*', 'app_official_location_broadcast.title')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 'log_beacon_event':
                    /**SELECT app_beacon.id,count(log_beacon_event.beacon_id) FROM `app_beacon`
                    left join log_beacon_event on log_beacon_event.beacon_id = app_beacon.id
                    left join app_official_location on app_official_location.id = app_beacon.location_id
                    where app_official_location.admin_id = 8 or app_official_location.editor_id = 8
                    group by app_beacon.id**/
                    $data = DB::table('app_beacon')   
                    ->leftjoin('log_beacon_event', function ($leftjoin) {
                        $leftjoin->on('app_beacon.id', '=', 'log_beacon_event.beacon_id')
                        ->whereRaw('DATE(log_beacon_event.enter_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
                    })
                    ->leftjoin('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select(DB::raw('count(*) as beacon_id, app_beacon.id, app_official_location.name as line_user_id'))
                    ->orderBy($sortField, $sortType)
                    ->groupBy('app_beacon.id')
                    ->paginate($perPage);
                    log::info($data);
                    break;
                case 'log_broadcast':
                    /*
                    SELECT app_beacon.id,count(log_broadcast.broadcast_id),app_beacon.location_id,app_official_location.name FROM `app_beacon`
                    left join app_official_location_broadcast on app_official_location_broadcast.location_id = app_beacon.location_id
                    left join log_broadcast on log_broadcast.broadcast_id = app_official_location_broadcast.id
                    left join app_official_location on app_official_location.id = app_beacon.location_id
                    where app_official_location.admin_id = 8 or app_official_location.editor_id = 8
                    group by app_beacon.id
                    */
                    $data = DB::table('app_beacon')   
                    ->leftjoin('app_official_location_broadcast', 'app_official_location_broadcast.location_id', '=', 'app_beacon.location_id')
                    ->leftjoin('log_broadcast', function ($leftjoin) {
                        $leftjoin->on('app_official_location_broadcast.id', '=', 'log_broadcast.broadcast_id')
                        ->whereRaw('DATE(log_broadcast.broadcast_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
                    })
                    ->leftjoin('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->where('admin_id', $user_id)
                    ->orwhere('editor_id', $user_id)
                    ->select(DB::raw('count(app_official_location_broadcast.id) as broadcast_datetime, app_beacon.id, app_official_location.name as name'))
                    ->orderBy($sortField, $sortType)
                    ->groupBy('app_beacon.id')
                    ->paginate($perPage);
                    log::info($data);
                    break;
                    
                default:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
            }

        } else {
            switch ($entity) {
                case 7:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select('app_beacon.*' , 'app_official_location.name')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 9:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select('app_official_location_broadcast.*' ,'app_official_location.name')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 10:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location_broadcast', 'app_official_location_broadcast.id', '=', 'app_official_location_broadcast_message.broadcast_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select('app_official_location_broadcast_message.*', 'app_official_location.name', 'app_official_location_broadcast.title')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 11:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_beacon', 'app_beacon.id', '=', 'log_beacon_event.beacon_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select('log_beacon_event.*')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 12:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->join('app_official_location_broadcast', 'app_official_location_broadcast.id', '=', 'log_broadcast.broadcast_id')
                    ->join('app_official_location', 'app_official_location.id', '=', 'app_official_location_broadcast.location_id')
                    ->join('app_beacon', 'app_beacon.location_id', '=', 'app_official_location.id')
                    ->select('log_broadcast.*', 'app_official_location_broadcast.title')
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
                    break;
                case 'log_beacon_event':
                    $data = DB::table('app_beacon')   
                    ->leftjoin('log_beacon_event', function ($leftjoin) {
                        $leftjoin->on('app_beacon.id', '=', 'log_beacon_event.beacon_id')
                        ->whereRaw('DATE(log_beacon_event.enter_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
                    })
                    ->leftjoin('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select(DB::raw('count(log_beacon_event.beacon_id) as beacon_id, app_beacon.id, app_official_location.name as line_user_id'))
                    ->orderBy($sortField, $sortType)
                    ->groupBy('app_beacon.id')
                    ->paginate($perPage);
                    log::info($data);
                break;
                case 'log_broadcast':
                    $data = DB::table('app_beacon')   
                    ->leftjoin('app_official_location_broadcast', 'app_official_location_broadcast.location_id', '=', 'app_beacon.location_id')
                    ->leftjoin('log_broadcast', function ($leftjoin) {
                        $leftjoin->on('app_official_location_broadcast.id', '=', 'log_broadcast.broadcast_id')
                        ->whereRaw('DATE(log_broadcast.broadcast_datetime) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
                    })
                    ->leftjoin('app_official_location', 'app_official_location.id', '=', 'app_beacon.location_id')
                    ->select(DB::raw('count(app_official_location_broadcast.id) as broadcast_datetime, app_beacon.id, app_official_location.name as name'))
                    ->orderBy($sortField, $sortType)
                    ->groupBy('app_beacon.id')
                    ->paginate($perPage);
                    log::info($data);
                break;
                default:
                    $data = self::$model->newQuery()
                    ->where(function ($query) use ($condition) {
                        Searchable::buildQuery($query, $condition);
                    })
                    ->orderBy($sortField, $sortType)
                    ->paginate($perPage);
    
            }
        }

        if ($entity <> 'log_beacon_event' and $entity <> 'log_broadcast') {
            if ($entity == 9) {
                $data->transform(function ($item) use ($entity) {
                    log::info($item);
                    xssFilter($item);
                    $item->addUrl =  '/admin/entity/10/contents/create/' . $item->id . '/text';
                    $item->addImgUrl = '/admin/entity/10/contents/create/' . $item->id . '/image';
                    $item->editUrl = route('admin::content.edit', ['id' => $item->id, 'entity' => $entity]);
                    $item->deleteUrl = route('admin::content.delete', ['id' => $item->id, 'entity' => $entity]);
                    $item->commentListUrl = route('admin::comment.index', ['content_id' => $item->id, 'entity_id' => $entity]);
                    return $item;
                });
            } else {
                $data->transform(function ($item) use ($entity) {
                    xssFilter($item);
                    $item->editUrl = route('admin::content.edit', ['id' => $item->id, 'entity' => $entity]);
                    $item->deleteUrl = route('admin::content.delete', ['id' => $item->id, 'entity' => $entity]);
                    $item->commentListUrl = route('admin::comment.index', ['content_id' => $item->id, 'entity_id' => $entity]);
                    return $item;
                });
            }
    
        }

        return [
            'code' => 0,
            'msg' => '',
            'count' => $data->total(),
            'data' => $data->items(),
        ];
    }

    public static function add($data, Entity $entity)
    {
        self::$model->setRawAttributes(self::processParams($data, $entity))->save();
        return self::$model;
    }

    public static function update($id, $data, Entity $entity)
    {
        return self::$model->newQuery()->where('id', $id)->update(self::processParams($data, $entity));
    }

    public static function find($id)
    {
        return self::$model->newQuery()->find($id);
    }

    public static function findOrFail($id)
    {
        return self::$model->newQuery()->findOrFail($id);
    }

    public static function delete($id)
    {
        return self::$model->newQuery()->where('id', $id)->delete();
    }

    public static function setTable($table)
    {
        self::$model = new Content();
        return self::$model->setTable($table);
    }

    public static function model()
    {
        return self::$model;
    }

    protected static function processParams($data, Entity $entity)
    {
        return collect($data)->map(function ($item, $key) use ($entity) {
            if (is_array($item)) {
                return implode(',', $item);
            } elseif ($item === '' || preg_match('/^\d+(,\d+)*/', $item)) {
                // select多選類型表單，數據類型為 unsignedInteger 的求和保存，查尋時可以利用 AND 運算查找對應值
                $fieldType = EntityField::where('entity_id', $entity->id)
                    ->where('form_type', 'selectMulti')
                    ->where('name', $key)->value('type');
                if ($fieldType == 'unsignedInteger') {
                    return array_sum(explode(',', $item));
                }
                return $item;
            } else {
                return $item;
            }
        })->toArray();
    }

    public static function adjacent($id)
    {
        return [
            'previous' => self::$model->newQuery()->where('id', '<', $id)->first(),
            'next' => self::$model->newQuery()->where('id', '>', $id)->first()
        ];
    }

    public static function paginate($perPage = 10)
    {
        return self::$model->newQuery()
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public static function tags($entityId, $contentId)
    {
        return ContentTag::query()->where('entity_id', $entityId)->where('content_id', $contentId)
            ->leftJoin('tags', 'tags.id', '=', 'content_tags.tag_id')
            ->get(['name', 'tag_id']);
    }

    public static function tagNames($entityId, $contentId)
    {
        return self::tags($entityId, $contentId)->implode('name', ',');
    }
}
