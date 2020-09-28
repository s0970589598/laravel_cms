<?php
return [
    // 超级管理員。不受權限控制
    'superAdmin' => [1],

    // 各类缓存KEY
    'cache_key' => [
        'config' => 'config'
    ],
    // 加载資料庫自定义配置
    'light_config' => false,

    // 系统Log保留時間。单位：天
    'log_reserve_days' => 180,

    // 异步写入系统Log
    'log_async_write' => false,

    // 資料庫表字段類型 参考：https://laravel.com/docs/5.5/migrations#columns
    'db_table_field_type' => [
        'string',
        'char',
        'text',
        'mediumText',
        'longText',
        'integer',
        'unsignedInteger',
        'tinyInteger',
        'unsignedTinyInteger',
        'smallInteger',
        'unsignedSmallInteger',
        'mediumInteger',
        'unsignedMediumInteger',
        'bigInteger',
        'unsignedBigInteger',
        'float',
        'double',
        'decimal',
        'unsignedDecimal',
        'date',
        'dateTime',
        'dateTimeTz',
        'time',
        'timeTz',
        'timestamp',
        'timestampTz',
        'year',
        'binary',
        'boolean',
        'enum',
        'json',
        'jsonb',
        'geometry',
        'geometryCollection',
        'ipAddress',
        'lineString',
        'macAddress',
        'multiLineString',
        'multiPoint',
        'multiPolygon',
        'point',
        'polygon',
        'uuid',
    ],

    // 表單類型
    'form_type' => [
        'input' => '短文本（input）',
        'inputAutoComplete' => '短文本（input，自動完成）',
        'textArea' => '长文本（textarea）',
        'richText' => '副文本',
        'markdown' => '副文本（markdown）',
        'password' => '密码字符',
        'option' => '单选框',
        'checkbox' => '复选框',
        'select' => '下拉选择',
        'selectSingleSearch' => '下拉选择（远程搜索）',
        'selectMulti' => '下拉选择（多选）',
        'selectMultiSearch' => '下拉选择（多选，远程搜索）',
        'inputTags' => '標簽输入框',
        'upload' => '圖片上传（单圖）',
        'uploadMulti' => '圖片上传（多圖）',
        'datetime' => '日期時間',
        'date' => '日期',
        'reference_category' => '引用分類數據',
        'reference_admin_user' => '引用管理員數據'
    ],

    // NEditor相关
    'neditor' => [
        'disk' => 'admin_img',
        'upload' => [
            'imageMaxSize' => 8 * 1024 * 1024, /* 上传大小限制，单位B */
            'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp', ".webp"], /* 上传圖片格式显示 */
        ]
    ],
    'image_upload' => [
        'driver' => 'local', // local 表示上传到本地服务器。上传到其它服务器请设置自定义名称
        'class' => '', // 自定义 driver 需要填写对应包括命名空间的完整类名，该类需要实现 App\Contracts\ImageUpload 接口
    ],

    // 三方登入
    'auth_login' => [
        'weibo' => [
            'client_id' => env('WEIBO_CLIENT_ID', ''),
            'client_secret' => env('WEIBO_CLIENT_SECRET', ''),
            'redirect' => env('WEIBO_REDIRECT', ''),
        ],
        'qq' => [
            'client_id' => env('QQ_CLIENT_ID', ''),
            'client_secret' => env('QQ_CLIENT_SECRET', ''),
            'redirect' => env('QQ_REDIRECT', ''),
        ],
        'wechat' => [
            'client_id' => env('WECHAT_CLIENT_ID', ''),
            'client_secret' => env('WECHAT_CLIENT_SECRET', ''),
            'redirect' => env('WECHAT_REDIRECT', ''),
        ],
    ]
];
