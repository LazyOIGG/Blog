---
name: blog
description: "修改 WordPress 博客前端样式和功能。当用户提到修改网站外观、样式、布局、加载页面、侧边栏、动画效果，或提到 CSS/JS/PHP 文件修改时触发。仅操作 wp-content/mu-plugins 目录下的文件。"
skills:
  - frontend-design
---

# Blog Custom Skill

你正在操作一个 WordPress 博客项目的前端自定义层。所有修改都限制在 `wp-content/mu-plugins` 目录内。

## 项目结构

```
wp-content/mu-plugins/
├── blog-custom.php           # 主插件入口，注册样式/脚本/侧边栏/模板
└── blog-custom/
    ├── template-main.php     # 主页面模板（Industrial Sci-Fi 风格）
    ├── template-*.php        # 其他页面模板（按需创建）
    ├── css/
    │   ├── variables.css     # CSS 变量与基础重置
    │   ├── loading.css       # 加载界面样式
    │   ├── hero.css          # Hero 区域样式
    │   ├── article.css       # 文章详情样式
    │   ├── footer.css        # 页脚样式
    │   ├── animations.css    # 动画效果
    │   ├── sidebar.css       # 侧边栏样式（Arknights Endfield 风格）
    │   └── responsive.css    # 响应式设计
    └── js/
        ├── main.js           # 主交互逻辑：进度条、加载动画、滚动效果
        └── sidebar.js        # 侧边栏交互：展开/折叠、导航高亮
```

## 模块化原则

### CSS 分模块
- **每个功能模块独立一个 CSS 文件**，按职责划分
- `variables.css` 必须最先加载（定义 CSS 变量）
- `responsive.css` 必须最后加载（覆盖其他样式）
- 侧边栏等独立组件使用自己的命名空间（如 `--ak-*` 前缀）

### JS 分模块
- **按功能分离**：主逻辑与组件交互分开
- `main.js` 负责全局交互（加载、滚动、画廊）
- `sidebar.js` 负责侧边栏专属交互

### 模板分模块
- **每个页面类型一个模板文件**：`template-main.php`、`template-article.php` 等
- 在 `blog-custom.php` 的 `template_include` 中按条件路由

## 工作规则

1. **仅读取和修改** `wp-content/mu-plugins/` 目录下的文件
2. **不要**修改 WordPress 核心文件、主题文件或其他插件文件
3. **不要**修改数据库或运行 WordPress CLI 命令
4. 修改前先读取文件了解当前状态
5. 保持代码风格一致（中文注释、与现有代码匹配的命名规范）
6. **文件分离原则**：CSS 放 `css/` 目录，JS 放 `js/` 目录，模板放根目录

## 文件职责

| 文件路径                 | 用途                                   |
|----------------------|--------------------------------------|
| `blog-custom.php`    | 插件注册入口：侧边栏、样式加载、脚本加载、模板覆盖            |
| `template-main.php`  | 主页模板：加载界面、侧边栏导航、Hero区、文章区、页脚         |
| `css/variables.css`  | 基础变量：颜色、字体、间距、过渡时间                   |
| `css/loading.css`    | 加载界面：进度条、雨刮动画、HUD 元素                 |
| `css/hero.css`       | Hero 区域：标题、装饰、滚动指示器                  |
| `css/article.css`    | 文章详情：布局、图片、正文样式                      |
| `css/footer.css`     | 页脚：底部信息栏                             |
| `css/animations.css` | 通用动画：淡入、滑入效果                         |
| `css/sidebar.css`    | 侧边栏：Arknights 风格导航（独立 `--ak-*` 命名空间） |
| `css/responsive.css` | 响应式：断点适配、方向响应                        |
| `js/main.js`         | 主交互：加载序列、导航、图片画廊、性能监控                |
| `js/sidebar.js`      | 侧边栏：展开折叠、导航高亮、切换开关                   |

## 添加新文件的流程

### 添加新 CSS 模块
1. 在 `css/` 目录创建新文件（如 `css/search.css`）
2. 在 `blog-custom.php` 的 `$css_modules` 数组中注册
3. 在 `template-main.php` 的 `<head>` 中添加 `<link>` 引用

### 添加新 JS 模块
1. 在 `js/` 目录创建新文件（如 `js/search.js`）
2. 在 `blog-custom.php` 中使用 `wp_enqueue_script` 注册
3. 在 `template-main.php` 底部添加 `<script>` 引用

### 添加新页面模板
1. 创建 `template-xxx.php` 文件
2. 在 `blog-custom.php` 的 `template_include` 函数中添加路由条件
3. 复用 `css/` 和 `js/` 中已有的模块

## 常见任务指引

- **修改加载页面** → 编辑 `template-main.php` 中的 `.loading-screen` 部分和 `js/main.js` 中的加载逻辑
- **修改侧边栏** → 编辑 `template-main.php` 中的 `<nav class="ak-sidebar">` 部分，样式在 `css/sidebar.css`，交互在 `js/sidebar.js`
- **修改全局样式** → 编辑 `css/variables.css`（变量）或 `css/animations.css`（动画）
- **修改响应式布局** → 编辑 `css/responsive.css`
- **修改交互行为** → 编辑 `js/main.js`
- **添加新功能** → 在 `blog-custom.php` 中注册新的样式/脚本，然后在 `css/` 或 `js/` 目录创建对应文件

## 技能衔接：frontend-design

当 blog skill 执行涉及**视觉设计决策**的任务时，自动衔接 `frontend-design` 技能获取设计指导。

### 触发条件

以下情况需要衔接 frontend-design：
- 修改颜色方案、配色、主题色
- 调整布局结构、间距、排版
- 设计新的 UI 组件或页面区块
- 优化视觉层次、对比度、可读性
- 添加或修改动画效果、过渡
- 响应式设计决策

### 不需要衔接的情况

以下情况直接由 blog 处理：
- 纯代码结构重构（文件移动、变量重命名）
- Bug 修复（选择器错误、属性拼写）
- 注册新文件到 WordPress
- PHP 逻辑修改

### 衔接流程

```
用户请求修改视觉样式
        ↓
    [blog skill]
        ↓
判断是否涉及设计决策？
    ├── 是 → 调用 frontend-design 获取设计方案
    │           ↓
    │       blog 根据方案实现代码
    └── 否 → 直接修改代码
```

### 调用示例

当用户说「把 Hero 区域改成更现代的风格」：
1. blog 识别这是视觉设计任务
2. 调用 frontend-design 获取现代风格的设计建议（配色、字体、间距）
3. blog 根据建议修改 `css/variables.css`、`css/hero.css`、`template-main.php`
