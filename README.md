php-swagger-ui
==============

Introduction
-----------
一个基于 [php-swagger](https://github.com/bobitluo/php-swagger) 生成PHP API在线文档的UI项目

Installation
------------

```bash
composer create-project --prefer-dist bobitluo/php-swagger yourproject
```

Usage
-----

修改 config.yaml

```yaml
projects:
  your_first_project:  # 定义项目KEY。可配置多个项目
    type: directory
    dir: /your/project/controller/dir   # 配置成项目controller的目录(建议部署在开发或测试环境)
    swagger:
      title: project name
      description: project description
      version: project version
      host: your_project_host.com   # 配置成项目的主机名(建议配置开发或测试环境的主机)
      schemes: 
        - https
      securityDefinitions:  # 认证相关配置。请参考 https://swagger.io/docs/specification/2-0/authentication/
        ApiKeyAuth:
          type: apiKey
          in: header
          name: Authorization
      security:
        - ApiKeyAuth: []
      controller_prefix: 
      controller_postfix: Controller
      action_prefix: 
      action_postfix: Action
```

PHP注释格式
---------

[PHP注释格式](https://github.com/bobitluo/php-swagger#php%E6%B3%A8%E9%87%8A%E6%A0%B7%E4%BE%8B)