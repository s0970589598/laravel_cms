<?php
/**
 * @author  Eddy <cumtsjh@163.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentRequest;
use App\Repository\Admin\CommentRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    protected $formNames = ['content', 'content_id', 'entity_id', 'user_id', 'rid'];

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '評論列表', 'url' => route('admin::comment.index')];
    }

    /**
     * 評論管理-評論列表
     *
     */
    public function index()
    {
        $this->breadcrumb[] = ['title' => '評論列表', 'url' => ''];
        return view('admin.comment.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 評論管理-評論列表數據接口
     *
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $perPage = (int) $request->get('limit', 50);
        $condition = $request->only($this->formNames);

        $data = CommentRepository::list($perPage, $condition);

        return $data;
    }

    /**
     * 評論管理-編輯評論
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $this->breadcrumb[] = ['title' => '編輯評論', 'url' => ''];

        $model = CommentRepository::find($id);
        return view('admin.comment.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 評論管理-更新評論
     *
     * @param CommentRequest $request
     * @param int $id
     * @return array
     */
    public function update(CommentRequest $request, $id)
    {
        $data = $request->only($this->formNames);
        try {
            CommentRepository::update($id, $data);
            return [
                'code' => 0,
                'msg' => '編輯成功',
                'redirect' => true
            ];
        } catch (QueryException $e) {
            return [
                'code' => 1,
                'msg' => '編輯失敗：' . (Str::contains($e->getMessage(), 'Duplicate entry') ? '當前評論已存在' : '其它錯誤'),
                'redirect' => false
            ];
        }
    }

    /**
     * 評論管理-刪除評論
     *
     * @param int $id
     * @return array
     */
    public function delete($id)
    {
        try {
            $id = intval($id);

            $comment = CommentRepository::find($id);
            if (!$comment) {
                throw new \RuntimeException("評論不存在");
            }

            if (CommentRepository::hasChildren($id)) {
                return [
                    'code' => 2,
                    'msg' => '刪除失敗：只允许刪除無回覆的評論',
                ];
            }

            DB::transaction(function () use ($id, $comment) {
                CommentRepository::delete($id);
                // 回覆數-1
                CommentRepository::decrementReplyCount($comment->rid);
                // 清除缓存
                Cache::forget('comment_replay:' . $comment->rid);
            });

            return [
                'code' => 0,
                'msg' => '刪除成功',
                'redirect' => route('admin::comment.index')
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
