@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')

        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route('admin::user.update', ['id' => $id]) }}@else{{ route('admin::user.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">手機號碼</label>
                    <div class="layui-input-block">
                        <input type="text" name="phone" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->phone ?? ''  }}">
                    </div>
                </div>
                    @if(!isset($id))
                    <div class="layui-form-item">
                        <label class="layui-form-label">密碼</label>
                        <div class="layui-input-inline">
                            <input type="password" name="password" required lay-verify="required" placeholder="請輸入密碼" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">密碼6到18位，不能為純數字或純字母</div>
                    </div>
                    @endif
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否啟用</label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="status" lay-skin="switch" lay-text="啟用|禁用" value="1" @if(isset($model) && $model->status == App\Model\Admin\User::STATUS_ENABLE) checked @endif>
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
