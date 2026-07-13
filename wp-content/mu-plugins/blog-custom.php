<?php
/**
 * Plugin Name: Blog Custom Content
 * Description: 从 Blog 主题迁移的自定义内容，包含页面模板、样式和脚本。
 * Version: 1.0.1
 * Author: ncyoi
 */

if (!defined('ABSPATH')) {
    exit;
}

define('BLOG_CUSTOM_VERSION', '1.0.1');
define('BLOG_CUSTOM_DIR', plugin_dir_path(__FILE__) . 'blog-custom');
define('BLOG_CUSTOM_URL', plugin_dir_url(__FILE__) . 'blog-custom');

function blog_custom_get_site_icon_url($size = 512) {
    $available_sizes = array(16, 32, 180, 192, 512);
    $size = (int) $size;

    if (!in_array($size, $available_sizes, true)) {
        $size = 512;
    }

    return BLOG_CUSTOM_URL . '/static/images/site-icons/site-icon-' . $size . '.png';
}

function blog_custom_output_site_icon_links() {
    $icon_16 = esc_url(blog_custom_get_site_icon_url(16));
    $icon_32 = esc_url(blog_custom_get_site_icon_url(32));
    $icon_180 = esc_url(blog_custom_get_site_icon_url(180));
    $icon_192 = esc_url(blog_custom_get_site_icon_url(192));
    $icon_512 = esc_url(blog_custom_get_site_icon_url(512));

    echo '<link rel="icon" href="' . $icon_16 . '" sizes="16x16" type="image/png">' . "\n";
    echo '<link rel="icon" href="' . $icon_32 . '" sizes="32x32" type="image/png">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . $icon_180 . '" sizes="180x180">' . "\n";
    echo '<link rel="icon" href="' . $icon_192 . '" sizes="192x192" type="image/png">' . "\n";
    echo '<link rel="icon" href="' . $icon_512 . '" sizes="512x512" type="image/png">' . "\n";
}

function blog_custom_disable_default_site_icons() {
    remove_action('wp_head', 'wp_site_icon', 99);
    remove_action('admin_head', 'wp_site_icon', 99);
    remove_action('login_head', 'wp_site_icon', 99);
}
add_action('init', 'blog_custom_disable_default_site_icons');

add_action('wp_head', 'blog_custom_output_site_icon_links', 2);
add_action('admin_head', 'blog_custom_output_site_icon_links', 2);
add_action('login_head', 'blog_custom_output_site_icon_links', 2);

function blog_custom_login_branding() {
    $icon_url = esc_url(blog_custom_get_site_icon_url(512));

    echo '<style id="blog-custom-login-branding">'
        . '.login h1 a {'
        . 'background-image: url(' . $icon_url . ');'
        . 'background-position: center;'
        . 'background-size: 104px 104px;'
        . 'height: 112px;'
        . 'width: 100%;'
        . '}'
        . '</style>';
}
add_action('login_head', 'blog_custom_login_branding', 20);

function blog_custom_login_logo_url() {
    return home_url('/');
}
add_filter('login_headerurl', 'blog_custom_login_logo_url');

function blog_custom_login_logo_text() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'blog_custom_login_logo_text');

function blog_custom_admin_branding() {
    $icon_url = esc_url(blog_custom_get_site_icon_url(32));

    echo '<style id="blog-custom-admin-branding">'
        . '#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {'
        . 'width: 20px;'
        . 'height: 32px;'
        . 'margin: 0 6px;'
        . 'background: url(' . $icon_url . ') center / 20px 20px no-repeat;'
        . '}'
        . '#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon::before {'
        . 'content: none;'
        . '}'
        . '</style>';
}
add_action('admin_head', 'blog_custom_admin_branding', 20);

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
        'secret-link'  => 'css/secret-link.css',
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

    wp_enqueue_script(
        'blog-custom-secret-link',
        BLOG_CUSTOM_URL . '/js/secret-link.js',
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

    // 隐藏连接演示页面
    if ($page_param === 'secret' || $request_uri === 'secret' || is_page('secret') || is_page_template('template-secret-tcp.php')) {
        $custom_template = BLOG_CUSTOM_DIR . '/template-secret-tcp.php';
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
