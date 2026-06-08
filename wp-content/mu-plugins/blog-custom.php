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
    // 主样式
    wp_enqueue_style(
        'blog-custom-style',
        BLOG_CUSTOM_URL . '/style.css',
        array(),
        BLOG_CUSTOM_VERSION
    );

    // 响应式样式
    wp_enqueue_style(
        'blog-custom-responsive',
        BLOG_CUSTOM_URL . '/responsive.css',
        array(),
        BLOG_CUSTOM_VERSION
    );

    // 响应式布局
    wp_enqueue_style(
        'blog-custom-layout',
        BLOG_CUSTOM_URL . '/layout.css',
        array(),
        BLOG_CUSTOM_VERSION
    );

    // 主脚本
    wp_enqueue_script(
        'blog-custom-main',
        BLOG_CUSTOM_URL . '/main.js',
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
 * 覆盖页面模板 - 为首页和特定页面使用自定义模板
 */
function blog_custom_template_include($template) {
    if (is_front_page() || is_home() || is_page('main-blog') || is_page_template('template-main.php') || is_page_template('page-main-blog.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-main.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter('template_include', 'blog_custom_template_include', 99);

/**
 * 注册编辑器样式
 */
function blog_custom_admin_style() {
    add_editor_style(BLOG_CUSTOM_URL . '/style.css');
}
add_action('admin_init', 'blog_custom_admin_style');