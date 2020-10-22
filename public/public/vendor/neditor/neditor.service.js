/**
 * 自定義上傳接口
 * 由于所有Neditor请求都通过editor對象的getActionUrl方法获取上傳接口，可以直接通过复写這個方法实现自定義上傳接口
 * @param {String} action 匹配neditor.config.js中配置的xxxActionName
 * @returns 返回自定義的上傳接口
 */
UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
UE.Editor.prototype.getActionUrl = function(action) {
    /* 按config中的xxxActionName返回對应的接口地址 */
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
         * 触發fileQueued事件时執行
         * 當文件被加入队列以后触發，用来设置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触發uploadBeforeSend事件时執行
         * 在文件上傳之前触發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以扩展此對象来控制上傳参數
         * @param {Object} headers 可以扩展此對象来控制上傳头部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触發startUpload事件时執行
         * 當開始上傳流程时触發，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触發uploadSuccess事件时執行
         * 當文件上傳成功时触發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中圖片路径的字段，默認為 url
         * 如果圖片路径字段不是res的属性，可以写成 對象.属性 的方式，例如：data.url 
         * */
        imageSrcField: 'url'
    }
};

/**
 * 视频上傳service
 * @param {Object} context UploadVideo對象 视频上傳上下文
 * @param {Object} editor  編輯器對象
 * @returns videoUploadService 對象
 */
window.UEDITOR_CONFIG['videoUploadService'] = function(context, editor) {
    return {
        /** 
         * 触發fileQueued事件时執行
         * 當文件被加入队列以后触發，用来设置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触發uploadBeforeSend事件时執行
         * 在文件上傳之前触發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以扩展此對象来控制上傳参數
         * @param {Object} headers 可以扩展此對象来控制上傳头部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触發startUpload事件时執行
         * 當開始上傳流程时触發，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触發uploadSuccess事件时執行
         * 當文件上傳成功时触發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中视频路径的字段，默認為 url
         * 如果视频路径字段不是res的属性，可以写成 對象.属性 的方式，例如：data.url 
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
         * 点擊涂鸦模态框确认按钮时触發
         * 上傳涂鸦圖片
         * @param {Object} file 涂鸦canvas生成的圖片
         * @param {Object} base64 涂鸦canvas生成的base64
         * @param {Function} success 上傳成功回调函數,回傳上傳成功的response對象
         * @param {Function} fail 上傳失败回调函數,回傳上傳失败的response對象
         */

        /**
         * 上傳成功的response對象必须為以下两個属性赋值
         * 
         * 上傳接口返回的response成功狀態条件 {Boolean} (比如: res.code == 200)
         * res.responseSuccess = res.code == 200;
         * 
         * 指定上傳接口返回的response中涂鸦圖片路径的字段，默認為 url 
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
                
                /* 上傳接口返回的response成功狀態条件 (比如: res.code == 200) */
                res.responseSuccess = res.code == 200;

                /* 指定上傳接口返回的response中涂鸦圖片路径的字段，默認為 url 
                 * 如果涂鸦圖片路径字段不是res的属性，可以写成 對象.属性 的方式，例如：data.url
                 */
                res.scrawlSrcField = 'url';

                /* 上傳成功 */
                success.call(context, res);
            }).fail(function(err) {
                /* 上傳失败 */
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
         * 触發fileQueued事件时執行
         * 當文件被加入队列以后触發，用来设置上傳相關的數據 (比如: url和自定義参數)
         * @param {Object} file 當前選擇的文件對象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触發uploadBeforeSend事件时執行
         * 在文件上傳之前触發，用来添加附带参數
         * @param {Object} object 當前上傳對象
         * @param {Object} data 默認的上傳参數，可以扩展此對象来控制上傳参數
         * @param {Object} headers 可以扩展此對象来控制上傳头部
         * @returns 上傳参數對象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触發startUpload事件时執行
         * 當開始上傳流程时触發，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触發uploadSuccess事件时執行
         * 當文件上傳成功时触發，可以在這里修改上傳接口返回的response對象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功狀態条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中附件路径的字段，默認為 url
         * 如果附件路径字段不是res的属性，可以写成 對象.属性 的方式，例如：data.url 
         * */
        fileSrcField: 'url'
    }
};