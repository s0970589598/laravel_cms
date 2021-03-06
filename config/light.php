<?php
return [
    // 超級管理員。不受權限控制
    'superAdmin' => [1],

    // 各類缓存KEY
    'cache_key' => [
        'config' => 'config'
    ],
    // 加戴資料庫自定義配置
    'light_config' => false,

    // 系统Log保留時間。單位：天
    'log_reserve_days' => 180,

    // 異步寫入系统Log
    'log_async_write' => false,

    // 資料庫表欄位類型 参考：https://laravel.com/docs/5.5/migrations#columns
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
        'textArea' => '長文本（textarea）',
        'richText' => '副文本',
        'markdown' => '副文本（markdown）',
        'password' => '密碼字符',
        'option' => '單選框',
        'checkbox' => '覆選框',
        'select' => '下拉選擇',
        'selectSingleSearch' => '下拉選擇（遠程搜索）',
        'selectMulti' => '下拉選擇（多選）',
        'selectMultiSearch' => '下拉選擇（多選，搜索）',
        'inputTags' => 'tag輸入框',
        'upload' => '圖片上傳（單圖）',
        'uploadMulti' => '圖片上傳（多圖）',
        'datetime' => '日期時間',
        'date' => '日期',
        'reference_category' => '引用分類數據',
        'reference_admin_user' => '引用管理員數據',
        'reference_beacon_title' => '引用beacon標題',
        'reference_beacon_location' => '引用beacon使用單位'
    ],

    // NEditor相關
    'neditor' => [
        'disk' => 'admin_img',
        'upload' => [
            'imageMaxSize' => 8 * 1024 * 1024, /* 上傳大小限制，單位B */
            'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp', ".webp"], /* 上傳圖片格式顯示 */
        ]
    ],
    'image_upload' => [
        'driver' => 'local', // local 表示上傳到本地服務器。上傳到其它服務器請設置自定義名稱
        'class' => '', // 自定義 driver 需要填寫對應包括命名空間的完整類名，該類需要實現 App\Contracts\ImageUpload 接口
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
