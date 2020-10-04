# LightCMS
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eddy8/lightCMS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eddy8/lightCMS/?branch=master)    [![StyleCI](https://github.styleci.io/repos/175428969/shield?branch=master)](https://github.styleci.io/repos/175428969)    [![Build Status](https://www.travis-ci.org/eddy8/lightCMS.svg?branch=master)](https://www.travis-ci.org/eddy8/lightCMS)    [![PHP Version](https://img.shields.io/badge/php-%3E%3D7.2-8892BF.svg)](http://www.php.net/)

## 项目简介
`lightCMS`是一个轻量级的`CMS`系统，也可以作為一个通用的后台管理框架使用。`lightCMS`集成了用户管理、權限管理、Log管理、選單管理等后台管理框架的通用功能，同时也提供模型管理、分類管理等`CMS`系统中常用的功能。`lightCMS`的**代码一键生成**功能可以快速对特定模型生成增删改查代码，极大提高開发效率。

`lightCMS`基于`Laravel 6.x`開发，前端框架基于`layui`。

演示站点：[LightCMS Demo](http://lightcms.bituier.com/admin/login)。登入信息：admin/admin。请勿存储/删除重要數據，資料庫会定时重設。

`LightCMS&Laravel`学习交流QQ群：**972796921**

版本库分支说明：

分支名稱 | Laravel版本 | 备注
:-: | :-: | :-:
master    |   6.x | 建议使用
8.x    |   8.x |
7.x    |   7.x |
5.5    |   5.5 |

## 功能点一览
后台：
* 基于`RBAC`的權限管理
* 管理員、Log、選單管理
* 分類管理
* 標簽管理
* 配置管理
* 模型、模型字段、模型内容管理（后台可自定义业务模型，方便垂直行业快速開发）
* 會員管理
* 評論管理
* 基于Tire算法的敏感詞过滤系统
* 普通模型增删改查代码一键生成

前台：
* 用户註冊登入（包括微信、QQ、微博三方登入）
* 模型内容详情頁、列表頁
* 評論相关

更多功能待你发现~

## 后台预览
![首頁](https://user-images.githubusercontent.com/2555476/54804611-16fa4900-4caf-11e9-885e-7f5c0dac7ce4.png)

![系统管理](https://user-images.githubusercontent.com/2555476/54804599-0ea20e00-4caf-11e9-8d10-526aca358916.png)

## 系统环境
`linux/windows & nginx/apache/iis & mysql 5.5+ & php 7.2+`

* PHP >= 7.2.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

**注意事项**

* 如果缓存、队列、session用的是 redis 驱动，那还需要安装 redis 和 php redis 扩展
* 如果`PHP`安装了`opcache`扩展，请启用`opcache.save_comments`和`opcache.load_comments`配置（默認是启用的），否则無法正常使用[選單自動获取](#選單自動获取)功能

## 系统部署

### 获取代码并安装依赖
首先请确保系统已安装好[composer](https://getcomposer.org/)。国内用户建议先[设置 composer 镜像](https://developer.aliyun.com/composer)，避免安装过程缓慢。
```bash
cd /data/www
git clone git_repository_url
cd lightCMS
composer install
```
### 系统配置并初始化
设置目入權限：`storage/`和`bootstrap/cache/`目入需要写入權限。
```bash
# 此处權限设置為777只是為了演示操作方便，实际只需要给Web服務器写入權限即可
sudo chmod 777 -R storage/ bootstrap/cache/
```
新建一份环境配置，并配置好資料庫等相关配置:
```base
cp .env.example .env
```
初始化系统：
```base
php artisan migrate --seed
```

### 配置Web服務器（此处以`Nginx`為例）
```
server {
    listen 80;
    server_name light.com;
    root /data/www/lightCMS/public;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #不同配置对应不同的环境配置文件。比如此处应用会加载.env.pro文件，默認不配置会加载.env文件。此处可根据项目需要自行配制。
        #fastcgi_param   APP_ENV pro;
        include fastcgi_params;
    }
}
```

### 後台登入
后台访问地址：`/admin/login`

默認用户（此用户為超级用户，不受權限管理限制）：admin/admin

## 權限管理
基于角色的權限管理。只需新建好角色，给对应的角色分配好相应的權限，最后给用户指定角色即可。`lightCMS`中權限的概念其实就是選單，一条選單对应一个`laravel`的路由，也就是一个具体的操作。

### 選單自動获取
只需要按约定方式写好指定路由的控制器注譯，则可在[選單管理](/admin/menus)頁面自動添加/更新对应的選單信息。例如：
```php
/**
 * 角色管理-角色列表
 *
 * 取方法的第一行注譯作為選單的名稱、分组名。注譯格式：分组名稱-選單名稱。
 * 未写分组名稱，则直接作為選單名稱，分组名為空。
 * 未写注譯则選用uri作為選單名，分组名為空。
 */
public function index()
{
    $this->breadcrumb[] = ['title' => '角色列表', 'url' => ''];
    return view('admin.role.index', ['breadcrumb' => $this->breadcrumb]);
}
```

需要注意的是，程序可以自動获取選單，但是選單的层级关系还是需要在后台手动配置的。

## 配置管理
首先需要将`config/light.php`配置文件中的`light_config`设置為`true`：

然后只需在[配置管理](/admin/configs)頁面新增配置项或編輯已存在配置项，则在应用中可以直接使用`laravel`的配置获取函數`config`获取指定配置，例如：
```php
// 获取 key 為 SITE_NAME 的配置项值
$siteName = config('light_config.SITE_NAME');
```
也可以直接调用全局函數`function getConfig($key, $default = null)`获取配置。

## 標簽管理
模型内容**打標簽**是站点的一项常用功能，`lightCMS`内置了打標簽功能。添加模型字段时選擇表單類型為`標簽输入框`即可。

`lightCMS`采用中间表（content_tags）来实现標簽和模型内容的多对多关联关系。

## 模型管理
`lightCMS`支持在后台直接创建模型，并可对模型的表字段进行自定义设置。设置完模型字段后，就不需要做其它工作了，模型的增删改查功能系统已经内置。

> 小提示：如果需要对单独的模型进行權限控制，可以在模型管理頁面点击`添加默認選單`，系统会自動建立好相应模型的相关選單项。

这里说明下模型的表單验证及編輯的保存和更新处理。如果有自定义表單验证需求，只需在`app/Http/Request/Admin/Entity`目入下创建模型的表單请求验证类即可。类名的命名规则：**模型名+Request**。例如`User`模型对应的表單请求验证类為`UserRequest`。

如果想自定义模型的新增/編輯前端模板，只需在`app/resources/views/admin/content`目入下创建模板文件即可。模板文件的命名需遵循如下命名规则：**模型名_add.blade.php**。例如`User`模型对应的模板文件名為`user_add.blade.php`。

如果想自定义模型的保存和更新处理逻辑，只需在`app/Http/Controllers/Admin/Entity`目入下创建模型的控制器类即可，`save`和`update`方法实现可参考`app/Http/Controllers/Admin/ContentController`。类名的命名规则：**模型名+Controller**。例如`User`模型对应的控制器类為`UserController`。同理，如果想自定义列表頁，按上述规则定义`index`和`list`方法即可。

另外，模型内容在新增、更新、删除时系统会触发相应的事件，你可以监听这些事件做相应的业务处理。下表所示為相应的事件说明：

事件名 | 事件参數 | 触发時間 | 备注
:-: | :-: | :-: | :-:
App\Events\ContentCreating    |   Illuminate\Http\Request $request, App\Model\Admin\Entity $entity |  新增内容前  |
App\Events\ContentCreated    |   App\Model\Admin\Content $content, App\Model\Admin\Entity $entity |  新增内容后  |
App\Events\ContentUpdating    |   Illuminate\Http\Request $request, App\Model\Admin\Entity $entity |  更新内容前  |
App\Events\ContentUpdated    |   Array $id, App\Model\Admin\Entity $entity |  更新内容后  | $id 為更新内容的 ID 合集
App\Events\ContentDeleted    |   Illuminate\Support\Collection $contents, App\Model\Admin\Entity $entity |  删除内容后  | $contents 為被删除内容的 App\Model\Admin\Content 对象合集

### 模型字段表單類型相关说明
对于支持远程搜索的`select`表單類型，編輯 API 搜索接口需返回的數據格式如下所示。code為0时, 表示正常, 反之异常。
```json
{
    "code": 0,
    "msg": "success",
    "data": [
        {"name":"北京","value":1,"selected":"","disabled":""},
        {"name":"上海","value":2,"selected":"","disabled":""},
        {"name":"广州","value":3,"selected":"selected","disabled":""},
        {"name":"深圳","value":4,"selected":"","disabled":"disabled"},
        {"name":"天津","value":5,"selected":"","disabled":""}
    ]
}
```

对于短文本（input，自動完成）表單類型，編輯 API 接口需返回的數據格式如下所示：
```json
{
    "suggestions": [
        "cms",
        "cms是什么意思啊",
        "cms是指的什么意思啊",
        "cm是什么单位",
        "沉默是金",
        "cm是厘米还是分米",
        "cm是什么",
        "cm是什么意思啊",
        "cm是什么意思单位",
        "cm是什么单位的名稱"
    ]
}
```

对于`select`多選類型表單，默認資料庫保存值為半角逗号分隔的多个選擇值。當你设置字段類型為無符号整型时，資料庫会保存多个選擇值的求和值（當然前提是選擇值都是整型數據）。

### 搜索字段（$searchField）配置说明
通过配置搜索字段，可以很方便的在模型的列表頁展示搜索项。如下是一个示例配置：
```php
    public static $searchField = [
        'name' => '用户名', // input搜索類型。key 為字段名稱，value 為標題
        'status' => [ // key 為字段名稱，value 為相关配置
            'showType' => 'select', // 下拉框選擇搜索類型
            'searchType' => '=', // 说明字段在資料庫的搜索匹配方式，默認為like查询
            'title' => '状态', // 標題
            'enums' => [ // select下拉搜索项
                0 => '禁用',
                1 => '启用',
            ],
        ],
        'recommend' => [ // key 為字段名稱，value 為相关配置
            'showType' => 'select', // 下拉框選擇搜索類型
            'searchType' => 'whereRaw', // 对于一些特殊的查询条件，無法通过上述普通的搜索匹配值来实现时，可将此值设置為 whereRaw
            'searchCondition' => 'recommend & ? = ?', // 与 whereRaw 配合使用，? 表示查询条件值参數绑定。例：如果用户输入的查询值為 2，则最终生成的 sql 查询条件是： recommend & 2 = 2
            'title' => '推荐位', // 標題
            'enums' => [ // select下拉搜索项
                1 => '推荐位1',
                2 => '推荐位2',
                4 => '推荐位3',
            ],
        ],
        'created_at' => [ // key 為字段名稱，value 為相关配置
            'showType' => 'datetime', // 日期時間搜索類型
            'title' => '创建時間' // 標題
        ]
    ];
```

### 列表字段（$listField）配置说明
通过配置列表字段，可以很方便的在模型的列表頁展示列表项。如下是一个示例配置：
```php
    public static $listField = [
        // pid 是列表字段名（不一定是模型資料庫表的字段名，只要列表數據接口返回數據包含该字段即可）;title、width、sort 等属性参考 layui 的 table 组件表头参數配置即可
        'pid' => ['title' => '父ID', 'width' => 80],
        'entityName' => ['title' => '模型', 'width' => 100],
        'userName' => ['title' => '用户名', 'width' => 100],
        'content' => ['title' => '内容', 'width' => 400],
        'reply_count' => ['title' => '回复數', 'width' => 80, 'sort' => true],
        'like' => ['title' => '喜欢', 'width' => 80, 'sort' => true],
        'dislike' => ['title' => '不喜欢', 'width' => 80, 'sort' => true],
    ];
```

### 列表操作项（$actionField）配置说明
通过配置列表操作项，可以很方便的在模型的列表頁操作列添加自定义链接。如下是一个示例配置：
```php
    public static $actionField = [
        // chapterUrl 是字段名（不一定是模型資料庫表的字段名，只要列表數據接口返回數據包含该字段即可）
        'chapterUrl' => ['title' => '章节', 'description' => '當前小说的所有章节'],
    ];
```

### 排序字段（$sortFields）配置说明
通过配置排序字段，可以很方便的在模型的列表頁自定义數據的排序规则。如下是一个示例配置：
```php
    public static $actionField = [
        // 數组的键為排序字段名和升序/降序配置（半角逗号分隔），值為前台展示名稱
        'updated_at,desc' => '更新時間（降序）',
        'id,asc' => 'id（升序）',
    ];
```

> 小提示：如果你是自定义模型，建议自定义模型继承`App\Model\Admin\Model`模型，方便对上述配置项进行自定义。

## 系统Log
`lightCMS`集成了一套简单的Log系统，默認情况下记入后台的所有操作相关信息，具体实现可以参考`Log`中间件。

可以利用`Laravel`的[任务调度](https://laravel.com/docs/5.8/scheduling#introduction)来自動清理系统Log。启用任务调度需要在系统的计划任务中添加如下内容：
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

可以通过配置`log_async_write`项来决定是否啟用异步写入Log（默認未启用），异步写入Log需要运行`Laravel`的[队列处理器](https://laravel.com/docs/5.8/queues#running-the-queue-worker)：
```bash
php artisan queue:work
```

## 代码一键生成
对于一个普通的模型，管理後台通常有增删改查相关的业务需求。如果系统模型管理自带的增删改查功能無法满足你的个性化需求，你可以使用一键生成代码功能。`lightCMS`拥有一键生成相关代码的能力，在建好模型的資料庫表结構后，可以使用如下`artisan`命令生成相关代码：
```bash
# config 為模型名稱 配置 為模型中文名稱
php artisan light:basic config 配置
```
成功執行完成后，会创建如下文件（注意：相关目入需要有写入權限）：

* routes/auto/config.php
路由：包含模型增删改查相关路由，应用会自動加载`routes/auto/`目入下的路由。
* app/Model/Admin/Config.php
模型：[$searchField](#搜索字段searchField配置说明) 属性用来配置搜索字段，[$listField](#列表字段listfield配置说明) 用来配置列表视圖中需要展示哪些字段數據。
* app/Repository/Admin/ConfigRepository.php
模型服务层：默認有一个`list`方法，该方法用来返回列表數據。需要注意的是如果列表中的數據不能和資料庫字段數據直接对应，则可对資料庫字段數據做相应转换，可参考`list`方法中的`transform`部分。
* app/Http/Controllers/Admin/ConfigController.php
控制器：默認有一个`$formNames`属性，用来配置新增/編輯表單请求字段的白名单。此属性必需配置，否则获取不到表單數據。参考 [request 对象的 only 方法](https://laravel.com/docs/5.5/requests#retrieving-input)
* app/Http/Requests/Admin/ConfigRequest.php
表單请求类：可在此类中编写表單验证规则，参考 [Form Request Validation](https://laravel.com/docs/5.5/validation#form-request-validation)
* resources/views/admin/config/index.blade.php
列表视圖：列表數據、搜索表單。
* resources/views/admin/config/index.blade.php
新增/編輯视圖：只列出了基本架構，需要自定义相关字段的表單展示。参考 [layui form](https://www.layui.com/doc/element/form.html)

最后，如果想让生成的路由展示在選單中，只需在[選單管理](/admin/menus)頁面点击**自動更新選單**即可。

## 敏感詞检测
如果需要对发表的内容（文章、評論等）进行内容审查，则可直接调用`LightCMS`提供的`checkSensitiveWords`函數即可。示例如下：
```php
$result = checkSensitiveWords('出售正品枪支');
print_r($result);
/*
[
    "售 出售 枪",
    "正品枪支"
]
*/
```

## 圖片上傳
LightCMS中圖片默認上傳到本地服务器。如果有自定义需求，比如上傳到三方云服务器，可参考`config/light.php`配置文件中的`image_upload`配置项说明，自定义处理类需要实现`App\Contracts\ImageUpload`接口，方法的返回值數據结構和系统原方法保持一致即可。
```json
{
    "code": 200,
    "state": "SUCCESS",
    "msg": "",
    "url": "xxx"
}
```

## 系统核心函數、方法说明
做这个说明的主要目的是让開发者了解一些核心功能，方便自定义各类功能開发。毕竟框架是不可能代劳所有事情滴^_

方法名稱：App\Repository\Admin\CategoryRepository::tree()

功能说明：

返回分類的树结構信息。數據结構可以参考下圖所示：

![tree](https://user-images.githubusercontent.com/2555476/62991339-d7acde80-be81-11e9-9811-9d4d27e01f07.png)

此數據结構基本包含了分類的所有结構化信息。相关字段的含义也比较清楚，此处只对`path`字段做下说明：该字段是指當前分類的所有上级分類链，这样可以很方便的知道某个分類的所有父级分類。比如圖中的`test`分類的path字段值為`[1, 2]`，那么很容易的知道它的父级分類是：游戏 射击

## 前台相关
### 用户註冊登入
`LightCMS`集成了一套简单的用户註冊登入系统，支持微信、QQ、微博三方登入。三方登入相关配置请参考`config/light.php`。

## TODO
* 模版管理+模版標簽

## 完善中。。。

## 说明
有问题可以提 issue ，為项目贡献代码可以提 pull request
