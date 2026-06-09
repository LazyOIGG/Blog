# Blog Custom 脚本使用说明

本目录包含用于初始化和配置博客的 PHP 脚本。这些脚本是一次性使用的工具，执行完成后应删除。

## ⚠️ 安全提示

这些脚本包含 WordPress 加载文件，**使用完成后请立即删除**，以避免安全风险。

---

## 脚本列表

### 1. create-home-page.php

**用途**：创建首页页面并设置为站点首页

**功能**：
- 创建 slug 为 `home` 的页面
- 自动绑定 `template-main.php` 模板
- 将该页面设置为 WordPress 站点首页

**使用方法**：
```
你的域名/wp-content/mu-plugins/blog-custom/create-home-page.php
```

**执行结果**：
- 创建 Home 页面（ID: 58）
- 自动设置为站点首页
- 访问 `http://localhost:8080/` 即可看到自定义首页

---

### 2. create-articles-page.php

**用途**：创建文章列表页面

**功能**：
- 创建 slug 为 `articles` 的页面
- 自动绑定 `template-articles.php` 模板

**使用方法**：
```
你的域名/wp-content/mu-plugins/blog-custom/create-articles-page.php
```

**执行结果**：
- 创建 Articles 页面
- 访问 `http://localhost:8080/articles` 查看文章列表

---

### 3. add-demo-post.php

**用途**：添加一篇演示文章

**功能**：
- 创建一篇包含多种内容格式的演示文章
- 自动添加标签（演示、博客、测试）

**使用方法**：
```
你的域名/wp-content/mu-plugins/blog-custom/add-demo-post.php
```

**执行结果**：
- 创建演示文章"欢迎来到我的博客"
- 包含段落、标题、列表、代码块、引用等示例内容

---

## 执行顺序

建议按以下顺序执行：

1. `create-home-page.php` - 创建首页
2. `create-articles-page.php` - 创建文章列表页
3. `add-demo-post.php` - 添加演示文章（可选）

---

## 注意事项

1. **执行前备份**：建议在执行前备份数据库
2. **重复执行**：脚本会检查页面/文章是否已存在，重复执行不会创建重复内容
3. **删除脚本**：所有脚本执行完成后，请删除本目录下的以下文件：
   - `create-home-page.php`
   - `create-articles-page.php`
   - `add-demo-post.php`

---

## 故障排除

### 页面创建失败
- 检查 WordPress 数据库连接是否正常
- 确认当前用户有管理员权限

### 页面已存在
- 脚本会自动检测并显示已存在页面的 ID 和链接
- 不会创建重复页面

### 模板未生效
- 确认 `template-main.php` 和 `template-articles.php` 文件存在
- 检查 WordPress 后台 → 设置 → 固定链接，点击"保存更改"刷新
