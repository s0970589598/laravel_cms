<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SensitiveWordRequest;
use App\Repository\Admin\SensitiveWordRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Model\Admin\SensitiveWord;
use Illuminate\Support\Facades\Cache;

class SensitiveWordController extends Controller
{
    protected $formNames = ['noun', 'verb', 'exclusive'];

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '敏感詞列表', 'url' => route('admin::SensitiveWord.index')];
    }

    /**
     * 敏感詞管理-敏感詞列表
     *
     */
    public function index()
    {
        $this->breadcrumb[] = ['title' => '敏感詞列表', 'url' => ''];
        $this->setSearchField();
        SensitiveWord::$listField = [
            'verb' => '動詞',
            'noun' => '名詞',
            'exclusive' => '專有詞',
        ];
        return view('admin.SensitiveWord.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 敏感詞列表數據接口
     *
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $perPage = (int) $request->get('limit', 50);
        $condition = $request->only($this->formNames);
        $this->setSearchField();
        $data = SensitiveWordRepository::list($perPage, $condition);

        return $data;
    }

    private function setSearchField()
    {
        SensitiveWord::$searchField = [
            'verb' => '動詞',
            'noun' => '名詞',
            'exclusive' => '專有詞',
        ];
    }

    private function flushCache()
    {
        Cache::forget('sensitive_words_tire');
        Cache::forget('sensitive_words_tire_single');
        Cache::forget('sensitive_verb_words');
    }

    private function checkData($request, $id = 0)
    {
        $data = array_filter($request->only($this->formNames));
        if (count($data) > 1) {
            return [
            'code' => 4,
                'msg' => '專有詞、動詞、名詞不可同時填寫，任選一個填寫即可',
                'redirect' => false
            ];
        }
        $model = null;
        if ($id > 0) {
            $model = SensitiveWordRepository::find($id);
        }
        foreach ($data as $k => $v) {
            $m = SensitiveWordRepository::exist([$k => $v, 'type' => $model ? $model->type : '']);
            if ($m && ($m->id != $id)) {
                return [
                'code' => 4,
                    'msg' => '當前詞已存在',
                    'redirect' => false
                ];
            }
        }
    }

    /**
     * 敏感詞管理-新增敏感詞
     *
     */
    public function create()
    {
        $this->breadcrumb[] = ['title' => '新增敏感詞', 'url' => ''];
        return view('admin.SensitiveWord.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 敏感詞管理-保存敏感詞
     *
     * @param SensitiveWordRequest $request
     * @return array
     */
    public function save(SensitiveWordRequest $request)
    {
        try {
            $result = $this->checkData($request);
            if (is_array($result)) {
                return $result;
            }

            SensitiveWordRepository::add($request->only($this->formNames));
            $this->flushCache();
            return [
                'code' => 0,
                'msg' => '新增成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '新增失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前敏感詞已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 敏感詞管理-編輯敏感詞
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $this->breadcrumb[] = ['title' => '編輯敏感詞', 'url' => ''];

        $model = SensitiveWordRepository::find($id);
        return view('admin.SensitiveWord.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 敏感詞管理-更新敏感詞
     *
     * @param SensitiveWordRequest $request
     * @param int $id
     * @return array
     */
    public function update(SensitiveWordRequest $request, $id)
    {
        $result = $this->checkData($request, $id);
        if (is_array($result)) {
            return $result;
        }
        $data = $request->only($this->formNames);
        try {
            SensitiveWordRepository::update($id, $data);
            $this->flushCache();
            return [
                'code' => 0,
                'msg' => '編輯成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '編輯失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前敏感詞已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 敏感詞管理-刪除敏感詞
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            SensitiveWordRepository::delete($id);
            $this->flushCache();
            return [
                'code' => 0,
                'msg' => '刪除成功',
                'redirect' => route('admin::SensitiveWord.index')
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
