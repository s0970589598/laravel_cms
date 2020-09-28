<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Model\Admin\User;
use App\Repository\Admin\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $formNames = ['phone', 'status'];

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '會員列表', 'url' => route('admin::user.index')];
    }

    /**
     * 會員管理-會員列表
     *
     */
    public function index()
    {
        $this->breadcrumb[] = ['title' => '會員列表', 'url' => ''];
        return view('admin.user.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 會員管理-會員列表數據接口
     *
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $perPage = (int) $request->get('limit', 50);
        $this->formNames[] = 'created_at';
        $condition = $request->only($this->formNames);

        $data = UserRepository::list($perPage, $condition);

        return $data;
    }

    /**
     * 會員管理-新增會員
     *
     */
    public function create()
    {
        $this->breadcrumb[] = ['title' => '新增會員', 'url' => ''];
        return view('admin.user.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 會員管理-保存會員
     *
     * @param UserRequest $request
     * @return array
     */
    public function save(UserRequest $request)
    {
        try {
            array_push($this->formNames, 'password');
            UserRepository::add($request->only($this->formNames));
            return [
                'code' => 0,
                'msg' => '新增成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '新增失败：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '当前會員已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 會員管理-編輯會員
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $this->breadcrumb[] = ['title' => '編輯會員', 'url' => ''];

        $model = UserRepository::find($id);
        return view('admin.user.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 會員管理-更新會員
     *
     * @param UserRequest $request
     * @param int $id
     * @return array
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->only($this->formNames);
        if (!isset($data['status'])) {
            $data['status'] = User::STATUS_DISABLE;
        }
        try {
            UserRepository::update($id, $data);
            return [
                'code' => 0,
                'msg' => '編輯成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '編輯失败：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '当前會員已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 會員管理-删除會員
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            UserRepository::delete($id);
            return [
                'code' => 0,
                'msg' => '删除成功',
                'redirect' => route('admin::user.index')
            ];
        } catch (\RuntimeException $e) {
            return [
                'code' => 1,
                'msg' => '删除失败：' . $e->getMessage(),
                'redirect' => false
            ];
        }
    }
}
