@extends('admin.base')

@section('content')
    @include('admin.breadcrumb')

    <div class="layui-card">
        <div class="layui-card-body">
            <table class="layui-table" lay-data="{url:'{{ route('admin::entity.list') }}?{{ request()->getQueryString() }}', page:true, limit:50, id:'test', toolbar:'<div><a href=\'{{ route('admin::entity.create') }}\'><i class=\'layui-icon layui-icon-add-1\'></i>新增模型</a></div>'}" lay-filter="test">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true}">ID</th>
                    @include('admin.listHead', ['data' => App\Model\Admin\Entity::$listField])
                    <th lay-data="{field:'created_at'}">添加時間</th>
                    <th lay-data="{field:'updated_at'}">更新時間</th>
                    <th lay-data="{width:350, templet:'#action'}">操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
<script type="text/html" id="action">
    <a href="<% d.editUrl %>" class="layui-table-link" title="編輯"><i class="layui-icon layui-icon-edit"></i></a>
    <a href="javascript:;" class="layui-table-link" title="删除" style="margin-left: 10px" onclick="deleteEntity('<% d.deleteUrl %>')"><i class="layui-icon layui-icon-delete"></i></a>
    <a href="javascript:;" class="layui-table-link" title="複製" style="margin-left: 10px" onclick="copyEntity('<% d.copyUrl %>')"><i class="layui-icon layui-icon-file"></i></a>
    <a href="javascript:;" class="layui-table-link" title="添加默認選單，用于精细化權限控制" style="margin-left: 10px" onclick="addEntityMenus('<% d.menuUrl %>')"><i class="layui-icon layui-icon-menu-fill"></i></a>
    <%#  if(d.enable_comment == {{ App\Model\Admin\Entity::COMMENT_ENABLE }}){ %> <a href="<% d.commentListUrl %>" class="layui-table-link" title="評論列表" style="margin-left: 5px"><i class="layui-icon layui-icon-reply-fill"></i></a> <%#  } %>
    <a href="<% d.fieldUrl %>" class="layui-table-link" title="字段管理" style="margin-left: 5px">字段管理</a>
    <a href="<% d.contentUrl %>" class="layui-table-link" title="字段管理" style="margin-left: 5px">内容管理</a>
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

        function deleteEntity (url) {
            layer.confirm('删除模型将删除模型相关的所有數據（模型、模型字段、模型分類、模型内容等），请谨慎操作！確定要删除？', function(index){
                layer.prompt({
                    formType: 1,
                    title: '请输入登入密码',
                }, function(value, index, elem){
                    $.ajax({
                        url: url,
                        data: {'_method': 'DELETE', 'password': value},
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

                layer.close(index);
            });
        }

        function copyEntity (url) {
            layer.confirm('複製模型将新建一个和當前模型一样的模型（資料庫表结構、表單定义等信息一致），確定要複製？', function(index){
                layer.prompt({
                    formType: 0,
                    title: '请输入新模型的資料庫表名稱',
                }, function(value, index, elem){
                    $.ajax({
                        url: url,
                        data: {'table_name': value},
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

                layer.close(index);
            });
        }

        function addEntityMenus (url) {
            layer.confirm('添加模型的默認選單是為了对指定模型进行单独的權限控制，添加選單时如遇到同名的選單将略过不处理，確定要添加？', function(index){
                $.ajax({
                    url: url,
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
