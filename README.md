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

### 用法 Usage

首先安装好PHP环境，然后安装正确的 Phalcon 和 Swoole 扩展。

First you need to setup the PHP environment, then install the correct Phalcon and Swoole extension.

使用命令行启动 Aurora 服务

Use the command to start Aurora server

    php console fly

### 许可 License

Aurora 框架是为基于 Apache 2.0 许可发布的开源软件。详情请阅 LICENSE 文件。

The Aurora framework is open-sourced software licensed under the Apache 2.0 license.  See the LICENSE file for more.

### 帮助翻译 Translation

英文都是谷歌翻译的*（其实是不敢承认是自己译的）*，欢迎协助翻译或纠正错误