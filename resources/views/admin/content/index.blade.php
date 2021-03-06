@extends('admin.base')

@section('content')
    @include('admin.breadcrumb')

    <div class="layui-card">
        <div class="layui-form layui-card-header light-search" style="height: auto">
            @if($entity <> '11' and $entity <> '12' and  $entity <> '7' and  $entity <> '9' and  $entity <> '10' and  $entity <> '19')
                
            
                <form method="GET">
                    <input type="hidden" name="action" value="search">
                    @include('admin.searchField', ['data' => App\Model\Admin\Content::$searchField])
                    <div class="layui-inline">
                        <label class="layui-form-label">創建日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="created_at" class="layui-input" id="created_at" value="{{ request()->get('created_at') }}">
                        </div>
                    </div>
                    @if(!empty(App\Model\Admin\Content::$sortFields))
                    <div class="layui-inline">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-inline">
                            <select name="light_sort_fields">
                                <option value="" @if(!request()->has('light_sort_fields')) selected @endif>請選擇</option>
                                @foreach(App\Model\Admin\Content::$sortFields as $ik => $iv)
                                    <option value="{{ $ik }}" @if(request()->has('light_sort_fields') && request()->get('light_sort_fields') !== "" && request()->get('light_sort_fields') == $ik) selected @endif>{{ $iv }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list"  id="submitBtn">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </form>
            @endif
            @if($entity == '9')
                <form>
                    <input type="hidden" name="action" value="search">
                    @include('admin.searchField', ['data' => App\Model\Admin\Content::$searchField])
                    <div class="layui-inline">
                        <label class="layui-form-label">搜尋標題</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" class="layui-input"  value="{{ request()->get('title') }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list" lay-filter="form-search" id="submitBtn">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </form> 
            @endif
            @if($entity == '10')
                <form>
                    <input type="hidden" name="action" value="search">
                    @include('admin.searchField', ['data' => App\Model\Admin\Content::$searchField])
                    <div class="layui-inline">
                        <label class="layui-form-label">搜尋訊息</label>
                        <div class="layui-input-inline">
                            <input type="text" name="message_text" class="layui-input"  value="{{ request()->get('message_text') }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list" lay-filter="form-search" id="submitBtn">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </form> 
            @endif
            @if($entity == '19')
                <form>
                    <input type="hidden" name="action" value="search">
                    @include('admin.searchField', ['data' => App\Model\Admin\Content::$searchField])
                    <div class="layui-inline">
                        <label class="layui-form-label">搜尋單位</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" class="layui-input"  value="{{ request()->get('name') }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list" lay-filter="form-search" id="submitBtn">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </form> 
            @endif

        </div>
        @switch($entity) 
        @case('12')
        @case('log_broadcast')
            <a  class="layui-btn layuiadmin-btn-list" href="/admin/entity/log_broadcast/contents">近七日收到訊息人數</a>
            <a  class="layui-btn layuiadmin-btn-list" href="/admin/entity/12/contents">log_broadcast列表</a>
        @break
        @case('11')
        @case('log_beacon_event')
            <a class="layui-btn layuiadmin-btn-list" href="/admin/entity/log_beacon_event/contents">近七日場域偵測人數</a>
            <a class="layui-btn layuiadmin-btn-list" href="/admin/entity/11/contents">log_beacon_event列表</a>
        @break
        @endswitch

        <div class="layui-card-body">
            <table class="layui-table" lay-data="{url:'{{ route('admin::content.list', ['entity' => $entity]) }}?{{ request()->getQueryString() }}', page:true, limit:50, id:'test', 
                {{--@if($entity <> '11' and $entity <> '12' and $entity <> '10' and $entity <> '19' and $entity <> '7')--}}
                toolbar:'<div><a href=\'{{ route('admin::content.create', ['entity' => $entity]) }}\'><i class=\'layui-icon layui-icon-add-1\'></i><span class=\'layui-badge\'>新增{{ $entityModel->name }}内容</span></a><div class=\'layui-input-inline\'><input type=\'text\' name=\'word\' class=\'layui-input\' id=\'word\' placeholder=\'當前表格内搜索\'></div></div>'}" 
                {{--@else
                toolbar:'<div class=\'layui-input-inline\'><input type=\'text\' name=\'word\' class=\'layui-input\' id=\'word\' placeholder=\'當前表格内搜索\'></div>'}"
                @endif --}}
                lay-filter="test">
                <thead>
                <tr>
                    <th lay-data="{width:50, type:'checkbox'}"></th>
                    <th lay-data="{field:'id', width:80, sort: true}">#</th>
                    @include('admin.listHead', ['data' => App\Model\Admin\Content::$listField])
                    @if($entity == '10')
                    <th lay-data="{field:'image_url',width:200,templet:'#imgTpl'}">缩圖</th>
                    @endif
                    <!--<th lay-data="{field:'created_at'}">添加時間</th>
                    <th lay-data="{field:'updated_at'}">更新時間</th>-->
                    <th lay-data="{width:200, templet:'#action'}">操作</th>
                </tr>
                </thead>
            </table>
           {{-- @if($entity <> '19' and $entity <> '7')--}}
            <div>
                <form class="layui-form" method="post" action="{{ route('admin::content.batch', ['entity' => $entity]) }}">
                    <div class="layui-inline">
                        <label class="layui-form-label">操作類型</label>
                        <div class="layui-input-inline">
                            <select name="type" lay-filter="action-type">
                                <option value="delete">刪除</option>
                            </select>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-list" lay-filter="form-batch" id="batchBtn" lay-submit>
                                執行批量操作
                            </button>
                        </div>
                    </div>
                </form>
            </div>
           {{-- @endif--}}
        </div>
    </div>
@endsection

<script type="text/html" id="imgTpl">
    <div><img src="<% d.image_url %>" alt='暫無缩圖' width="100" height="30"></div>
</script>

<script type="text/html" id="action">
    @if($entity <>'log_broadcast' and  $entity <>'log_beacon_event')
    @if($entity =='9' )
    <a href="<% d.addUrl %>" class="layui-table-link" title="新增文字訊息"><i class="layui-icon layui-icon-add-1"></i>文字</a>
    <a href="<% d.addImgUrl %>" class="layui-table-link" title="新增圖片訊息"><i class="layui-icon layui-icon-add-1"></i>圖片</a>
    @endif

    <a href="<% d.editUrl %>" class="layui-table-link" title="編輯"><i class="layui-icon layui-icon-edit"></i></a>
    @if($entity <> '19' and $entity <> '7')
    <a href="javascript:;" class="layui-table-link" title="刪除" style="margin-left: 10px" onclick="deleteMenu('<% d.deleteUrl %>')"><i class="layui-icon layui-icon-delete"></i></a>
    <!--<a href="<% d.commentListUrl %>" class="layui-table-link" title="評論列表" style="margin-left: 10px"><i class="layui-icon layui-icon-reply-fill"></i></a>-->
    @endif
    @endif
    @foreach(App\Model\Admin\Content::$actionField as $k => $v)
    <a href="<% d.{{$k}} %>" class="layui-table-link" title="{{ $v['description'] }}" style="margin-left: 5px">{{ $v['title'] }}</a>
    @endforeach
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

        $('#word').keyup(function () {
            $('.layui-table tr').each(function(i, v){
                $(v).css({"background-color": ""});
            });

            var word = $.trim($(this).val()).toLowerCase();
            if (word.length === 0) {
                return;
            }
            $('.layui-table tr').each(function(i, v){
                $(v).find('td').each(function(ii, vv) {
                    if ($(vv).text().toLowerCase().indexOf(word) >= 0) {
                        $(v).css({"background-color": "yellow"});
                        return false;
                    }
                });
            });
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
                                location.href = result.redirect;
                            }
                        });
                    }
                });

                layer.close(index);
            });
        }

        var form = layui.form,
            table = layui.table;
        form.on('submit(form-batch)', function(data){
            if(!confirm('確定執行批量操作？')){
                return false;
            }
            var checkStatus = table.checkStatus('test'),
                ids = [];

            if (checkStatus.data.length === 0) {
                layer.msg('未選中待操作的行數據');
                return false;
            }
            checkStatus.data.forEach(function (item) {
                ids.push(item.id);
            });
            data.field.ids = ids;

            window.form_submit = $('#batchBtn');
            form_submit.prop('disabled', true);
            $.ajax({
                url: data.form.action,
                data: data.field,
                success: function (result) {
                    if (result.code !== 0) {
                        form_submit.prop('disabled', false);
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

            return false;
        });
    </script>
@endsection
