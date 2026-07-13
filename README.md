# NCYOIGG Blog

> 基于 WordPress 的个人博客自定义层，以工业科幻风格呈现文章、项目与个人信息。

[在线访问](https://ncyoigg.top) · [GitHub 仓库](https://github.com/LazyOIGG/Blog)

## 项目亮点

| 方向 | 已实现内容 |
| --- | --- |
| 页面体验 | 首页、文章、项目、关于与联系页面使用独立 PHP 模板输出 |
| 视觉系统 | 模块化 CSS、工业科幻风格侧边导航、加载界面与响应式布局 |
| 交互 | 桌面侧边栏、移动端导航、深色模式三态切换与页面滚动交互 |
| 内容能力 | 文章列表和文章内容直接使用 WordPress 的文章与页面数据 |
| 扩展方式 | 通过 Must-Use Plugin 加载，无需在后台手动启用常规插件 |

## 在线页面

| 页面 | 访问路径 |
| --- | --- |
| 首页 | `/` |
| 文章 | `/?section=articles` 或 `/articles` |
| 项目 | `/?section=projects` 或 `/projects` |
| 关于 | `/?section=about` 或 `/about` |
| 联系 | `/?section=contact` 或 `/contact` |

路由由 `template_redirect` 处理，因此查询参数和对应页面 slug 均可进入自定义模板。

## 技术结构

本仓库包含 WordPress 运行时，以及位于 `wp-content/mu-plugins` 的自定义博客层。项目功能主要集中在后者，避免直接修改 WordPress 核心、主题或数据库。

```text
wp-content/mu-plugins/
├── blog-custom.php                 # Must-Use Plugin 入口：资源注册、路由与 WordPress 钩子
└── blog-custom/
    ├── template-main.php            # 首页
    ├── template-articles.php        # 文章列表
    ├── template-projects.php        # 项目页
    ├── template-about.php           # 关于页
    ├── template-contact.php         # 联系页
    ├── css/                         # 样式模块：导航、深色模式、响应式等
    ├── js/                          # 原生 JavaScript 交互模块
    └── static/                      # 字体与图片资源
```

| 技术 | 用途 |
| --- | --- |
| WordPress 7.0 | 内容管理与页面生命周期 |
| PHP 7.4+ | 项目随附 WordPress 核心声明的最低 PHP 版本 |
| Must-Use Plugin | 自动加载自定义模板、资源与路由 |
| CSS / 原生 JavaScript | 页面样式、响应式导航和交互状态 |

## 本地启动

1. 准备 PHP 7.4+、MySQL/MariaDB 与可运行 WordPress 的 Web 服务器环境。
2. 根据 `wp-config-sample.php` 创建本地 `wp-config.php`，填入本地数据库连接信息。该文件已被 Git 忽略，不应提交凭据。
3. 将 Web 根目录指向本仓库，完成 WordPress 安装或连接到已有的开发数据库。
4. 在 WordPress 后台创建并发布所需内容；首页可使用 `home` 页面或直接设置为站点首页。
5. 访问上述路由确认首页、文章、项目、关于和联系页面均能正常加载。

`blog-custom.php` 位于 `mu-plugins`，WordPress 会自动加载它，不需要在插件后台执行启用操作。

## 内容与模板

- 文章与文章列表由 WordPress 内容数据提供，自定义模板负责展示。
- `template-main.php` 负责首页与文章入口。
- `template-articles.php`、`template-projects.php`、`template-about.php`、`template-contact.php` 分别承载独立页面。
- 样式按职责拆分为 CSS 模块，`variables.css` 最先加载，`responsive.css` 最后覆盖响应式规则。

仓库内的 `create-*.php` 与 `add-demo-post.php` 是初始化辅助脚本，仅应在受控开发环境使用。执行后请从生产环境移除，避免将一次性初始化入口暴露到公网。

## 部署边界

为现有 WordPress 站点部署时，只同步以下受管自定义层：

```text
wp-content/mu-plugins/blog-custom.php
wp-content/mu-plugins/blog-custom/
```

不要将数据库配置、上传文件、缓存或 WordPress 核心改动混入部署。部署后应逐文件核验自定义层与版本库一致。

## 提交约定

提交信息使用中文 Conventional Commits 风格：

```text
feat: 添加文章展示能力
fix: 修复移动端导航状态
style: 优化首页视觉层次
docs: 更新本地启动说明
```

提交前仅暂存已确认的文件，并确保不包含数据库密码、SSH 私钥、令牌或面板凭据。
