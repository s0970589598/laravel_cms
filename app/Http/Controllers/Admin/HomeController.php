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
        $data = ContentRepository::list('log_beacon_event', 50, [], $user->id);
        $data2 = ContentRepository::list('log_broadcast', 50, [], $user->id);

        return view('admin.home.index', 
                        [
                            'data' => $data,
                            'data2' => $data2,                            
                        
                        ]
                    );
    }

    /**
     * 内容管理-内容管理
     */
    public function showAggregation()
    {
        return view('admin.home.content', ['autoMenu' => EntityRepository::systemMenu()]);
    }
}
