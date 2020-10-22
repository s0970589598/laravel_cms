@extends('admin.base')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0/css/basic/emojify.css" />
@endsection
@section('content')
    @include('admin.breadcrumb')

    <div class="layui-card">
        <div class="layui-form layui-card-header light-search">
            <form>
                <input type="hidden" name="action" value="search">
            @include('admin.searchField', ['data' => App\Model\Admin\Comment::$searchField])
            <div class="layui-inline">
                <label class="layui-form-label">創建日期</label>
                <div class="layui-input-inline">
                    <input type="text" name="created_at" class="layui-input" id="created_at" value="{{ request()->get('created_at') }}">
                </div>
            </div>
            <div class="layui-inline">
                <button class="layui-btn layuiadmin-btn-list" lay-filter="form-search" id="submitBtn">
                    <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                </button>
            </div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0/js/emojify.min.js"></script>
        <script type="text/javascript">
            emojify.setConfig({
                img_dir : '/public/image/emoji',
                ignored_tags : {
                    'SCRIPT'  : 1,
                    'TEXTAREA': 1,
                    'A'       : 1,
                    'PRE'     : 1,
                    'CODE'    : 1
                }
            });
        </script>
        <div class="layui-card-body">
            <table class="layui-table" lay-data="{url:'{{ route('admin::comment.list') }}?{{ request()->getQueryString() }}', page:true, limit:50, parseData:function(res) { $.each(res.data, function(i, t) { res.data[i].content = emojify.replace(t.content) }) }}" id="table-comment">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true}">ID</th>
                    @include('admin.listHead', ['data' => App\Model\Admin\Comment::$listField])
                    <th lay-data="{templet:'#vist'}">訪問</th>
                    <th lay-data="{field:'created_at'}">添加時間</th>
                    <th lay-data="{field:'updated_at'}">更新時間</th>
                    <th lay-data="{width:200, templet:'#action'}">操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
<script type="text/html" id="action">
    <!--<a href="<% d.editUrl %>" class="layui-table-link" title="編輯"><i class="layui-icon layui-icon-edit"></i></a>-->
    <a href="javascript:;" class="layui-table-link" title="刪除" style="margin-left: 10px" onclick="deleteMenu('<% d.deleteUrl %>')"><i class="layui-icon layui-icon-delete"></i></a>
</script>
<script type="text/html" id="vist">
    <a target="_blank" href="<% d.contentEditUrl %>" class="layui-table-link" title="後台編輯">後台</a>
    <a target="_blank" href="<% d.vistUrl %>" class="layui-table-link" title="前台訪問">前台</a>
    <a href="<% d.replyUrl %>" class="layui-table-link" title="该評論所有回複">回複</a>
</script>

@section('js')
    <script>
        var laytpl = layui.laytpl;
        laytpl.config({
            open: '<%',
            close: '%>'
        });

        var laydate = layui.laydate;
        laydate.render({
            elem: '#created_at',
            range: '~'
        });

        function deleteMenu (url) {
            layer.confirm('確定刪除？', function(index){
                $.ajax({
                    url: url,
                    data: {'_method': 'DELETE'},
                    success: function (result) {
                        if (result.code !== 0) {
                            layer.msg(result.msg, {shift: 6});
                            return false;
                        }
                        layer.msg(result.msg, {icon: 1}, function () {
                            if (result.reload) {
                                location.reload();
                            }
                            if (result.redirect) {
                                location.href = '{!! url()->previous() !!}';
                            }
                        });
                    }
                });

                layer.close(index);
            });
        }
    </script>
@endsection
