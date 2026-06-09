<?php
/**
 * 临时脚本：添加演示文章
 * 使用后请删除此文件
 */

// 加载 WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';

// 检查是否已经添加过
$existing_post = get_page_by_path('hello-world-demo', OBJECT, 'post');
if ($existing_post) {
    echo "演示文章已存在，ID: " . $existing_post->ID . "\n";
    echo "请访问: " . get_permalink($existing_post->ID) . "\n";
    exit;
}

// 文章内容
$post_title = '欢迎来到我的博客';
$post_content = '
<!-- wp:paragraph -->
<p>这是一个演示文章，用于展示博客的样式和功能。这里有一些常见的博客元素：</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>文章特点</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>这个博客使用了现代的前端技术，具有以下特点：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>响应式设计，适配各种屏幕尺寸</li>
<li>简洁的排版，提升阅读体验</li>
<li>支持多种内容格式</li>
<li>快速加载，优化性能</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>代码示例</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>这里是一个简单的 JavaScript 代码示例：</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>function greet(name) {
    return `你好, ${name}!`;
}

console.log(greet("访客"));</code></pre>
<!-- /wp:code -->

<!-- wp:heading -->
<h2>引用</h2>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>好的设计是尽可能少的设计。—— Dieter Rams</p></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p>感谢你的访问，希望你喜欢这个博客！</p>
<!-- /wp:paragraph -->
';

$post_data = array(
    'post_title'    => $post_title,
    'post_content'  => $post_content,
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type'     => 'post',
    'post_name'     => 'hello-world-demo',
);

// 插入文章
$post_id = wp_insert_post($post_data);

if ($post_id) {
    // 添加标签
    wp_set_post_tags($post_id, array('演示', '博客', '测试'));

    echo "演示文章创建成功！\n";
    echo "文章 ID: " . $post_id . "\n";
    echo "文章链接: " . get_permalink($post_id) . "\n";
} else {
    echo "文章创建失败\n";
}
