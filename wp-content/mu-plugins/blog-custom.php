<?php
/**
 * Plugin Name: Blog Custom Content
 * Description: 从 Blog 主题迁移的自定义内容，包含页面模板、样式和脚本。
 * Version: 1.0.0
 * Author: ncyoi
 */

if (!defined('ABSPATH')) {
    exit;
}

define('BLOG_CUSTOM_VERSION', '1.0.0');
define('BLOG_CUSTOM_DIR', plugin_dir_path(__FILE__) . 'blog-custom');
define('BLOG_CUSTOM_URL', plugin_dir_url(__FILE__) . 'blog-custom');

/**
 * 注册侧边栏
 */
function blog_custom_widgets_init() {
    register_sidebar(array(
        'name'          => __('主页侧边栏', 'blog'),
        'id'            => 'sidebar-primary',
        'description'   => __('主页侧边栏区域', 'blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('底部侧边栏', 'blog'),
        'id'            => 'sidebar-footer',
        'description'   => __('底部侧边栏区域', 'blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'blog_custom_widgets_init');

/**
 * 加载样式和脚本
 */
function blog_custom_enqueue_assets() {
    // CSS 模块（按依赖顺序加载）
    $css_modules = array(
        'variables'    => 'css/variables.css',
        'loading'      => 'css/loading.css',
        'main-banner'  => 'css/main-banner.css',
        'article'      => 'css/article.css',
        'article-list' => 'css/article-list.css',
        'section'      => 'css/section.css',
        'footer'       => 'css/footer.css',
        'animations'   => 'css/animations.css',
        'side-nav'     => 'css/side-nav.css',
        'mobile-nav'   => 'css/mobile-nav.css',
        'dark-mode'    => 'css/dark-mode.css',
        'responsive'   => 'css/responsive.css',
    );

    foreach ($css_modules as $handle => $file) {
        wp_enqueue_style(
            'blog-custom-' . $handle,
            BLOG_CUSTOM_URL . '/' . $file,
            array(),
            BLOG_CUSTOM_VERSION
        );
    }

    // 脚本文件
    wp_enqueue_script(
        'blog-custom-main',
        BLOG_CUSTOM_URL . '/js/main.js',
        array(),
        BLOG_CUSTOM_VERSION,
        true
    );

    wp_enqueue_script(
        'blog-custom-side-nav',
        BLOG_CUSTOM_URL . '/js/side-nav.js',
        array(),
        BLOG_CUSTOM_VERSION,
        true
    );

    wp_enqueue_script(
        'blog-custom-mobile-nav',
        BLOG_CUSTOM_URL . '/js/mobile-nav.js',
        array(),
        BLOG_CUSTOM_VERSION,
        true
    );
    

}
add_action('wp_enqueue_scripts', 'blog_custom_enqueue_assets');

/**
 * 自定义摘录长度
 */
function blog_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'blog_custom_excerpt_length');

/**
 * 自定义摘录更多
 */
function blog_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'blog_custom_excerpt_more');

/**
 * 添加body类
 */
function blog_custom_body_classes($classes) {
    if (is_page_template()) {
        $template = get_page_template_slug();
        $classes[] = 'page-template-' . sanitize_html_class(str_replace('.php', '', $template));
    }
    
    if (is_single()) {
        $format = get_post_format();
        if ($format) {
            $classes[] = 'single-format-' . $format;
        } else {
            $classes[] = 'single-format-standard';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'blog_custom_body_classes');

/**
 * 预加载资源
 */
function blog_custom_preload_resources() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" as="style">' . "\n";
}
add_action('wp_head', 'blog_custom_preload_resources', 1);

/**
 * 清理WordPress头部
 */
function blog_custom_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'blog_custom_cleanup_head');

/**
 * 覆盖页面模板 - 使用 template_redirect 在 WordPress 判定 404 之前拦截
 */
function blog_custom_template_redirect() {
    // 只在前台执行
    if (is_admin()) {
        return;
    }

    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $page_param = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : '';

    // 文章列表页模板 - 支持查询参数、URL slug、页面 slug
    if ($page_param === 'articles' || $request_uri === 'articles' || is_page('articles') || is_page_template('template-articles.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-articles.php';
        if (file_exists($custom_template)) {
            include($custom_template);
            exit;
        }
    }

    // Projects 页面模板
    if ($page_param === 'projects' || $request_uri === 'projects' || is_page('projects') || is_page_template('template-projects.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-projects.php';
        if (file_exists($custom_template)) {
            include($custom_template);
            exit;
        }
    }

    // About 页面模板
    if ($page_param === 'about' || $request_uri === 'about' || is_page('about') || is_page_template('template-about.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-about.php';
        if (file_exists($custom_template)) {
            include($custom_template);
            exit;
        }
    }

    // Contact 页面模板
    if ($page_param === 'contact' || $request_uri === 'contact' || is_page('contact') || is_page_template('template-contact.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-contact.php';
        if (file_exists($custom_template)) {
            include($custom_template);
            exit;
        }
    }

    // 主页模板 - 仅在真正的前台首页时使用
    if ((is_front_page() && !is_paged()) || is_page('home') || is_page('main-blog') || is_page_template('template-main.php') || is_page_template('page-main-blog.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-main.php';
        if (file_exists($custom_template)) {
            include($custom_template);
            exit;
        }
    }
}
add_action('template_redirect', 'blog_custom_template_redirect', 1);

/**
 * 注册编辑器样式
 */
function blog_custom_admin_style() {
    add_editor_style(BLOG_CUSTOM_URL . '/css/variables.css');
}
add_action('admin_init', 'blog_custom_admin_style');