<?php
/*注意：此配置来自 ueditor 官方包中，僅供参考。LightCMS 編輯並未完全實現其相關功能，有需要可自行擴展實現*/

/* 前編輯通信相關的配置,注譯只允许使用多行方式 */
return [
    /* 上傳圖片配置項 */
    "imageActionName" => "uploadimage", /* 執行上傳圖片的action名稱 */
    "imageFieldName" => "file", /* 送出的圖片表單名稱 */
    "imageMaxSize" => 2048000, /* 上傳大小限制，單位B */
    "imageAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 上傳圖片格式顯示 */
    "imageCompressEnable" => true, /* 是否壓缩圖片,默認是true */
    "imageCompressBorder" => 1600, /* 圖片壓缩最長邊限制 */
    "imageInsertAlign" => "none", /* 插入的圖片浮動方式 */
    "imageUrlPrefix" => "", /* 圖片訪問路径前缀 */
    "imagePathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
                                /* {filename} 會替换成原文件名,配置這項需要注意中文乱碼問题 */
                                /* {rand =>6} 會替换成随机數,後面的數字是随机數的位數 */
                                /* {time} 會替换成時間戳 */
                                /* {yyyy} 會替换成四位年份 */
                                /* {yy} 會替换成兩位年份 */
                                /* {mm} 會替换成兩位月份 */
                                /* {dd} 會替换成兩位日期 */
                                /* {hh} 會替换成兩位小時 */
                                /* {ii} 會替换成兩位分鐘 */
                                /* {ss} 會替换成兩位秒 */
                                /* 非法字符 \  => * ? " < > | */
                                /* 具請體看線上文档 => fex.baidu.com/ueditor/#use-format_upload_filename */

    /* 涂鸦圖片上傳配置項 */
    "scrawlActionName" => "uploadscrawl", /* 執行上傳涂鸦的action名稱 */
    "scrawlFieldName" => "upfile", /* 送出的圖片表單名稱 */
    "scrawlPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
    "scrawlMaxSize" => 2048000, /* 上傳大小限制，單位B */
    "scrawlUrlPrefix" => "", /* 圖片訪問路径前缀 */
    "scrawlInsertAlign" => "none",

    /* 截圖工具上傳 */
    "snapscreenActionName" => "uploadimage", /* 執行上傳截圖的action名稱 */
    "snapscreenPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
    "snapscreenUrlPrefix" => "", /* 圖片訪問路径前缀 */
    "snapscreenInsertAlign" => "none", /* 插入的圖片浮動方式 */

    /* 抓取遠程圖片配置 */
    "catcherLocalDomain" => ["127.0.0.1", "localhost", "img.baidu.com"],
    "catcherActionName" => "catchimage", /* 執行抓取遠程圖片的action名稱 */
    "catcherFieldName" => "source", /* 送出的圖片列表表單名稱 */
    "catcherPathFormat" => "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
    "catcherUrlPrefix" => "", /* 圖片訪問路径前缀 */
    "catcherMaxSize" => 2048000, /* 上傳大小限制，單位B */
    "catcherAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 抓取圖片格式顯示 */

    /* 上傳視频配置 */
    "videoActionName" => "uploadvideo", /* 執行上傳視频的action名稱 */
    "videoFieldName" => "upfile", /* 送出的視频表單名稱 */
    "videoPathFormat" => "/ueditor/php/upload/video/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
    "videoUrlPrefix" => "", /* 視频訪問路径前缀 */
    "videoMaxSize" => 102400000, /* 上傳大小限制，單位B，默認100MB */
    "videoAllowFiles" => [
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"], /* 上傳視频格式顯示 */

    /* 上傳文件配置 */
    "fileActionName" => "uploadfile", /* controller里,執行上傳視频的action名稱 */
    "fileFieldName" => "upfile", /* 送出的文件表單名稱 */
    "filePathFormat" => "/ueditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
    "fileUrlPrefix" => "", /* 文件訪問路径前缀 */
    "fileMaxSize" => 51200000, /* 上傳大小限制，單位B，默認50MB */
    "fileAllowFiles" => [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ], /* 上傳文件格式顯示 */

    /* 列出指定目入下的圖片 */
    "imageManagerActionName" => "listimage", /* 執行圖片管理的action名稱 */
    "imageManagerListPath" => "/ueditor/php/upload/image/", /* 指定要列出圖片的目入 */
    "imageManagerListSize" => 20, /* 每次列出文件數量 */
    "imageManagerUrlPrefix" => "", /* 圖片訪問路径前缀 */
    "imageManagerInsertAlign" => "none", /* 插入的圖片浮動方式 */
    "imageManagerAllowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 列出的文件類型 */

    /* 列出指定目入下的文件 */
    "fileManagerActionName" => "listfile", /* 執行文件管理的action名稱 */
    "fileManagerListPath" => "/ueditor/php/upload/file/", /* 指定要列出文件的目入 */
    "fileManagerUrlPrefix" => "", /* 文件訪問路径前缀 */
    "fileManagerListSize" => 20, /* 每次列出文件數量 */
    "fileManagerAllowFiles" => [
        ".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp",
        ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
        ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
        ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
        ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
    ] /* 列出的文件類型 */
];
