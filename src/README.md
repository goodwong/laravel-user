# User\UserAuth

用户登录部分的逻辑

> 注意：本模块`依赖` User\User模块

`@TODO`

> 1. 移除对User\User的依赖



## 安装前的特别说明

> Laravel 5.4在使用第三方插件的路由规则时有问题，见
[When namespaces begin with `\` they should reset. #18078](https://github.com/laravel/framework/issues/18078)

> * 所以需要修改app/Providers/RouteServiceProvider.php文件，并且所有路由规则不能省略命名空间。

> * 同时嵌套第三方路由规则时注意外层不要包裹命名空间，例如这样：
    ```php
    // routes/web.php
    Route::group(['namespace' => 'App\\Http\\Controllers'], function () {
        William\\SomePackage\\Router::route();
    });
    // 这样是**不对的**，会导致最终调用的是
    // App\Http\Controllers\William\SomePackage\Router::route()
    ```



### 具体操作：

修改 app/Providers/RouteServiceProvider.php
```php
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    // 修改为
    protected $namespace = '';
    ...
｝
```




## 安装

1. 首先，在composer.json文件里autoload/psr-4里增加：
    ```json
    "User\\": "User/",
    ```

2. 清除缓存
    ```shell
    composer dump-autoload
    ```

3. 修改 routes/web.php，增加：
    ```php
    \User\UserAuth\Router::route();
    ```
    
    当然你也可以嵌套`prefix`、`middleware`
    ```php
    Route::group(['prefix' => '/auth'], function () {
        \User\UserAuth\Router::route();
    });
    ```
    
    但是不可以嵌套~~`namespace`~~，例如这样：
    ```php
    // 这样是错误的
    Route::group(['namespace' => 'App\\Http\\Controllers'], function () {
        \User\UserAuth\Router::route();
    });
    ```
