## Aurora (PHP Framework)

**想要丧心病狂的极限性能？**

**Looking for extremely high performance solution? This is it.**

Aurora 是一个建立在 [Lightning](https://github.com/zxz054321/lightning) 之上的高性能高并发框架，专为丧心病狂的极限性能打造。她适用于需要支持高并发的场景，如API 接口、微服务等。

Aurora is a high performance and high concurrency framework that sits on top of Lightning. It's built for frenzied performance, and applies to the need to support high concurrency scenarios, such as API interfaces, micro-services.

### 亮点 Features

 - 为高性能高并发而生
 - Optimized for high performance and high concurrency
 - 魚*（优雅）*和熊掌*（性能）*亦可兼得
 - Maintaining elegance without sacrificing performance
 - 现代化工具，奇妙的开发之旅
 - Modern toolkit, pinch of magic
 - 来自 Laravel 的数据迁移器和结构生成器
 - Laravel's database agnostic migrations and schema builder
 - 实用的辅助函数
 - Useful helper functions
 - *有时间再写……*
 - *More to write...*

### 环境要求 Requirements

- PHP >= 5.5
- Phalcon PHP Extension
- Swoole PHP Extension

### 用法 Usage

使用命令行启动 Aurora 服务

Use the command to start Aurora server

    php console fly

### 文档 Documentation

**安装 Installation**

Aurora 使用 Composer 来管理依赖包。因此，在使用之前，请确保你已经安装了 Composer ，然后执行命令：

Aurora utilizes Composer to manage its dependencies. So, before using Aurora, make sure you have Composer installed, and execute the following command:

    composer install

**应用配置 Application Configuration**

Aurora 框架所用的配置文件存放在 config 目录下，请通读配置文件以熟悉可用的配置项。

All of the configuration files for the Aurora framework are stored in the config directory. Feel free to look through the files and get familiar with the options available to you.

**环境配置 Environment Configuration**

通常应用程序需要根据不同的运行环境加载不同的配置信息。例如，你可能希望本机开发环境与生产服务器环境使用不同的缓存驱动。通过环境配置文件，就可以轻松完成。

It is often helpful to have different configuration values based on the environment the application is running in. For example, you may wish to use a different cache driver locally than you do on your production server. It's easy using environment based configuration.

为了简化配置，Aurora 使用“单下划线”文件来表示环境配置。在全新安装的 Aurora 中，应用程序的根目录下都会有一个 `_example.php` 文件。这是环境配置的示例文件，在运行 Aurora 之前请将其手动重命名为单下划线： `_`

To make this a cinch, Aurora uses the single underscore file to represent the environment configuration. In a fresh Aurora installation, the root directory of your application will contain a `_example.php` file. This is a sample environment configuration file, you should rename it to `_` manually before running the application.

`_` 文件不应该和应用程序的源码一起被提交到源码仓库中，因为每个开发环境 / 服务器环境可能需要不同的环境配置。如果你们是一个开发团队，可能希望将 `_example.php` 文件包含到源码中。

Your `_` file should not be committed to your application's source control, since each developer / server using your application could require a different environment configuration. If you are developing with a team, you may wish to continue including a `_example.php` file with your application.

**HTTP路由 HTTP Routing**

Aurora 的路由基于 Phalcon 的路由模块，用法也是相同的。你可以在 `app/routes.php` 中定义应用程序的路由。

HTTP Routing is based on Phalcon's router component. Their usage is the same. You will define routes for your application in the `app/routes.php` file.

**HTTP 控制器 HTTP Controllers**

除了在单一的 routes.php 文件中定义所有的请求处理逻辑，你可能希望使用控制器类来组织这些逻辑。控制器一般存放在 `app/Controllers` 目录下，类名一般以 `Controller` 为后缀。

Instead of defining all of your request handling logic in a single `routes.php` file, you may wish to organize this behavior using Controller classes. Controllers are stored in the `app/Controllers` directory, and generally named with the suffix `Controller`.

**服务提供者 Service Providers**

服务提供者是 Aurora 应用程序启动的中心所在。我们所说的 “启动” 指的是什么？一般而言，我们指的是注册事物，比如注册服务容器绑定。

Service providers are the central place of Aurora application bootstrapping. What do we mean by "bootstrapped"? In general, we mean registering things, for example, registering service container bindings.

但与其它框架不同的是，出于对性能优化的考虑，Aurora 中每个服务提供者都有其特定用途。

But, being different from other frameworks, each service provider in Aurora has its specific purpose, out of consideration for performance optimization.

服务提供者存放在 `app/Providers` 目录下，类名一般以 `ServiceProvider` 为后缀。

Service providers are stored in the `app/Providers` directory, and generally named with the suffix `ServiceProvider`.

**视图 Views**

视图包含你应用程序所用到的 HTML，它能够有效分离应用程序的显示逻辑与控制逻辑。视图存放在 `resources/views` 目录下。

Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are stored in the `resources/views` directory.

Aurora 集成了 Phalcon 的 Simple View 组件。出于对性能的考虑，建议使用 AngularJS / Jade 之类的技术代替服务端模板渲染

Aurora integrates Phalcon's Simple View components. In consideration of performance, instead of server-side template rendering, it is recommended to use front-end technology such as AngularJS, Jade

### 许可 License

Aurora 框架是为基于 Apache 2.0 许可发布的开源软件。详情请阅 LICENSE 文件。

The Aurora framework is open-sourced software licensed under the Apache 2.0 license.  See the LICENSE file for more.

### 帮助翻译 Translation

英文都是谷歌翻译的*（其实是不敢承认是自己译的）*，欢迎协助翻译或纠正错误