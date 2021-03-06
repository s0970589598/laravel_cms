@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')

        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route('admin::entityField.update', ['id' => $id]) }}@else{{ route('admin::entityField.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} <i class="layui-icon layui-icon-tips" style="color: red; margin-right: 10px"></i>由於欄位修改操作具有一定危险性（可能會影嚮數據完整性），因此暂未實現直接修改模型的資料庫表結構<hr class="layui-bg-red">@endif
                    <div class="layui-form-item">
                        <label class="layui-form-label">模型</label>
                        <div class="layui-input-block" style="width: 400px">
                            <select name="entity_id" @if(isset($id)) disabled @endif>
                            @foreach($entity as $k => $v)
                                <option value="{{ $k }}" @if(request()->get('entity_id') == $k) selected @endif>{{ $v }}</option>
                            @endforeach
                            </select>

                        </div>
                    </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">欄位名稱</label>
                    <div class="layui-input-block">
                        <input @if(isset($id)) disabled @endif type="text" name="name" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}" placeholder="只能包含英文字母和數字，長度不超過64">
                    </div>
                </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">欄位類型</label>
                        <div class="layui-input-inline" style="width: 400px">
                            <select name="type" lay-verify="required" lay-filter="type" @if(isset($id)) disabled @endif>
                                @foreach(config('light.db_table_field_type') as $v)
                                    <option value="{{ $v }}" @if(isset($model) && $model->type == $v) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                            <div id="str_length" style="display: none">
                            <input type="number" name="field_length" value="" placeholder="對於char、string類型的欄位，請在此輸入欄位長度" class="layui-input">
                            </div>
                            <div id="float_length" style="display: none">
                            <input type="number" name="field_total" value="" placeholder="對於浮點數類型的欄位，請在此輸入總位數" class="layui-input">
                            <input type="number" name="field_scale" value="" placeholder="對於浮點數類型的欄位，請在此輸入小數位數" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-mid layui-word-aux"><a style="color:#FF5722" target="_blank" href="https://laravel.com/docs/5.5/migrations#columns">以MySQL資料庫為例：string類型對應VARCHAR；char類型對應CHAR</a></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">欄位默認值</label>
                        <div class="layui-input-block">
                            <input type="text" name="default_value" autocomplete="off" class="layui-input" placeholder="僅對字符串、數值類型的欄位類型有效" value="{{ $model->default_value ?? ''  }}" @if(isset($id)) disabled @endif>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">欄位注譯</label>
                        <div class="layui-input-block">
                            <input type="text" name="comment" autocomplete="off" class="layui-input" value="{{ $model->comment ?? ''  }}">
                        </div>
                    </div>
                    @if(!isset($id))
                    <div class="layui-form-item">
                        <label class="layui-form-label">變更表結構</label>
                        <div class="layui-input-inline" style="width: 50px;">
                            <input type="checkbox" name="is_modify_db" lay-skin="switch" lay-text="是|否" value="1" checked>
                        </div>
                        <div class="layui-form-mid layui-word-aux">某些情况下可能資料庫表結構已經通過其它方式建好，此處無需操作資料庫表，添加欄位主要是方便利用框架提供的模型增刪改查功能</div>
                    </div>
                    @endif
                    <hr>
                    <div class="layui-form-item">
                        <label class="layui-form-label">表單名稱</label>
                        <div class="layui-input-block">
                            <input type="text" name="form_name" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->form_name ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">表單類型</label>
                        <div class="layui-input-inline" style="width: 400px">
                            <select name="form_type" lay-verify="required" lay-filter="form_type">
                                @foreach(config('light.form_type') as $k => $v)
                                    <option value="{{ $k }}" @if(isset($model) && $model->form_type == $k) selected @endif>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-form-mid layui-word-aux"><span style="color:#FF5722">下拉選擇（遠程搜索）、下拉選擇（多選，遠程搜索）只支持行内展示</span></div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">表單備註</label>
                        <div class="layui-input-block">
                            <input type="text" name="form_comment" autocomplete="off" class="layui-input" value="{{ $model->form_comment ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">表單参數</label>
                        <div class="layui-input-block">
                            <textarea name="form_params" class="layui-textarea" placeholder="對於表單類型為單選框、多選框、下拉選擇的，需在此配置對應参數。参數格式為：key=value，多個以换行分隔。也可以填寫自定義的函數名稱，函數名稱需以getFormItemsFrom開頭，返回值需与前述數據格式一致。對於下拉選擇遠程搜索表單類型、短文本（input，自動完成）表單類型，需在此填寫編輯接口URL地址，接口返回數據格式可参考文档說明。">{{ $model->form_params ?? ''  }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">表單默認值</label>
                        <div class="layui-input-block">
                            <input type="text" name="form_default_value" autocomplete="off" class="layui-input" value="{{ $model->form_default_value ?? ''  }}" placeholder="新增内容時表單的默認初始值，僅支持簡單表單類型">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-inline">
                            <input type="number" name="order" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->order ?? 77  }}">
                        </div>
                        <div class="layui-form-mid layui-word-aux">值越小排序越靠前</div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                        <label class="layui-form-label">是否顯示</label>
                        <div class="layui-input-inline">
                            <input type="checkbox" name="is_show" lay-skin="switch" lay-text="是|否" value="1" @if(!isset($model) || isset($model) && $model->is_show == App\Model\Admin\EntityField::SHOW_ENABLE) checked @endif>
                        </div>
                        </div>

                        <div class="layui-inline" title="僅對部分表單類型（段文本、下拉選擇）有效">
                            <label class="layui-form-label">行内展示</label>
                            <div class="layui-input-inline">
                                <input type="checkbox" name="is_show_inline" lay-skin="switch" lay-text="是|否" value="1" @if(isset($model) && $model->is_show_inline == App\Model\Admin\EntityField::SHOW_INLINE) checked @endif>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label">是否可編輯</label>
                            <div class="layui-input-inline">
                                <input type="checkbox" name="is_edit" lay-skin="switch" lay-text="是|否" value="1" @if(!isset($model) || isset($model) && $model->is_edit == App\Model\Admin\EntityField::EDIT_ENABLE) checked @endif>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label">是否必填</label>
                            <div class="layui-input-inline">
                                <input type="checkbox" name="is_required" lay-skin="switch" lay-text="是|否" value="1" @if(!isset($model) || isset($model) && $model->is_required == App\Model\Admin\EntityField::REQUIRED_ENABLE) checked @endif>
                            </div>
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

        form.on('select(type)', function(data){
            if (data.value === 'char' || data.value === 'string') {
                $('#str_length').show();
                $('#float_length').hide();
            } else if (data.value === 'float' || data.value === 'double' || data.value === 'decimal' || data.value === 'unsignedDecimal') {
                    $('#str_length').hide();
                    $('#float_length').show();
            } else {
                $('#str_length').hide();
                $('#float_length').hide();
            }
        });

        layui.event.call(null, 'form', 'select(type)', {'value': $('select[name=type]').val()});
    </script>
@endsection
