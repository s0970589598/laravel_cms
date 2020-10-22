/**
 * neditor完整配置项
 * 可以在這里配置整個編輯器的特性
 */
/**************************提示********************************
 * 所有被注譯的配置项均為UEditor默認值。
 * 修改默認配置请首先确保已经完全明确该参數的真实用途。
 * 主要有两种修改方案，一种是取消此處注譯，然后修改成對应参數；另一种是在实例化編輯器时傳入對应参數。
 * 當升级編輯器时，可直接使用旧版配置文件替换新版配置文件,不用担心旧版配置文件中因缺少新功能所需的参數而导致脚本报错。
 **************************提示********************************/

(function () {
    /**
     * 編輯器资源文件根路径。它所表示的含義是：以編輯器实例化頁面為當前路径，指向編輯器资源文件（即dialog等文件夹）的路径。
     * 鉴于很多同学在使用編輯器的时候出现的种种路径問题，此處强烈建议大家使用"相對于网站根目入的相對路径"进行配置。
     * "相對于网站根目入的相對路径"也就是以斜杠開头的形如"/myProject/neditor/"這樣的路径。
     * 如果站点中有多個不在同一层级的頁面需要实例化編輯器，且引用了同一UEditor的时候，此處的URL可能不适用于每個頁面的編輯器。
     * 因此，UEditor提供了针對不同頁面的編輯器可單独配置的根路径，具体来說，在需要实例化編輯器的頁面最顶部写上如下代码即可。當然，需要令此處的URL等于對应的配置。
     * window.UEDITOR_HOME_URL = "/xxxx/xxxx/";
     */
    var URL = window.UEDITOR_HOME_URL || getUEBasePath();

    /**
     * 配置项主体。注意，此處所有涉及到路径的配置别遗漏URL變量。
     */
    window.UEDITOR_CONFIG = {
        //為編輯器实例添加一個路径，這個不能被注譯
        UEDITOR_HOME_URL: URL,

        // 服务器统一请求接口路径
        //serverUrl: window.NEDITOR_UPLOAD || URL + "php/controller.php",
        serverUrl: "",
        imageActionName: "uploadimage",
        scrawlActionName: "uploadscrawl",
        videoActionName: "uploadvideo",
        fileActionName: "uploadfile",
        imageFieldName: "file", // 送出的圖片表單名稱
        imageMaxSize: 2048000, // 上傳大小限制，單位B
        imageUrlPrefix: "",
        scrawlUrlPrefix: "",
        videoUrlPrefix: "",
        fileUrlPrefix: "",

         /* 抓取远程圖片配置 */
        catcherLocalDomain : ["127.0.0.1", "localhost", "img.baidu.com"],
        catcherActionName : "catchimage", /* 執行抓取远程圖片的action名稱 */
        catcherFieldName : "file", /* 送出的圖片列表表單名稱 */
        catcherPathFormat : "/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand =>6}", /* 上傳保存路径,可以自定義保存路径和文件名格式 */
        catcherUrlPrefix : "", /* 圖片访問路径前缀 */
        catcherMaxSize : 2048000, /* 上傳大小限制，單位B */
        catcherAllowFiles : [".png", ".jpg", ".jpeg", ".gif", ".bmp", ".webp"], /* 抓取圖片格式显示 */

        //工具栏上的所有的功能按钮和下拉框，可以在new編輯器的实例时選擇自己需要的重新定義
        toolbars: [
                [
                    "fullscreen",
                    "source",
                    "|",
                    "undo",
                    "redo",
                    "|",
                    "bold",
                    "italic",
                    "underline",
                    "fontborder",
                    "strikethrough",
                    "superscript",
                    "subscript",
                    "removeformat",
                    "formatmatch",
                    "autotypeset",
                    "blockquote",
                    "pasteplain",
                    "|",
                    "forecolor",
                    "backcolor",
                    "insertorderedlist",
                    "insertunorderedlist",
                    "selectall",
                    "cleardoc",
                    "|",
                    "rowspacingtop",
                    "rowspacingbottom",
                    "lineheight",
                    "|",
                    "customstyle",
                    "paragraph",
                    "fontfamily",
                    "fontsize",
                    "|",
                    "directionalityltr",
                    "directionalityrtl",
                    "indent",
                    "|",
                    "justifyleft",
                    "justifycenter",
                    "justifyright",
                    "justifyjustify",
                    "|",
                    "touppercase",
                    "tolowercase",
                    "|",
                    "link",
                    "unlink",
                    "anchor",
                    "|",
                    "imagenone",
                    "imageleft",
                    "imageright",
                    "imagecenter",
                    "|",
                    // "simpleupload",
                    "insertimage",
                    "emotion",
                    "scrawl",
                    "insertvideo",
                    "music",
                    "attachment",
                    "map",
                    "gmap",
                    "insertframe",
                    // "webapp",
                    "pagebreak",
                    "template",
                    "background",
                    "|",
                    "insertcode",
                    "horizontal",
                    "date",
                    "time",
                    "spechars",
                    "snapscreen",
                    "wordimage",
                    "|",
                    "inserttable",
                    "deletetable",
                    "insertparagraphbeforetable",
                    "insertrow",
                    "deleterow",
                    "insertcol",
                    "deletecol",
                    "mergecells",
                    "mergeright",
                    "mergedown",
                    "splittocells",
                    "splittorows",
                    "splittocols",
                    "charts",
                    "|",
                    "print",
                    "preview",
                    "searchreplace",
                    "drafts",
                    "help"
                ]
            ]
            //當鼠标放在工具栏上时显示的tooltip提示,留空支持自動多语言配置，否则以配置值為准
            //,labelMap:{
            //    'anchor':'', 'undo':''
            //}

            //语言配置项,默認是zh-cn。有需要的话也可以使用如下這樣的方式来自動多语言切换，當然，前提条件是lang文件夹下存在對应的语言文件：
            //lang值也可以通过自動获取 (navigator.language||navigator.browserLanguage ||navigator.userLanguage).toLowerCase()
            //,lang:"zh-cn"
            //,langPath:URL +"i18n/"

            //主题配置项,默認是default。有需要的话也可以使用如下這樣的方式来自動多主题切换，當然，前提条件是themes文件夹下存在對应的主题文件：
            //现有如下皮肤:default
            ,
        theme: 'notadd'
            //,themePath:URL +"themes/"

            ,
        zIndex: 1100 //編輯器层级的基數,默認是900

            //针對getAllHtml方法，会在對应的head標簽中增加该编码设置。
            //,charset:"utf-8"

            //若实例化編輯器的頁面手动修改的domain，此處需要设置為true
            //,customDomain:false

            //常用配置项目
            //,isShow : true    //默認显示編輯器

            //,textarea:'editorValue' // 送出表單时，服务器获取編輯器送出内容的所用的参數，多实例时可以给容器name属性，会将name给定的值最為每個实例的键值，不用每次实例化的时候都设置這個值

            //,initialContent:'歡迎使用neditor!'    //初始化編輯器的内容,也可以通过textarea/script给值，看官网例子

            //,autoClearinitialContent:true //是否自動清除編輯器初始内容，注意：如果focus属性设置為true,這個也為真，那么編輯器一上来就会触發导致初始化的内容看不到了

            //,focus:false //初始化时，是否讓編輯器获得焦点true或false

            //如果自定義，最好给p標簽如下的行高，要不输入中文时，会有跳动感
            //,initialStyle:'p{line-height:1em}'//編輯器层级的基數,可以用来改變字体等

            //,iframeJsUrl: '' //给編輯区域的iframe引入一個js文件
            //,iframeCssUrl: URL + '/themes/iframe.css' //给編輯区域的iframe引入一個css文件

            //indentValue
            //首行缩进距离,默認是2em
            //,indentValue:'2em'

            //,initialFrameWidth:1000  //初始化編輯器宽度,默認1000
            //,initialFrameHeight:320  //初始化編輯器高度,默認320

            //,readonly : false //編輯器初始化结束后,編輯区域是否是只读的，默認是false

            //,autoClearEmptyNode : true //getContent时，是否删除空的inlineElement节点（包括嵌套的情况）

            //启用自動保存
            //,enableAutoSave: true
            //自動保存间隔時間， 單位ms
            //,saveInterval: 500

            //启用拖放上傳
            //,enableDragUpload: true
            //启用粘贴上傳
            //,enablePasteUpload: true

            //启用圖片拉伸缩放
            //,imageScaleEnabled: true

            //,fullscreen : false //是否開启初始化时即全屏，默認關闭

            //,imagePopup:true      //圖片操作的浮层開關，默認打開

            //,autoSyncData:true //自動同步編輯器要送出的數據
            //,emotionLocalization:false //是否開启表情本地化，默認關闭。若要開启请确保emotion文件夹下包含官网提供的images表情文件夹

            //粘贴只保留標簽，去除標簽所有属性
            //,retainOnlyLabelPasted: false

            //,pasteplain:false  //是否默認為纯文本粘贴。false為不使用纯文本粘贴，true為使用纯文本粘贴
            //纯文本粘贴模式下的过滤规则
            //'filterTxtRules' : function(){
            //    function transP(node){
            //        node.tagName = 'p';
            //        node.setStyle();
            //    }
            //    return {
            //        //直接删除及其字节点内容
            //        '-' : 'script style object iframe embed input select',
            //        'p': {$:{}},
            //        'br':{$:{}},
            //        'div':{'$':{}},
            //        'li':{'$':{}},
            //        'caption':transP,
            //        'th':transP,
            //        'tr':transP,
            //        'h1':transP,'h2':transP,'h3':transP,'h4':transP,'h5':transP,'h6':transP,
            //        'td':function(node){
            //            //没有内容的td直接删掉
            //            var txt = !!node.innerText();
            //            if(txt){
            //                node.parentNode.insertAfter(UE.uNode.createText(' &nbsp; &nbsp;'),node);
            //            }
            //            node.parentNode.removeChild(node,node.innerText())
            //        }
            //    }
            //}()

            //,allHtmlEnabled:false //送出到后台的數據是否包含整個html字符串

            //insertorderedlist
            //有序列表的下拉配置,值留空时支持多语言自動识别，若配置值，则以此值為准
            //,'insertorderedlist':{
            //      //自定的樣式
            //        'num':'1,2,3...',
            //        'num1':'1),2),3)...',
            //        'num2':'(1),(2),(3)...',
            //        'cn':'一,二,三....',
            //        'cn1':'一),二),三)....',
            //        'cn2':'(一),(二),(三)....',
            //     //系统自带
            //     'decimal' : '' ,         //'1,2,3...'
            //     'lower-alpha' : '' ,    // 'a,b,c...'
            //     'lower-roman' : '' ,    //'i,ii,iii...'
            //     'upper-alpha' : '' , lang   //'A,B,C'
            //     'upper-roman' : ''      //'I,II,III...'
            //}

            //insertunorderedlist
            //無序列表的下拉配置，值留空时支持多语言自動识别，若配置值，则以此值為准
            //,insertunorderedlist : { //自定的樣式
            //    'dash' :'— 破折号', //-破折号
            //    'dot':' 。 小圆圈', //系统自带
            //    'circle' : '',  // '○ 小圆圈'
            //    'disc' : '',    // '● 小圆点'
            //    'square' : ''   //'■ 小方块'
            //}
            //,listDefaultPaddingLeft : '30'//默認的左边缩进的基數倍
            //,listiconpath : 'http://bs.baidu.com/listicon/'//自定義标号的路径
            //,maxListLevel : 3 //限制可以tab的级數, 设置-1為不限制

            //,autoTransWordToList:false  //禁止word中粘贴进来的列表自動變成列表標簽

            //fontfamily
            //字体设置 label留空支持多语言自動切换，若配置，则以配置值為准
            //,'fontfamily':[
            //    { label:'',name:'songti',val:'宋体,SimSun'},
            //    { label:'',name:'kaiti',val:'楷体,楷体_GB2312, SimKai'},
            //    { label:'',name:'yahei',val:'微软雅黑,Microsoft YaHei'},
            //    { label:'',name:'heiti',val:'黑体, SimHei'},
            //    { label:'',name:'lishu',val:'隶书, SimLi'},
            //    { label:'',name:'andaleMono',val:'andale mono'},
            //    { label:'',name:'arial',val:'arial, helvetica,sans-serif'},
            //    { label:'',name:'arialBlack',val:'arial black,avant garde'},
            //    { label:'',name:'comicSansMs',val:'comic sans ms'},
            //    { label:'',name:'impact',val:'impact,chicago'},
            //    { label:'',name:'timesNewRoman',val:'times new roman'}
            //]

            //fontsize
            //字号
            //,'fontsize':[10, 11, 12, 14, 16, 18, 20, 24, 36]

            //paragraph
            //段落格式 值留空时支持多语言自動识别，若配置，则以配置值為准
            //,'paragraph':{'p':'', 'h1':'', 'h2':'', 'h3':'', 'h4':'', 'h5':'', 'h6':''}

            //rowspacingtop
            //段间距 值和显示的名字相同
            //,'rowspacingtop':['5', '10', '15', '20', '25']

            //rowspacingBottom
            //段间距 值和显示的名字相同
            //,'rowspacingbottom':['5', '10', '15', '20', '25']

            //lineheight
            //行内间距 值和显示的名字相同
            //,'lineheight':['1', '1.5','1.75','2', '3', '4', '5']

            //customstyle
            //自定義樣式，不支持国际化，此處配置值即可最后显示值
            //block的元素是依据设置段落的逻辑设置的，inline的元素依据BIU的逻辑设置
            //尽量使用一些常用的標簽
            //参數說明
            //tag 使用的標簽名字
            //label 显示的名字也是用来标识不同類型的标识符，注意這個值每個要不同，
            //style 添加的樣式
            //每一個對象就是一個自定義的樣式
            //,'customstyle':[
            //    {tag:'h1', name:'tc', label:'', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;text-align:center;margin:0 0 20px 0;'},
            //    {tag:'h1', name:'tl',label:'', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;margin:0 0 10px 0;'},
            //    {tag:'span',name:'im', label:'', style:'font-style:italic;font-weight:bold'},
            //    {tag:'span',name:'hi', label:'', style:'font-style:italic;font-weight:bold;color:rgb(51, 153, 204)'}
            //]

            //打開右键選單功能
            //,enableContextMenu: true
            //右键選單的内容，可以参考plugins/contextmenu.js里边的默認選單的例子，label留空支持国际化，否则以此配置為准
            //,contextMenu:[
            //    {
            //        label:'',       //显示的名稱
            //        cmdName:'selectall',//執行的command命令，當点擊這個右键選單时
            //        //exec可選，有了exec就会在点擊时執行這個function，优先级高于cmdName
            //        exec:function () {
            //            //this是當前編輯器的实例
            //            //this.ui._dialogs['inserttableDialog'].open();
            //        }
            //    }
            //]

            //快捷選單
            //,shortcutMenu:["fontfamily", "fontsize", "bold", "italic", "underline", "forecolor", "backcolor", "insertorderedlist", "insertunorderedlist"]

            //elementPathEnabled
            //是否啟用元素路径，默認是显示
            //,elementPathEnabled : true

            //wordCount
            //,wordCount:true          //是否開启字數统计
            //,maximumWords:10000       //允许的最大字符數
            //字數统计提示，{#count}代表當前字數，{#leave}代表还可以输入多少字符數,留空支持多语言自動切换，否则按此配置显示
            //,wordCountMsg:''   //當前已输入 {#count} 個字符，您还可以输入{#leave} 個字符
            //超出字數限制提示  留空支持多语言自動切换，否则按此配置显示
            //,wordOverFlowMsg:''    //<span style="color:red;">你输入的字符個數已经超出最大允许值，服务器可能会拒绝保存！</span>

            //tab
            //点擊tab键时移动的距离,tabSize倍數，tabNode什么字符做為單位
            //,tabSize:4
            //,tabNode:'&nbsp;'

            //removeFormat
            //清除格式时可以删除的標簽和属性
            //removeForamtTags標簽
            //,removeFormatTags:'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var'
            //removeFormatAttributes属性
            //,removeFormatAttributes:'class,style,lang,width,height,align,hspace,valign'

            //undo
            //可以最多回退的次數,默認20
            //,maxUndoCount:20
            //當输入的字符數超过该值时，保存一次现场
            //,maxInputCount:1

            //autoHeightEnabled
            // 是否自動长高,默認true
            ,
        autoHeightEnabled: false

            //scaleEnabled
            //是否可以拉伸长高,默認true(當開启时，自動长高失效)
            //,scaleEnabled:false
            //,minFrameWidth:800    //編輯器拖动时最小宽度,默認800
            //,minFrameHeight:220  //編輯器拖动时最小高度,默認220

            //autoFloatEnabled
            //是否保持toolbar的位置不动,默認true
            //,autoFloatEnabled:true
            //浮动时工具栏距离浏览器顶部的高度，用于某些具有固定头部的頁面
            //,topOffset:30
            //編輯器底部距离工具栏高度(如果参數大于等于編輯器高度，则设置無效)
            //,toolbarTopOffset:400

            //设置远程圖片是否抓取到本地保存
            ,catchRemoteImageEnable: false //设置是否抓取远程圖片

            //pageBreakTag
            //分頁标识符,默認是_neditor_page_break_tag_
            //,pageBreakTag:'_neditor_page_break_tag_'

            //autotypeset
            //自動排版参數
            //,autotypeset: {
            //    mergeEmptyline: true,           //合并空行
            //    removeClass: true,              //去掉冗余的class
            //    removeEmptyline: false,         //去掉空行
            //    textAlign:"left",               //段落的排版方式，可以是 left,right,center,justify 去掉這個属性表示不執行排版
            //    imageBlockLine: 'center',       //圖片的浮动方式，独占一行剧中,左右浮动，默認: center,left,right,none 去掉這個属性表示不執行排版
            //    pasteFilter: false,             //根据规则过滤没事粘贴进来的内容
            //    clearFontSize: false,           //去掉所有的内嵌字号，使用編輯器默認的字号
            //    clearFontFamily: false,         //去掉所有的内嵌字体，使用編輯器默認的字体
            //    removeEmptyNode: false,         // 去掉空节点
            //    //可以去掉的標簽
            //    removeTagNames: {標簽名字:1},
            //    indent: false,                  // 行首缩进
            //    indentValue : '2em',            //行首缩进的大小
            //    bdc2sb: false,
            //    tobdc: false
            //}

            //tableDragable
            //表格是否可以拖拽
            //,tableDragable: true

            //sourceEditor
            //源码的查看方式,codemirror 是代码高亮，textarea是文本框,默認是codemirror
            //注意默認codemirror只能在ie8+和非ie中使用
            //,sourceEditor:"codemirror"
            //如果sourceEditor是codemirror，还用配置一下两個参數
            //codeMirrorJsUrl js加载的路径，默認是 URL + "third-party/codemirror/codemirror.js"
            //,codeMirrorJsUrl:URL + "third-party/codemirror/codemirror.js"
            //codeMirrorCssUrl css加载的路径，默認是 URL + "third-party/codemirror/codemirror.css"
            //,codeMirrorCssUrl:URL + "third-party/codemirror/codemirror.css"
            //編輯器初始化完成后是否进入源码模式，默認為否。
            //,sourceEditorFirst:false

            //iframeUrlMap
            //dialog内容的路径 ～会被替换成URL,垓属性一旦打開，将覆盖所有的dialog的默認路径
            //,iframeUrlMap:{
            //    'anchor':'~/dialogs/anchor/anchor.html',
            //}

            //allowLinkProtocol 允许的連接地址，有這些前缀的連接地址不会自動添加http
            //, allowLinkProtocols: ['http:', 'https:', '#', '/', 'ftp:', 'mailto:', 'tel:', 'git:', 'svn:']

            //webAppKey 百度应用的APIkey，每個站长必须首先去百度官网註冊一個key后方能正常使用app功能，註冊介绍，http://app.baidu.com/static/cms/getapikey.html
            //, webAppKey: ""

            //默認过滤规则相關配置项目
            //,disabledTableInTable:true  //禁止表格嵌套
            //,allowDivTransToP:true      //允许进入編輯器的div標簽自動變成p標簽
            //,rgb2Hex:true               //默認产出的數據中的color自動从rgb格式變成16进制格式

            // xss 过滤是否開启,inserthtml等操作
            ,
        xssFilterRules: true
            //input xss过滤
            ,
        inputXssFilter: true
            //output xss过滤
            ,
        outputXssFilter: true
            // xss过滤白名單 名單来源: https://raw.githubusercontent.com/leizongmin/js-xss/master/lib/default.js
            ,
        whitList: {
            a: ['target', 'href', 'title', 'class', 'style'],
            abbr: ['title', 'class', 'style'],
            address: ['class', 'style'],
            area: ['shape', 'coords', 'href', 'alt'],
            article: [],
            aside: [],
            audio: ['autoplay', 'controls', 'loop', 'preload', 'src', 'class', 'style'],
            b: ['class', 'style'],
            bdi: ['dir'],
            bdo: ['dir'],
            big: [],
            blockquote: ['cite', 'class', 'style'],
            br: [],
            caption: ['class', 'style'],
            center: [],
            cite: [],
            code: ['class', 'style'],
            col: ['align', 'valign', 'span', 'width', 'class', 'style'],
            colgroup: ['align', 'valign', 'span', 'width', 'class', 'style'],
            dd: ['class', 'style'],
            del: ['datetime'],
            details: ['open'],
            div: ['class', 'style'],
            dl: ['class', 'style'],
            dt: ['class', 'style'],
            em: ['class', 'style'],
            font: ['color', 'size', 'face'],
            footer: [],
            h1: ['class', 'style'],
            h2: ['class', 'style'],
            h3: ['class', 'style'],
            h4: ['class', 'style'],
            h5: ['class', 'style'],
            h6: ['class', 'style'],
            header: [],
            hr: [],
            i: ['class', 'style'],
            img: ['style', 'src', 'alt', 'title', 'width', 'height', 'id', '_src', '_url', 'loadingclass', 'class', 'data-latex'],
            ins: ['datetime'],
            li: ['class', 'style'],
            mark: [],
            nav: [],
            ol: ['class', 'style'],
            p: ['class', 'style'],
            pre: ['class', 'style'],
            s: [],
            section: [],
            small: [],
            span: ['class', 'style'],
            sub: ['class', 'style'],
            sup: ['class', 'style'],
            strong: ['class', 'style'],
            table: ['width', 'border', 'align', 'valign', 'class', 'style'],
            tbody: ['align', 'valign', 'class', 'style'],
            td: ['width', 'rowspan', 'colspan', 'align', 'valign', 'class', 'style'],
            tfoot: ['align', 'valign', 'class', 'style'],
            th: ['width', 'rowspan', 'colspan', 'align', 'valign', 'class', 'style'],
            thead: ['align', 'valign', 'class', 'style'],
            tr: ['rowspan', 'align', 'valign', 'class', 'style'],
            tt: [],
            u: [],
            ul: ['class', 'style'],
            video: ['autoplay', 'controls', 'loop', 'preload', 'src', 'height', 'width', 'class', 'style'],
            source: ['src', 'type'],
            embed: ['type', 'class', 'pluginspage', 'src', 'width', 'height', 'align', 'style', 'wmode', 'play', 'autoplay', 'loop', 'menu', 'allowscriptaccess', 'allowfullscreen', 'controls', 'preload'],
            iframe: ['src', 'class', 'height', 'width', 'max-width', 'max-height', 'align', 'frameborder', 'allowfullscreen']
        }
    };

    function getUEBasePath(docUrl, confUrl) {
        return getBasePath(
            docUrl || self.document.URL || self.location.href,
            confUrl || getConfigFilePath()
        );
    }

    function getConfigFilePath() {
        var configPath = document.getElementsByTagName("script");

        return configPath[configPath.length - 1].src;
    }

    function getBasePath(docUrl, confUrl) {
        var basePath = confUrl;

        if (/^(\/|\\\\)/.test(confUrl)) {
            basePath =
                /^.+?\w(\/|\\\\)/.exec(docUrl)[0] + confUrl.replace(/^(\/|\\\\)/, "");
        } else if (!/^[a-z]+:/i.test(confUrl)) {
            docUrl = docUrl.split("#")[0].split("?")[0].replace(/[^\\\/]+$/, "");

            basePath = docUrl + "" + confUrl;
        }

        return optimizationPath(basePath);
    }

    function optimizationPath(path) {
        var protocol = /^[a-z]+:\/\//.exec(path)[0],
            tmp = null,
            res = [];

        path = path.replace(protocol, "").split("?")[0].split("#")[0];

        path = path.replace(/\\/g, "/").split(/\//);

        path[path.length - 1] = "";

        while (path.length) {
            if ((tmp = path.shift()) === "..") {
                res.pop();
            } else if (tmp !== ".") {
                res.push(tmp);
            }
        }

        return protocol + res.join("/");
    }

    window.UE = {
        getUEBasePath: getUEBasePath
    };
})();
