@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')

        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route('admin::config.update', ['id' => $id]) }}@else{{ route('admin::config.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">名稱</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}">
                    </div>
                </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">標誌符</label>
                        <div class="layui-input-block">
                            <input type="text" name="key" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->key ?? ''  }}" placeholder="數字、字母或下底線组成，长度不超過100">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">值</label>
                        <div class="layui-input-block">
                            <textarea name="value" class="layui-textarea">{{ $model->value ?? ''  }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">類型</label>
                        <div class="layui-input-block">
                            <select name="type" lay-verify="required">
                                @foreach(App\Model\Admin\Config::$types as $k => $v)
                                <option value="{{ $k }}" @if(isset($model) && $k == $model->type) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分组</label>
                        <div class="layui-input-block">
                            <input type="text" name="group" autocomplete="off" class="layui-input" value="{{ $model->group ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">備註</label>
                        <div class="layui-input-block">
                            <textarea name="remark" class="layui-textarea">{{ $model->remark ?? ''  }}</textarea>
                        </div>
                    </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formAdminUser" id="submitBtn">送出</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重設</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var form = layui.form;

        //監聽送出
        form.on('submit(formAdminUser)', function(data){
            window.form_submit = $('#submitBtn');
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
