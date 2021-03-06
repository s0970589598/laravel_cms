@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')

        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route('admin::category.update', ['id' => $id]) }}@else{{ route('admin::category.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                    <div class="layui-form-item">
                        <label class="layui-form-label">名稱</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">上級分類</label>
                        <div class="layui-input-block" style="width: 400px">
                            <select name="pid" lay-verify="required">
                                <option value="0">顶級分類</option>
                                @foreach(App\Repository\Admin\CategoryRepository::tree($model->model_id ?? null) as $v)
                                    @include('admin.menu', $v)
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">關聯模型</label>
                        <div class="layui-input-block" style="width: 400px">
                            <select name="model_id" lay-verify="required">
                                <option value="0">不關聯</option>
                                @foreach(App\Model\Admin\Entity::all(['id', 'name']) as $v)
                                    <option value="{{ $v->id }}" @if(isset($model) && $model->model_id == $v->id) selected @endif>{{ $v->name }}</option>
                                @endforeach
                            </select>
                            <div class="layui-form-mid light-danger">修改分類關聯的模型可能會破坏數據一致性，請谨慎操作</div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="order" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->order ?? 0  }}">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">標題</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" autocomplete="off" class="layui-input" value="{{ $model->title ?? ''  }}" placeholder="title">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">關鍵字</label>
                        <div class="layui-input-block">
                            <input type="text" name="keywords" autocomplete="off" class="layui-input" value="{{ $model->keywords ?? ''  }}" placeholder="keywords">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="description" autocomplete="off" class="layui-input" value="{{ $model->description ?? ''  }}" placeholder="description">
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
