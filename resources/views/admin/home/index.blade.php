@extends('admin.base')

@section('title', '首頁')

@section('content')

   
        <div class="layui-row">
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header"><h2>近七日場域偵測人數</h2></div>
                    <table  class="layui-table" lay-skin="line"border="1" width="300" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>地點</th>
                                <th>近七日場域偵測人數</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($log_beacon_event['data'] as $val2)
                            <tr>
                                <td> {{$val2->line_user_id}}</td>
                                <td>{{$val2->beacon_id}}</td>
                            </tr>
                            @endforeach
                    
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header"><h2>近七日收到訊息人數</h2></div>
                    <table  class="layui-table" lay-skin="line"border="1" width="300" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>地點</th>
                                <th>近七日收到訊息人數</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($log_broadcast['data'] as $val)
                            <tr>
                                <td> {{$val->name}}</td>
                                <td>{{$val->broadcast_datetime}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header"><h2>推播訊息標題</h2></div>
                    <table  class="layui-table" lay-skin="line" border="1" width="300" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>地點</th>
                                <th>標題</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($app_official_location_broadcast['data'] as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                <td> {{$val->title}}</td>
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