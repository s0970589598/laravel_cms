/**
 * 自定义上傳接口
 * 由于所有Neditor请求都通过editor对象的getActionUrl方法获取上傳接口，可以直接通过复写这个方法实现自定义上傳接口
 * @param {String} action 匹配neditor.config.js中配置的xxxActionName
 * @returns 返回自定义的上傳接口
 */
UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
UE.Editor.prototype.getActionUrl = function(action) {
    /* 按config中的xxxActionName返回对应的接口地址 */
    return '/admin/neditor/serve/' + action;
    //return this._bkGetActionUrl.call(this, action);
}

/**
 * 圖片上傳service
 * @param {Object} context UploadImage对象 圖片上傳上下文
 * @param {Object} editor  編輯器对象
 * @returns imageUploadService 对象
 */
window.UEDITOR_CONFIG['imageUploadService'] = function(context, editor) {
    return {
        /** 
         * 触发fileQueued事件时執行
         * 當文件被加入队列以后触发，用来设置上傳相关的數據 (比如: url和自定义参數)
         * @param {Object} file 當前選擇的文件对象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触发uploadBeforeSend事件时執行
         * 在文件上傳之前触发，用来添加附带参數
         * @param {Object} object 當前上傳对象
         * @param {Object} data 默認的上傳参數，可以扩展此对象来控制上傳参數
         * @param {Object} headers 可以扩展此对象来控制上傳头部
         * @returns 上傳参數对象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触发startUpload事件时執行
         * 當開始上傳流程时触发，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触发uploadSuccess事件时執行
         * 當文件上傳成功时触发，可以在这里修改上傳接口返回的response对象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功状态条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中圖片路径的字段，默認為 url
         * 如果圖片路径字段不是res的属性，可以写成 对象.属性 的方式，例如：data.url 
         * */
        imageSrcField: 'url'
    }
};

/**
 * 视频上傳service
 * @param {Object} context UploadVideo对象 视频上傳上下文
 * @param {Object} editor  編輯器对象
 * @returns videoUploadService 对象
 */
window.UEDITOR_CONFIG['videoUploadService'] = function(context, editor) {
    return {
        /** 
         * 触发fileQueued事件时執行
         * 當文件被加入队列以后触发，用来设置上傳相关的數據 (比如: url和自定义参數)
         * @param {Object} file 當前選擇的文件对象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触发uploadBeforeSend事件时執行
         * 在文件上傳之前触发，用来添加附带参數
         * @param {Object} object 當前上傳对象
         * @param {Object} data 默認的上傳参數，可以扩展此对象来控制上傳参數
         * @param {Object} headers 可以扩展此对象来控制上傳头部
         * @returns 上傳参數对象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触发startUpload事件时執行
         * 當開始上傳流程时触发，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触发uploadSuccess事件时執行
         * 當文件上傳成功时触发，可以在这里修改上傳接口返回的response对象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功状态条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中视频路径的字段，默認為 url
         * 如果视频路径字段不是res的属性，可以写成 对象.属性 的方式，例如：data.url 
         * */
        videoSrcField: 'url'
    }
};

/**
 * 涂鸦上傳service
 * @param {Object} context scrawlObj对象
 * @param {Object} editor  編輯器对象
 * @returns scrawlUploadService 对象
 */
window.UEDITOR_CONFIG['scrawlUploadService'] = function(context, editor) {
    return scrawlUploadService = {
        /**
         * 点击涂鸦模态框确认按钮时触发
         * 上傳涂鸦圖片
         * @param {Object} file 涂鸦canvas生成的圖片
         * @param {Object} base64 涂鸦canvas生成的base64
         * @param {Function} success 上傳成功回调函數,回傳上傳成功的response对象
         * @param {Function} fail 上傳失败回调函數,回傳上傳失败的response对象
         */

        /**
         * 上傳成功的response对象必须為以下两个属性赋值
         * 
         * 上傳接口返回的response成功状态条件 {Boolean} (比如: res.code == 200)
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
                
                /* 上傳接口返回的response成功状态条件 (比如: res.code == 200) */
                res.responseSuccess = res.code == 200;

                /* 指定上傳接口返回的response中涂鸦圖片路径的字段，默認為 url 
                 * 如果涂鸦圖片路径字段不是res的属性，可以写成 对象.属性 的方式，例如：data.url
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
 * @param {Object} context UploadFile对象 附件上傳上下文
 * @param {Object} editor  編輯器对象
 * @returns fileUploadService 对象
 */
window.UEDITOR_CONFIG['fileUploadService'] = function(context, editor) {
    return {
        /** 
         * 触发fileQueued事件时執行
         * 當文件被加入队列以后触发，用来设置上傳相关的數據 (比如: url和自定义参數)
         * @param {Object} file 當前選擇的文件对象
         */
        setUploadData: function(file) {
            return file;
        },
        /**
         * 触发uploadBeforeSend事件时執行
         * 在文件上傳之前触发，用来添加附带参數
         * @param {Object} object 當前上傳对象
         * @param {Object} data 默認的上傳参數，可以扩展此对象来控制上傳参數
         * @param {Object} headers 可以扩展此对象来控制上傳头部
         * @returns 上傳参數对象
         */
        setFormData: function(object, data, headers) {
            return data;
        },
        /**
         * 触发startUpload事件时執行
         * 當開始上傳流程时触发，用来设置Uploader配置项
         * @param {Object} uploader
         * @returns uploader
         */
        setUploaderOptions: function(uploader) {
            return uploader;
        },
        /**
         * 触发uploadSuccess事件时執行
         * 當文件上傳成功时触发，可以在这里修改上傳接口返回的response对象
         * @param {Object} res 上傳接口返回的response
         * @returns {Boolean} 上傳接口返回的response成功状态条件 (比如: res.code == 200)
         */
        getResponseSuccess: function(res) {
            return res.code == 200;
        },
        /* 指定上傳接口返回的response中附件路径的字段，默認為 url
         * 如果附件路径字段不是res的属性，可以写成 对象.属性 的方式，例如：data.url 
         * */
        fileSrcField: 'url'
    }
};