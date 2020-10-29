/**
 * 自定義上傳接口
 * 由於所有Neditor請求都通過editor對象的getActionUrl方法獲取上傳接口，可以直接通過覆寫這個方法實現自定義上傳接口
 * @param {String} action 匹配neditor.config.js中配置的xxxActionName
 * @returns 返回自定義的上傳接口
 */
UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
UE.Editor.prototype.getActionUrl = function(action) {
    /* 按config中的xxxActionName返回對應的接口地址 */
    return '/admin/neditor/serve/' + action;
    //return this._bkGetActionUrl.call(this, action);
}

/**
 * 圖片上傳service
 * @param {Object} context UploadImage對象 圖片上傳上下文
 * @param {Object} editor  編輯器對象
 * @returns imageUploadService 對象
 */
window.UEDITOR_CONFIG['imageUploadService'] = function(context, editor) {
    return {
        /** 
         * 觸發fileQueued事件時執行
         * 當文件被加入隊列以後觸發，用来設置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 觸發uploadBeforeSend事件時執行
         * 在文件上傳之前觸發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以擴展此對象来控制上傳参數
         * @param {Object} headers 可以擴展此對象来控制上傳頭部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 觸發startUpload事件時執行
         * 當開始上傳流程時觸發，用来設置Uploader配置項
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 觸發uploadSuccess事件時執行
         * 當文件上傳成功時觸發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態條件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中圖片路径的欄位，默認為 url
         * 如果圖片路径欄位不是res的屬性，可以寫成 對象.屬性 的方式，例如：data.url 
         * */
        imageSrcField: 'url'
    }
};

/**
 * 視频上傳service
 * @param {Object} context UploadVideo對象 視频上傳上下文
 * @param {Object} editor  編輯器對象
 * @returns videoUploadService 對象
 */
window.UEDITOR_CONFIG['videoUploadService'] = function(context, editor) {
    return {
        /** 
         * 觸發fileQueued事件時執行
         * 當文件被加入隊列以後觸發，用来設置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 觸發uploadBeforeSend事件時執行
         * 在文件上傳之前觸發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以擴展此對象来控制上傳参數
         * @param {Object} headers 可以擴展此對象来控制上傳頭部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 觸發startUpload事件時執行
         * 當開始上傳流程時觸發，用来設置Uploader配置項
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 觸發uploadSuccess事件時執行
         * 當文件上傳成功時觸發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態條件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中視频路径的欄位，默認為 url
         * 如果視频路径欄位不是res的屬性，可以寫成 對象.屬性 的方式，例如：data.url 
         * */
        videoSrcField: 'url'
    }
};

/**
 * 涂鸦上傳service
 * @param {Object} context scrawlObj對象
 * @param {Object} editor  編輯器對象
 * @returns scrawlUploadService 對象
 */
window.UEDITOR_CONFIG['scrawlUploadService'] = function(context, editor) {
    return scrawlUploadService = {
        /**
         * 點擊涂鸦模態框確认按钮時觸發
         * 上傳涂鸦圖片
         * @param {Object} file 涂鸦canvas生成的圖片
         * @param {Object} base64 涂鸦canvas生成的base64
         * @param {Function} success 上傳成功回调函數,回傳上傳成功的response對象
         * @param {Function} fail 上傳失敗回调函數,回傳上傳失敗的response對象
         */

        /**
         * 上傳成功的response對象必须為以下兩個屬性赋值
         * 
         * 上傳接口返回的response成功狀態條件 {Boolean} (比如: res.code == 200)
         * res.responseSuccess = res.code == 200;
         * 
         * 指定上傳接口返回的response中涂鸦圖片路径的欄位，默認為 url 
         * res.videoSrcField = 'url';
         */
        uploadScraw: function(file, base64, success, fail) {

            /* 模拟上傳操作 */
            var formData = new FormData();
            formData.append('file', file, file.name);

            $.ajax({
                url: editor.getActionUrl(editor.getOpt('scrawlActionName')),
                type: 'POST',
                data: formData
            }).done(function(res) {
                var res = JSON.parse(res);
                
                /* 上傳接口返回的response成功狀態條件 (比如: res.code == 200) */
                res.responseSuccess = res.code == 200;

                /* 指定上傳接口返回的response中涂鸦圖片路径的欄位，默認為 url 
                 * 如果涂鸦圖片路径欄位不是res的屬性，可以寫成 對象.屬性 的方式，例如：data.url
                 */
                res.scrawlSrcField = 'url';

                /* 上傳成功 */
                success.call(context, res);
            }).fail(function(err) {
                /* 上傳失敗 */
                fail.call(context, err);
            });
        }
    }
}

/**
 * 附件上傳service
 * @param {Object} context UploadFile對象 附件上傳上下文
 * @param {Object} editor  編輯器對象
 * @returns fileUploadService 對象
 */
window.UEDITOR_CONFIG['fileUploadService'] = function(context, editor) {
    return {
        /** 
         * 觸發fileQueued事件時執行
         * 當文件被加入隊列以後觸發，用来設置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 觸發uploadBeforeSend事件時執行
         * 在文件上傳之前觸發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以擴展此對象来控制上傳参數
         * @param {Object} headers 可以擴展此對象来控制上傳頭部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 觸發startUpload事件時執行
         * 當開始上傳流程時觸發，用来設置Uploader配置項
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 觸發uploadSuccess事件時執行
         * 當文件上傳成功時觸發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態條件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中附件路径的欄位，默認為 url
         * 如果附件路径欄位不是res的屬性，可以寫成 對象.屬性 的方式，例如：data.url 
         * */
        fileSrcField: 'url'
    }
};