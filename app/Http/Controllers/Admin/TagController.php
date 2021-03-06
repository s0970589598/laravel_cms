<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Repository\Admin\TagRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Model\Admin\ContentTag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    protected $formNames = ['name', 'created_at'];

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '標簽列表', 'url' => route('admin::tag.index')];
    }

    /**
     * 標簽管理-標簽列表
     *
     */
    public function index()
    {
        $this->breadcrumb[] = ['title' => '標簽列表', 'url' => ''];
        return view('admin.tag.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 標簽管理-標簽列表數據接口
     *
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $perPage = (int) $request->get('limit', 50);
        $condition = $request->only($this->formNames);

        $data = TagRepository::list($perPage, $condition);

        return $data;
    }

    /**
     * 標簽管理-新增標簽
     *
     */
    public function create()
    {
        $this->breadcrumb[] = ['title' => '新增標簽', 'url' => ''];
        return view('admin.tag.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 標簽管理-保存標簽
     *
     * @param TagRequest $request
     * @return array
     */
    public function save(TagRequest $request)
    {
        try {
            TagRepository::add($request->only($this->formNames));
            return [
                'code' => 0,
                'msg' => '新增成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '新增失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前標簽已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 標簽管理-編輯標簽
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $this->breadcrumb[] = ['title' => '編輯標簽', 'url' => ''];

        $model = TagRepository::find($id);
        return view('admin.tag.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 標簽管理-更新標簽
     *
     * @param TagRequest $request
     * @param int $id
     * @return array
     */
    public function update(TagRequest $request, $id)
    {
        $data = $request->only($this->formNames);
        try {
            TagRepository::update($id, $data);
            return [
                'code' => 0,
                'msg' => '編輯成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '編輯失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前標簽已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 標簽管理-刪除標簽
     *
     * @param int $id
     * @return array
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            TagRepository::delete($id);
            ContentTag::where('tag_id', $id)->delete();

            DB::commit();
            return [
                'code' => 0,
                'msg' => '刪除成功',
                'redirect' => route('admin::tag.index')
            ];
        } catch (\RuntimeException $e) {
            DB::rollBack();
            return [
                'code' => 1,
                'msg' => '刪除失敗：' . $e->getMessage(),
                'redirect' => false
            ];
        }
    }
}
