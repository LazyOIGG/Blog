<?php
/**
 * 临时脚本：创建首页
 * 使用后请删除此文件
 */

// 加载 WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

// 检查是否已存在
$existing_page = get_page_by_path('home', OBJECT, 'page');
if ($existing_page) {
    echo "首页已存在，ID: " . $existing_page->ID . "\n";
    echo "请访问: " . get_permalink($existing_page->ID) . "\n";

    // 设置为首页
    update_option('show_on_front', 'page');
    update_option('page_on_front', $existing_page->ID);
    echo "已将此页面设置为站点首页\n";
    echo "首页地址: " . home_url('/') . "\n";
    exit;
}

// 创建页面
$page_data = array(
    'post_title'    => 'Home',
    'post_content'  => '',
    'post_status'   => 'publish',
    'post_type'     => 'page',
    'post_name'     => 'home',
    'page_template' => 'template-main.php'
);

$page_id = wp_insert_post($page_data);

if ($page_id) {
    // 设置页面模板
    update_post_meta($page_id, '_wp_page_template', 'template-main.php');

    // 设置为首页
    update_option('show_on_front', 'page');
    update_option('page_on_front', $page_id);

    echo "首页创建成功！\n";
    echo "页面 ID: " . $page_id . "\n";
    echo "页面链接: " . get_permalink($page_id) . "\n";
    echo "已将此页面设置为站点首页\n";
    echo "首页地址: " . home_url('/') . "\n";
} else {
    echo "页面创建失败\n";
}
