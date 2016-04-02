## Lightning (PHP Framework)

Lightning 是一个建立在 Phalcon 之上的高性能框架，专为 Web 艺术家打造。她考虑了常见的 Web 业务需求，七十二变可大可小——既可用于开发CMS之类的大型系统，也适用于规模较小的 API 接口、微服务。

Lightning is a high performance framework that sits on top of Phalcon. It's for web artisans. In consideration of the popular Web business needs, Lightning is so flexible that is capable of the development of large systems (CMS, etc) or smaller systems (API services, micro-services, etc)

> We believe development must be an enjoyable, creative experience to be
> truly fulfilling. Laravel attempts to take the pain out of development
> by easing common tasks used in the majority of web projects.
>
> *by Laravel*

Laravel 有一个高性能版本的微框架叫作 Lumen ，虽然在纯PHP框架当中它算是比较快的框架了，但这还远远不够。Lightning 致力于打造出一个有着优雅语法的全栈框架。很多灵感来自于 Laravel ，也许你会发现她挺像 Laravel 的。

The high performance version of Laravel is Lumen, but it’s not good/fast enough. Lightning is trying to be a fast full-stack framework with elegant syntax. Laravel gave me a lot of inspiration, so you may find she a bit like Laravel.

### 亮点 Features

 - 为高性能而生
 - Optimized for high performance
 - 魚*（优雅）*和熊掌*（性能）*亦可兼得
 - Maintaining elegance without sacrificing performance
 - 现代化工具，奇妙的开发之旅
 - Modern toolkit, pinch of magic
 - 来自 Laravel 的数据迁移器和结构生成器
 - Laravel's database agnostic migrations and schema builder
 - 由 Laravel Elixir 提供的用于定义 Gulp任务的简洁、流畅的API
 - Laravel Elixir provides a clean, fluent API for defining basic Gulp tasks.
 - 实用的辅助函数
 - Useful helper functions
 - *有时间再写……*
 - *More to write...*

### 环境要求 Requirements

- PHP >= 5.5
- Phalcon PHP Extension


### 文档 Documentation

**安装 Installation**

Lightning 使用 Composer 来管理依赖包。因此，在使用之前，请确保你已经安装了 Composer ，然后执行命令：

Lightning utilizes Composer to manage its dependencies. So, before using Lightning, make sure you have Composer installed, and execute the following command:

    composer install

**应用配置 Application Configuration**

Lightning 框架所用的配置文件存放在 config 目录下，请通读配置文件以熟悉可用的配置项。

All of the configuration files for the Lightning framework are stored in the config directory. Feel free to look through the files and get familiar with the options available to you.

**环境配置 Environment Configuration**

通常应用程序需要根据不同的运行环境加载不同的配置信息。例如，你可能希望本机开发环境与生产服务器环境使用不同的缓存驱动。通过环境配置文件，就可以轻松完成。

It is often helpful to have different configuration values based on the environment the application is running in. For example, you may wish to use a different cache driver locally than you do on your production server. It's easy using environment based configuration.

为了简化配置，Lightning 使用“单下划线”文件来表示环境配置。在全新安装的 Lightning 中，应用程序的根目录下都会有一个 `_example.php` 文件。这是环境配置的示例文件，在运行 Lightning 之前请将其手动重命名为单下划线： `_`

To make this a cinch, Lightning uses the single underscore file to represent the environment configuration. In a fresh Lightning installation, the root directory of your application will contain a `_example.php` file. This is a sample environment configuration file, you should rename it to `_` manually before running the application.

`_` 文件不应该和应用程序的源码一起被提交到源码仓库中，因为每个开发环境 / 服务器环境可能需要不同的环境配置。如果你们是一个开发团队，可能希望将 `_example.php` 文件包含到源码中。

Your `_` file should not be committed to your application's source control, since each developer / server using your application could require a different environment configuration. If you are developing with a team, you may wish to continue including a `_example.php` file with your application.

**HTTP路由 HTTP Routing**

Lightning 的路由基于 Phalcon 的路由模块，用法也是相同的。你可以在 `app/routes.php` 中定义应用程序的路由。

HTTP Routing is based on Phalcon's router component. Their usage is the same. You will define routes for your application in the `app/routes.php` file.

**HTTP 控制器 HTTP Controllers**

除了在单一的 routes.php 文件中定义所有的请求处理逻辑，你可能希望使用控制器类来组织这些逻辑。控制器一般存放在 `app/Controllers` 目录下，类名一般以 `Controller` 为后缀。

Instead of defining all of your request handling logic in a single `routes.php` file, you may wish to organize this behavior using Controller classes. Controllers are stored in the `app/Controllers` directory, and generally named with the suffix `Controller`.

**服务提供者 Service Providers**

服务提供者是 Lightning 应用程序启动的中心所在。我们所说的 “启动” 指的是什么？一般而言，我们指的是注册事物，比如注册服务容器绑定。

Service providers are the central place of Lightning application bootstrapping. What do we mean by "bootstrapped"? In general, we mean registering things, for example, registering service container bindings.

但与其它框架不同的是，出于对性能优化的考虑，Lightning 中每个服务提供者都有其特定用途。

But, being different from other frameworks, each service provider in Lightning has its specific purpose, out of consideration for performance optimization.

服务提供者存放在 `app/Providers` 目录下，类名一般以 `ServiceProvider` 为后缀。

Service providers are stored in the `app/Providers` directory, and generally named with the suffix `ServiceProvider`.

### 许可 License

Lightning 框架是为基于 Apache 2.0 许可发布的开源软件。详情请阅 LICENSE 文件。

The Lightning framework is open-sourced software licensed under the Apache 2.0 license.  See the LICENSE file for more.

### 帮助翻译 Translation

英文都是谷歌翻译的*（其实是不敢承认是自己译的）*，欢迎协助翻译或纠正错误