<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TemplateRequest;
use App\Repository\Admin\TemplateRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TemplateController extends Controller
{
    protected $formNames = ['name', 'group', 'content'];

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '模板列表', 'url' => route('admin::template.index')];
    }

    /**
     * 模板管理-模板列表
     *
     */
    public function index()
    {
        $this->breadcrumb[] = ['title' => '模板列表', 'url' => ''];
        return view('admin.template.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 模板管理-模板列表數據接口
     *
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $perPage = (int) $request->get('limit', 50);
        $this->formNames[] = 'created_at';
        $condition = $request->only($this->formNames);

        $data = TemplateRepository::list($perPage, $condition);

        return $data;
    }

    /**
     * 模板管理-新增模板
     *
     */
    public function create()
    {
        $this->breadcrumb[] = ['title' => '新增模板', 'url' => ''];
        return view('admin.template.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 模板管理-保存模板
     *
     * @param TemplateRequest $request
     * @return array
     */
    public function save(TemplateRequest $request)
    {
        try {
            TemplateRepository::add($request->only($this->formNames));
            return [
                'code' => 0,
                'msg' => '新增成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '新增失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前模板已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 模板管理-編輯模板
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $this->breadcrumb[] = ['title' => '編輯模板', 'url' => ''];

        $model = TemplateRepository::find($id);
        return view('admin.template.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 模板管理-更新模板
     *
     * @param TemplateRequest $request
     * @param int $id
     * @return array
     */
    public function update(TemplateRequest $request, $id)
    {
        $data = $request->only($this->formNames);
        try {
            TemplateRepository::update($id, $data);
            return [
                'code' => 0,
                'msg' => '編輯成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '編輯失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前模板已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 模板管理-刪除模板
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            TemplateRepository::delete($id);
            return [
                'code' => 0,
                'msg' => '刪除成功',
                'redirect' => route('admin::template.index')
            ];
        } catch (\RuntimeException $e) {
            return [
                'code' => 1,
                'msg' => '刪除失敗：' . $e->getMessage(),
                'redirect' => false
            ];
        }
    }
}
