<?php
/**
 * Date: 2019/2/25 Time: 14:35
 *
 * @author  Eddy <cumtsjh@163.com>
 * @version v1.0.0
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\EntityRepository;
use App\Repository\Admin\ContentRepository;
use Auth;

class HomeController extends Controller
{
    /**
     * 基礎功能-首頁
     */
    public function showIndex()
    {
        $opcache = 'false';
        if (function_exists('opcache_get_status') && opcache_get_status() !== false) {
            $opcache = 'true';
        }

        $user = \Auth::guard('admin')->user();

        if ($user->id <> '1' and $user->id <> '8') {
            return redirect('admin/entity/9/contents');

        } else {
             $log_beacon_event = ContentRepository::list('log_beacon_event', 50, [], $user->id);
            $log_broadcast = ContentRepository::list('log_broadcast', 50, [], $user->id);
            $app_official_location_broadcast = ContentRepository::list('app_official_location_broadcast', 50, [], $user->id);

            return view('admin.home.index', 
                            [
                                'log_beacon_event' => $log_beacon_event,
                                'log_broadcast' => $log_broadcast,                            
                                'app_official_location_broadcast' => $app_official_location_broadcast
                            ]
            );
        }
    }

    /**
     * 内容管理-内容管理
     */
    public function showAggregation()
    {
        return view('admin.home.content', ['autoMenu' => EntityRepository::systemMenu()]);
    }
}
