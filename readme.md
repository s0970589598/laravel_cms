# LightCMS
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eddy8/lightCMS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eddy8/lightCMS/?branch=master)    [![StyleCI](https://github.styleci.io/repos/175428969/shield?branch=master)](https://github.styleci.io/repos/175428969)    [![Build Status](https://www.travis-ci.org/eddy8/lightCMS.svg?branch=master)](https://www.travis-ci.org/eddy8/lightCMS)    [![PHP Version](https://img.shields.io/badge/php-%3E%3D7.2-8892BF.svg)](http://www.php.net/)

## 项目簡介
`lightCMS`是一個輕量級的`CMS`係统，也可以作為一個通用的後台管理框架使用。`lightCMS`集成了用户管理、權限管理、Log管理、選單管理等後台管理框架的通用功能，同時也提供模型管理、分類管理等`CMS`係统中常用的功能。`lightCMS`的**代碼一鍵生成**功能可以快速對特定模型生成增刪改查代碼，極大提高開發效率。

`lightCMS`基於`Laravel 6.x`開發，前端框架基於`layui`。

演示站點：[LightCMS Demo](http://lightcms.bituier.com/admin/login)。登入信息：admin/admin。請勿存儲/刪除重要數據，資料庫會定時重設。

`LightCMS&Laravel`學習交流QQ群：**972796921**

版本庫分支說明：

分支名稱 | Laravel版本 | 備註
:-: | :-: | :-:
master    |   6.x | 建議使用
8.x    |   8.x |
7.x    |   7.x |
5.5    |   5.5 |

## 功能點一覽
後台：
* 基於`RBAC`的權限管理
* 管理員、Log、選單管理
* 分類管理
* 標簽管理
* 配置管理
* 模型、模型字段、模型内容管理（後台可自定義業務模型，方便垂直行業快速開發）
* 會員管理
* 評論管理
* 基於Tire算法的敏感詞過濾係统
* 普通模型增刪改查代碼一鍵生成

前台：
* 用户註冊登入（包括微信、QQ、微博三方登入）
* 模型内容詳情頁、列表頁
* 評論相關

更多功能待你發现~

## 後台预覽
![首頁](https://user-images.githubusercontent.com/2555476/54804611-16fa4900-4caf-11e9-885e-7f5c0dac7ce4.png)

![係统管理](https://user-images.githubusercontent.com/2555476/54804599-0ea20e00-4caf-11e9-8d10-526aca358916.png)

## 係统環境
`linux/windows & nginx/apache/iis & mysql 5.5+ & php 7.2+`

* PHP >= 7.2.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

**注意事项**

* 如果缓存、隊列、session用的是 redis 驅動，那還需要安装 redis 和 php redis 擴展
* 如果`PHP`安装了`opcache`擴展，請啟用`opcache.save_comments`和`opcache.load_comments`配置（默認是啟用的），否則無法正常使用[選單自動獲取](#選單自動獲取)功能

## 係统部署

### 獲取代碼並安装依赖
首先請確保係统已安装好[composer](https://getcomposer.org/)。國内用户建議先[設置 composer 鏡像](https://developer.aliyun.com/composer)，避免安装過程缓慢。
```bash
cd /data/www
git clone git_repository_url
cd lightCMS
composer install
```
### 係统配置並初始化
設置目入權限：`storage/`和`bootstrap/cache/`目入需要寫入權限。
```bash
# 此處權限設置為777只是為了演示操作方便，實際只需要给Web服務器寫入權限即可
sudo chmod 777 -R storage/ bootstrap/cache/
```
新建一份環境配置，並配置好資料庫等相關配置:
```base
cp .env.example .env
```
初始化係统：
```base
php artisan migrate --seed
```

### 配置Web服務器（此處以`Nginx`為例）
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
        #不同配置對應不同的環境配置文件。比如此處應用會加戴.env.pro文件，默認不配置會加戴.env文件。此處可根據项目需要自行配制。
        #fastcgi_param   APP_ENV pro;
        include fastcgi_params;
    }
}
```

### 後台登入
後台訪問地址：`/admin/login`

默認用户（此用户為超級用户，不受權限管理限制）：admin/admin

## 權限管理
基於角色的權限管理。只需新建好角色，给對應的角色分配好相應的權限，最後给用户指定角色即可。`lightCMS`中權限的概念其實就是選單，一條選單對應一個`laravel`的路由，也就是一個具體的操作。

### 選單自動獲取
只需要按约定方式寫好指定路由的控制器注譯，則可在[選單管理](/admin/menus)頁面自動添加/更新對應的選單信息。例如：
```php
/**
 * 角色管理-角色列表
 *
 * 取方法的第一行注譯作為選單的名稱、分组名。注譯格式：分组名稱-選單名稱。
 * 未寫分组名稱，則直接作為選單名稱，分组名為空。
 * 未寫注譯則選用uri作為選單名，分组名為空。
 */
public function index()
{
    $this->breadcrumb[] = ['title' => '角色列表', 'url' => ''];
    return view('admin.role.index', ['breadcrumb' => $this->breadcrumb]);
}
```

需要注意的是，程序可以自動獲取選單，但是選單的層級關係還是需要在後台手動配置的。

## 配置管理
首先需要將`config/light.php`配置文件中的`light_config`設置為`true`：

然後只需在[配置管理](/admin/configs)頁面新增配置项或編輯已存在配置项，則在應用中可以直接使用`laravel`的配置獲取函數`config`獲取指定配置，例如：
```php
// 獲取 key 為 SITE_NAME 的配置项值
$siteName = config('light_config.SITE_NAME');
```
也可以直接调用全局函數`function getConfig($key, $default = null)`獲取配置。

## 標簽管理
模型内容**打標簽**是站點的一项常用功能，`lightCMS`内置了打標簽功能。添加模型字段時選擇表單類型為`標簽输入框`即可。

`lightCMS`採用中間表（content_tags）来實现標簽和模型内容的多對多關聯關係。

## 模型管理
`lightCMS`支持在後台直接創建模型，並可對模型的表字段進行自定義設置。設置完模型字段後，就不需要做其它工作了，模型的增刪改查功能係统已經内置。

> 小提示：如果需要對單獨的模型進行權限控制，可以在模型管理頁面點擊`添加默認選單`，係统會自動建立好相應模型的相關選單项。

這里說明下模型的表單驗證及編輯的保存和更新處理。如果有自定義表單驗證需求，只需在`app/Http/Request/Admin/Entity`目入下創建模型的表單請求驗證類即可。類名的命名规則：**模型名+Request**。例如`User`模型對應的表單請求驗證類為`UserRequest`。

如果想自定義模型的新增/編輯前端模板，只需在`app/resources/views/admin/content`目入下創建模板文件即可。模板文件的命名需遵循如下命名规則：**模型名_add.blade.php**。例如`User`模型對應的模板文件名為`user_add.blade.php`。

如果想自定義模型的保存和更新處理逻辑，只需在`app/Http/Controllers/Admin/Entity`目入下創建模型的控制器類即可，`save`和`update`方法實现可参考`app/Http/Controllers/Admin/ContentController`。類名的命名规則：**模型名+Controller**。例如`User`模型對應的控制器類為`UserController`。同理，如果想自定義列表頁，按上述规則定義`index`和`list`方法即可。

另外，模型内容在新增、更新、刪除時係统會觸發相應的事件，你可以監聽這些事件做相應的業務處理。下表所示為相應的事件說明：

事件名 | 事件参數 | 觸發時間 | 備註
:-: | :-: | :-: | :-:
App\Events\ContentCreating    |   Illuminate\Http\Request $request, App\Model\Admin\Entity $entity |  新增内容前  |
App\Events\ContentCreated    |   App\Model\Admin\Content $content, App\Model\Admin\Entity $entity |  新增内容後  |
App\Events\ContentUpdating    |   Illuminate\Http\Request $request, App\Model\Admin\Entity $entity |  更新内容前  |
App\Events\ContentUpdated    |   Array $id, App\Model\Admin\Entity $entity |  更新内容後  | $id 為更新内容的 ID 合集
App\Events\ContentDeleted    |   Illuminate\Support\Collection $contents, App\Model\Admin\Entity $entity |  刪除内容後  | $contents 為被刪除内容的 App\Model\Admin\Content 對象合集

### 模型字段表單類型相關說明
對於支持遠程搜索的`select`表單類型，編輯 API 搜索接口需返回的數據格式如下所示。code為0時, 表示正常, 反之異常。
```json
{
    "code": 0,
    "msg": "success",
    "data": [
        {"name":"北京","value":1,"selected":"","disabled":""},
        {"name":"上海","value":2,"selected":"","disabled":""},
        {"name":"廣州","value":3,"selected":"selected","disabled":""},
        {"name":"深圳","value":4,"selected":"","disabled":"disabled"},
        {"name":"天津","value":5,"selected":"","disabled":""}
    ]
}
```

對於短文本（input，自動完成）表單類型，編輯 API 接口需返回的數據格式如下所示：
```json
{
    "suggestions": [
        "cms",
        "cms是什麼意思啊",
        "cms是指的什麼意思啊",
        "cm是什麼單位",
        "沉默是金",
        "cm是厘米還是分米",
        "cm是什麼",
        "cm是什麼意思啊",
        "cm是什麼意思單位",
        "cm是什麼單位的名稱"
    ]
}
```

對於`select`多選類型表單，默認資料庫保存值為半角逗號分隔的多個選擇值。當你設置字段類型為無符號整型時，資料庫會保存多個選擇值的求和值（當然前提是選擇值都是整型數據）。

### 搜索字段（$searchField）配置說明
通過配置搜索字段，可以很方便的在模型的列表頁展示搜索项。如下是一個示例配置：
```php
    public static $searchField = [
        'name' => '用户名', // input搜索類型。key 為字段名稱，value 為標題
        'status' => [ // key 為字段名稱，value 為相關配置
            'showType' => 'select', // 下拉框選擇搜索類型
            'searchType' => '=', // 說明字段在資料庫的搜索匹配方式，默認為like查尋
            'title' => '狀態', // 標題
            'enums' => [ // select下拉搜索项
                0 => '禁用',
                1 => '啟用',
            ],
        ],
        'recommend' => [ // key 為字段名稱，value 為相關配置
            'showType' => 'select', // 下拉框選擇搜索類型
            'searchType' => 'whereRaw', // 對於一些特殊的查尋條件，無法通過上述普通的搜索匹配值来實现時，可將此值設置為 whereRaw
            'searchCondition' => 'recommend & ? = ?', // 与 whereRaw 配合使用，? 表示查尋條件值参數绑定。例：如果用户输入的查尋值為 2，則最终生成的 sql 查尋條件是： recommend & 2 = 2
            'title' => '推荐位', // 標題
            'enums' => [ // select下拉搜索项
                1 => '推荐位1',
                2 => '推荐位2',
                4 => '推荐位3',
            ],
        ],
        'created_at' => [ // key 為字段名稱，value 為相關配置
            'showType' => 'datetime', // 日期時間搜索類型
            'title' => '創建時間' // 標題
        ]
    ];
```

### 列表字段（$listField）配置說明
通過配置列表字段，可以很方便的在模型的列表頁展示列表项。如下是一個示例配置：
```php
    public static $listField = [
        // pid 是列表字段名（不一定是模型資料庫表的字段名，只要列表數據接口返回數據包含该字段即可）;title、width、sort 等屬性参考 layui 的 table 组件表頭参數配置即可
        'pid' => ['title' => '父ID', 'width' => 80],
        'entityName' => ['title' => '模型', 'width' => 100],
        'userName' => ['title' => '用户名', 'width' => 100],
        'content' => ['title' => '内容', 'width' => 400],
        'reply_count' => ['title' => '回複數', 'width' => 80, 'sort' => true],
        'like' => ['title' => '喜欢', 'width' => 80, 'sort' => true],
        'dislike' => ['title' => '不喜欢', 'width' => 80, 'sort' => true],
    ];
```

### 列表操作项（$actionField）配置說明
通過配置列表操作项，可以很方便的在模型的列表頁操作列添加自定義連接。如下是一個示例配置：
```php
    public static $actionField = [
        // chapterUrl 是字段名（不一定是模型資料庫表的字段名，只要列表數據接口返回數據包含该字段即可）
        'chapterUrl' => ['title' => '章節', 'description' => '當前小說的所有章節'],
    ];
```

### 排序字段（$sortFields）配置說明
通過配置排序字段，可以很方便的在模型的列表頁自定義數據的排序规則。如下是一個示例配置：
```php
    public static $actionField = [
        // 數组的鍵為排序字段名和升序/降序配置（半角逗號分隔），值為前台展示名稱
        'updated_at,desc' => '更新時間（降序）',
        'id,asc' => 'id（升序）',
    ];
```

> 小提示：如果你是自定義模型，建議自定義模型繼承`App\Model\Admin\Model`模型，方便對上述配置项進行自定義。

## 係统Log
`lightCMS`集成了一套簡單的Log係统，默認情况下记入後台的所有操作相關信息，具體實现可以参考`Log`中間件。

可以利用`Laravel`的[任務调度](https://laravel.com/docs/5.8/scheduling#introduction)来自動清理係统Log。啟用任務调度需要在係统的计畫任務中添加如下内容：
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

可以通過配置`log_async_write`项来决定是否啟用異步寫入Log（默認未啟用），異步寫入Log需要運行`Laravel`的[隊列處理器](https://laravel.com/docs/5.8/queues#running-the-queue-worker)：
```bash
php artisan queue:work
```

## 代碼一鍵生成
對於一個普通的模型，管理後台通常有增刪改查相關的業務需求。如果係统模型管理自带的增刪改查功能無法满足你的個性化需求，你可以使用一鍵生成代碼功能。`lightCMS`擁有一鍵生成相關代碼的能力，在建好模型的資料庫表结構後，可以使用如下`artisan`命令生成相關代碼：
```bash
# config 為模型名稱 配置 為模型中文名稱
php artisan light:basic config 配置
```
成功執行完成後，會創建如下文件（注意：相關目入需要有寫入權限）：

* routes/auto/config.php
路由：包含模型增刪改查相關路由，應用會自動加戴`routes/auto/`目入下的路由。
* app/Model/Admin/Config.php
模型：[$searchField](#搜索字段searchField配置說明) 屬性用来配置搜索字段，[$listField](#列表字段listfield配置說明) 用来配置列表視圖中需要展示哪些字段數據。
* app/Repository/Admin/ConfigRepository.php
模型服務層：默認有一個`list`方法，该方法用来返回列表數據。需要注意的是如果列表中的數據不能和資料庫字段數據直接對應，則可對資料庫字段數據做相應轉换，可参考`list`方法中的`transform`部分。
* app/Http/Controllers/Admin/ConfigController.php
控制器：默認有一個`$formNames`屬性，用来配置新增/編輯表單請求字段的白名單。此屬性必需配置，否則獲取不到表單數據。参考 [request 對象的 only 方法](https://laravel.com/docs/5.5/requests#retrieving-input)
* app/Http/Requests/Admin/ConfigRequest.php
表單請求類：可在此類中编寫表單驗證规則，参考 [Form Request Validation](https://laravel.com/docs/5.5/validation#form-request-validation)
* resources/views/admin/config/index.blade.php
列表視圖：列表數據、搜索表單。
* resources/views/admin/config/index.blade.php
新增/編輯視圖：只列出了基本架構，需要自定義相關字段的表單展示。参考 [layui form](https://www.layui.com/doc/element/form.html)

最後，如果想讓生成的路由展示在選單中，只需在[選單管理](/admin/menus)頁面點擊**自動更新選單**即可。

## 敏感詞检测
如果需要對發表的内容（文章、評論等）進行内容審查，則可直接调用`LightCMS`提供的`checkSensitiveWords`函數即可。示例如下：
```php
$result = checkSensitiveWords('出售正品槍支');
print_r($result);
/*
[
    "售 出售 槍",
    "正品槍支"
]
*/
```

## 圖片上傳
LightCMS中圖片默認上傳到本地服務器。如果有自定義需求，比如上傳到三方雲服務器，可参考`config/light.php`配置文件中的`image_upload`配置项說明，自定義處理類需要實现`App\Contracts\ImageUpload`接口，方法的返回值數據结構和係统原方法保持一致即可。
```json
{
    "code": 200,
    "state": "SUCCESS",
    "msg": "",
    "url": "xxx"
}
```

## 係统核心函數、方法說明
做這個說明的主要目的是讓開發者了解一些核心功能，方便自定義各類功能開發。畢竟框架是不可能代勞所有事情^_

方法名稱：App\Repository\Admin\CategoryRepository::tree()

功能說明：

返回分類的樹结構信息。數據结構可以参考下圖所示：

![tree](https://user-images.githubusercontent.com/2555476/62991339-d7acde80-be81-11e9-9811-9d4d27e01f07.png)

此數據结構基本包含了分類的所有结構化信息。相關字段的含義也比较清楚，此處只對`path`字段做下說明：该字段是指當前分類的所有上級分類連，這樣可以很方便的知道某個分類的所有父級分類。比如圖中的`test`分類的path字段值為`[1, 2]`，那麼很容易的知道它的父級分類是：游戲 射擊

## 前台相關
### 用户註冊登入
`LightCMS`集成了一套簡單的用户註冊登入係统，支持微信、QQ、微博三方登入。三方登入相關配置請参考`config/light.php`。

## TODO
* 模版管理+模版標簽

## 完善中。。。

## 說明
有問题可以提 issue ，為项目贡献代碼可以提 pull request
