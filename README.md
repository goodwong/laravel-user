# Laravel 5 User

将用户独立出一个模块，以提高代码可复用性。

> 本模块除Laravel本身外，`不依赖`其它模块。



## 安装

1. 通过composer安装
    ```shell
    composer require goodwong/laravel-user
    ```

2. 修改config/auth.php：
    ```php
    App\User::class,
    
    // 修改为
    Goodwong\LaravelUser\Entities\User::class,
    ```

3. 同样修改config/services.php：
    ```php
    App\User::class,
    
    // 修改为
    Goodwong\LaravelUser\Entities\User::class,
    ```


## 使用

1. 查询用户
    ```php
    // User 继承自Eloquent
    $user = Goodwong\LaravelUser\Entities\User::find($user_id);
    $users = Goodwong\LaravelUser\Entities\User::get();
    ```
    > ** 注意：** 不要使用Eloquent方式创建用户

2. 通过`Goodwong\LaravelUser\Handlers\UserHandler`创建用户
    ```php
    $userHandler = app('Goodwong\LaravelUser\Handlers\UserHandler');
    $attributes = [
        'name' => 'User Name',
        'email' => 'email', // unique, 可以使用任意字符串，只要保证唯一
        'password' => 'xxxx' // raw password, optional
    ];
    $user = $userHandler->create($attributes);
    ```

3. 通过`Goodwong\LaravelUser\Handlers\AuthHandler`登录用户
    ```php
    $authHandler = app('Goodwong\LaravelUser\Handlers\AuthHandler');
    $authHandler->login($user);
    ~~$success = $authHandler->attempt($credentials);~~ // 暂未实现
    ```
    > ** 注意：** 不要使用`Auth::login($user);`，这样得不到事件通知


## 事件

- `UserCreated` 创建用户触发

- `UserAuthorized` 用户登录系统触发




## 安装路由规则

### 安装路由规则前的特别说明

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


#### 具体修改：

1. 修改 app/Providers/RouteServiceProvider.php
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

### 配置路由规则

1. 修改 routes/web.php，增加：
    ```php
    \Goodwong\LaravelUser\Router::route();
    ```
    
    当然你也可以嵌套`prefix`、`middleware`
    ```php
    Route::group(['prefix' => '/auth'], function () {
        \Goodwong\LaravelUser\Router::route();
    });
    ```
    
    但是不可以嵌套~~`namespace`~~，例如这样：
    ```php
    // 这样是错误的
    Route::group(['namespace' => 'App\\Http\\Controllers'], function () {
        \Goodwong\LaravelUser\Router::route();
    });
    ```
    
## ROADMAP

1. 增加更多事件

    - `UserLogouted`

2. 注册用户

3. 管理用户

4. 支持非cookie的登录方案（用于app、微信小程序）



