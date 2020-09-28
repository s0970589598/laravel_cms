<?php
/*注意：此配置来自 ueditor 官方包中，仅供参考。LightCMS 編輯并未完全实现其相关功能，有需要可自行扩展实现*/

/* 前編輯通信相关的配置,注释只允许使用多行方式 */
return [
    /* 上传圖片配置项 */
    "imageActionName" => "uploadimage", /* 執行上传圖片的action名称 */
    "imageFieldName" => "file", /* 送出的圖片表單名称 */
    "imageMaxSize" => 2048000, /* 上传大小限制，单位B */
    "imageAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 上传圖片格式显示 */
    "imageCompressEnable" => true, /* 是否压缩圖片,默認是true */
    "imageCompressBorder" => 1600, /* 圖片压缩最长边限制 */
    "imageInsertAlign" => "none", /* 插入的圖片浮动方式 */
    "imageUrlPrefix" => "", /* 圖片访问路径前缀 */
    "imagePathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                                /* {filename} 会替换成原文件名,配置这项需要注意中文乱码问题 */
                                /* {rand =>6} 会替换成随机數,后面的數字是随机數的位數 */
                                /* {time} 会替换成時間戳 */
                                /* {yyyy} 会替换成四位年份 */
                                /* {yy} 会替换成两位年份 */
                                /* {mm} 会替换成两位月份 */
                                /* {dd} 会替换成两位日期 */
                                /* {hh} 会替换成两位小时 */
                                /* {ii} 会替换成两位分钟 */
                                /* {ss} 会替换成两位秒 */
                                /* 非法字符 \  => * ? " < > | */
                                /* 具请体看线上文档 => fex.baidu.com/ueditor/#use-format_upload_filename */

    /* 涂鸦圖片上传配置项 */
    "scrawlActionName" => "uploadscrawl", /* 執行上传涂鸦的action名称 */
    "scrawlFieldName" => "upfile", /* 送出的圖片表單名称 */
    "scrawlPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "scrawlMaxSize" => 2048000, /* 上传大小限制，单位B */
    "scrawlUrlPrefix" => "", /* 圖片访问路径前缀 */
    "scrawlInsertAlign" => "none",

    /* 截圖工具上传 */
    "snapscreenActionName" => "uploadimage", /* 執行上传截圖的action名称 */
    "snapscreenPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "snapscreenUrlPrefix" => "", /* 圖片访问路径前缀 */
    "snapscreenInsertAlign" => "none", /* 插入的圖片浮动方式 */

    /* 抓取远程圖片配置 */
    "catcherLocalDomain" => ["127.0.0.1", "localhost", "img.baidu.com"],
    "catcherActionName" => "catchimage", /* 執行抓取远程圖片的action名称 */
    "catcherFieldName" => "source", /* 送出的圖片列表表單名称 */
    "catcherPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "catcherUrlPrefix" => "", /* 圖片访问路径前缀 */
    "catcherMaxSize" => 2048000, /* 上传大小限制，单位B */
    "catcherAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 抓取圖片格式显示 */

    /* 上传视频配置 */
    "videoActionName" => "uploadvideo", /* 執行上传视频的action名称 */
    "videoFieldName" => "upfile", /* 送出的视频表單名称 */
    "videoPathFormat" => "/ueditor/php/upload/video/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "videoUrlPrefix" => "", /* 视频访问路径前缀 */
    "videoMaxSize" => 102400000, /* 上传大小限制，单位B，默認100MB */
    "videoAllowFiles" => [
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"], /* 上传视频格式显示 */

    /* 上传文件配置 */
    "fileActionName" => "uploadfile", /* controller里,執行上传视频的action名称 */
    "fileFieldName" => "upfile", /* 送出的文件表單名称 */
    "filePathFormat" => "/ueditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
    "fileUrlPrefix" => "", /* 文件访问路径前缀 */
    "fileMaxSize" => 51200000, /* 上传大小限制，单位B，默認50MB */
    "fileAllowFiles" => [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ], /* 上传文件格式显示 */

    /* 列出指定目入下的圖片 */
    "imageManagerActionName" => "listimage", /* 執行圖片管理的action名称 */
    "imageManagerListPath" => "/ueditor/php/upload/image/", /* 指定要列出圖片的目入 */
    "imageManagerListSize" => 20, /* 每次列出文件數量 */
    "imageManagerUrlPrefix" => "", /* 圖片访问路径前缀 */
    "imageManagerInsertAlign" => "none", /* 插入的圖片浮动方式 */
    "imageManagerAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 列出的文件類型 */

    /* 列出指定目入下的文件 */
    "fileManagerActionName" => "listfile", /* 執行文件管理的action名称 */
    "fileManagerListPath" => "/ueditor/php/upload/file/", /* 指定要列出文件的目入 */
    "fileManagerUrlPrefix" => "", /* 文件访问路径前缀 */
    "fileManagerListSize" => 20, /* 每次列出文件數量 */
    "fileManagerAllowFiles" => [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ] /* 列出的文件類型 */
];
