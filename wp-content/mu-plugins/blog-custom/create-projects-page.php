<?php
/**
 * 临时脚本：创建项目列表页
 * 使用后请删除此文件
 */

// 加载 WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

// 检查是否已存在
$existing_page = get_page_by_path('projects', OBJECT, 'page');
if ($existing_page) {
    echo "项目列表页已存在，ID: " . $existing_page->ID . "\n";
    echo "请访问: " . get_permalink($existing_page->ID) . "\n";
    exit;
}

// 创建页面
$page_data = array(
    'post_title'    => 'Projects',
    'post_content'  => '',
    'post_status'   => 'publish',
    'post_type'     => 'page',
    'post_name'     => 'projects',
    'page_template' => 'template-projects.php'
);

$page_id = wp_insert_post($page_data);

if ($page_id) {
    // 设置页面模板
    update_post_meta($page_id, '_wp_page_template', 'template-projects.php');

    echo "项目列表页创建成功！\n";
    echo "页面 ID: " . $page_id . "\n";
    echo "页面链接: " . get_permalink($page_id) . "\n";
} else {
    echo "页面创建失败\n";
}
