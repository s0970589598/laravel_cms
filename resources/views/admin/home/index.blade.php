@extends('admin.base')

@section('title', '首頁')

@section('content')

   
        <div class="layui-row">
            <div class="layui-col-md6">
                <div class="layui-card">
                    <div class="layui-card-header"><h2>近七日場域偵測人數</h2></div>
                    <table border="1" width="300" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>地點</td>
                            <td>近七日場域偵測人數</td>
                        </tr>
                        <tbody>
                            @foreach($data['data'] as $val2)
                            <tr>
                                <td> {{$val2->line_user_id}}</td>
                                <td>{{$val2->beacon_id}}</td>
                            </tr>
                            @endforeach
                    
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="layui-col-md6">
                <div class="layui-card">
                    <div class="layui-card-header"><h2>近七日收到訊息人數</h2></div>
                    <table border="1" width="300" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>地點</td>
                            <td>近七日收到訊息人數</td>
                        </tr>
                        <tbody>
                            @foreach($data2['data'] as $val)
                            <tr>
                                <td> {{$val->name}}</td>
                                <td>{{$val->broadcast_datetime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script>
    </script>
@endsection