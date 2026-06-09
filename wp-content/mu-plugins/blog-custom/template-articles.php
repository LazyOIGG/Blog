<?php
/**
 * Template Name: Articles
 * Description: 文章列表页
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo("name"); ?> - Articles</title>
    <!-- CSS 模块 -->
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/variables.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/article-list.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/footer.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body, html { margin: 0 !important; padding: 0 !important; }
        /* 确保页面有最小高度，底部固定在屏幕底部 */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .article-list-section {
            flex: 1;
        }
    </style>
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/side-nav.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/mobile-nav.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/dark-mode.css">
</head>
<body>
    <!-- 主页面内容 -->
    <div class="main-content visible" id="mainContent">
        <!-- 竖屏模式顶部导航栏（汉堡菜单） -->
        <nav class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-logo">
                <a href="<?php echo home_url(); ?>" class="mobile-nav-logo-text">NCYOIGG</a>
            </div>
            <button class="mobile-nav-toggle" id="mobileNavToggle">
                <span class="mobile-nav-toggle-line"></span>
                <span class="mobile-nav-toggle-line"></span>
                <span class="mobile-nav-toggle-line"></span>
            </button>
        </nav>

        <!-- 竖屏模式导航菜单（展开状态） -->
        <div class="mobile-nav-menu" id="mobileNavMenu">
            <div class="mobile-nav-menu-header">
                <span class="mobile-nav-menu-logo">NCYOIGG</span>
                <button class="mobile-nav-menu-close" id="mobileNavMenuClose">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2"/>
                        <line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <div class="mobile-nav-menu-content">
                <!-- Navigation Section -->
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-label">Navigation</div>
                    <a href="<?php echo home_url(); ?>" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="<?php echo home_url('/?section=articles'); ?>" class="mobile-nav-item active">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>Articles</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#projects" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        <span>Projects</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#about" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>About</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#contact" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>Contact</span>
                    </a>
                </div>

                <div class="mobile-nav-divider"></div>

                <!-- Quick Tools -->
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-label">Quick Tools</div>
                    <a href="<?php echo home_url(); ?>#language" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span>Language</span>
                    </a>
                    <div class="mobile-nav-item mobile-nav-dark-mode" data-action="darkMode">
                        <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                        <span>Dark Mode</span>
                        <div class="mobile-nav-tri-state">
                            <button class="mobile-nav-tri-state-btn active" data-value="off">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                            </button>
                            <button class="mobile-nav-tri-state-btn" data-value="system">
                                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            </button>
                            <button class="mobile-nav-tri-state-btn" data-value="on">
                                <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="mobile-nav-item mobile-nav-music" data-action="music">
                        <svg viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                        <span>Music</span>
                        <div class="mobile-nav-switch-track">
                            <div class="mobile-nav-switch-thumb"></div>
                        </div>
                    </div>
                </div>

                <div class="mobile-nav-divider"></div>

                <!-- Social -->
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-label">Social</div>
                    <div class="mobile-nav-item mobile-nav-social" data-action="email" data-email="ncyoigg@qq.com">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>Email</span>
                    </div>
                    <a href="https://space.bilibili.com/183373315" target="_blank" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M7 7l3 3-3 3"/><path d="M17 7l-3 3 3 3"/><line x1="10" y1="13" x2="14" y2="13"/></svg>
                        <span>Bilibili</span>
                    </a>
                    <a href="https://github.com/LazyOIGG" target="_blank" class="mobile-nav-item">
                        <svg viewBox="0 0 24 24"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                        <span>GitHub</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- 左侧固定侧边导航栏 -->
        <!-- Arknights Endfield Inspired Sidebar -->
        <nav class="side-nav" id="sidebarNav">
            <!-- HUD Decorations -->
            <div class="nav-hud-corner top-left"></div>
            <div class="nav-hud-corner top-right"></div>
            <div class="nav-hud-corner bottom-left"></div>
            <div class="nav-hud-corner bottom-right"></div>
            <div class="nav-scan-line"></div>
            <div class="ambient-glow"></div>

            <!-- Logo -->
            <div class="side-nav-logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span class="logo-text">NCYOIGG</span>
            </div>

            <!-- Scrollable Menu -->
            <div class="side-nav-menu">
                <!-- Navigation Section -->
                <div class="nav-section">
                    <div class="nav-section-label">Navigation</div>
                    <a href="<?php echo home_url(); ?>" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <span class="nav-label">Home</span>
                        <span class="nav-tooltip">Home</span>
                    </a>
                    <a href="<?php echo home_url('/?section=articles'); ?>" class="nav-item active">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <span class="nav-label">Articles</span>
                        <span class="nav-tooltip">Articles</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#projects" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </div>
                        <span class="nav-label">Projects</span>
                        <span class="nav-tooltip">Projects</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#about" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <span class="nav-label">About</span>
                        <span class="nav-tooltip">About</span>
                    </a>
                    <a href="<?php echo home_url(); ?>#contact" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <span class="nav-label">Contact</span>
                        <span class="nav-tooltip">Contact</span>
                    </a>
                </div>

                <div class="nav-divider"></div>

                <!-- Quick Tools -->
                <div class="nav-section">
                    <div class="nav-section-label">Quick Tools</div>
                    <a href="<?php echo home_url(); ?>#language" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                        </div>
                        <span class="nav-label">Language</span>
                        <span class="nav-tooltip">Language</span>
                    </a>
                    <div class="nav-item nav-dark-mode" data-action="darkMode">
                        <div class="nav-icon">
                            <!-- 关闭状态图标（太阳） -->
                            <svg class="nav-dark-icon off" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="5"/>
                                <line x1="12" y1="1" x2="12" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="23"/>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                <line x1="1" y1="12" x2="3" y2="12"/>
                                <line x1="21" y1="12" x2="23" y2="12"/>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                            </svg>
                            <!-- 跟随系统图标（自动） -->
                            <svg class="nav-dark-icon system" viewBox="0 0 24 24" style="display:none">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                            <!-- 开启状态图标（月亮） -->
                            <svg class="nav-dark-icon on" viewBox="0 0 24 24" style="display:none">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                            </svg>
                        </div>
                        <span class="nav-label">Dark Mode</span>
                        <div class="nav-tri-state">
                            <button class="nav-tri-state-btn active" data-value="off" title="Off">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                            </button>
                            <button class="nav-tri-state-btn" data-value="system" title="System">
                                <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            </button>
                            <button class="nav-tri-state-btn" data-value="on" title="On">
                                <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="nav-item nav-music" data-action="music">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 18V5l12-2v13"/>
                                <circle cx="6" cy="18" r="3"/>
                                <circle cx="18" cy="16" r="3"/>
                            </svg>
                        </div>
                        <span class="nav-label">Music</span>
                        <div class="nav-music-status">
                            <span class="nav-music-status-icon">♫</span>
                        </div>
                        <div class="nav-music-switch">
                            <div class="nav-music-switch-track">
                                <div class="nav-music-switch-thumb"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-divider"></div>

                <!-- Social -->
                <div class="nav-section">
                    <div class="nav-section-label">Social</div>
                    <div class="nav-item nav-social" data-action="email" data-email="ncyoigg@qq.com">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <span class="nav-label">Email</span>
                        <span class="nav-tooltip">Email</span>
                    </div>
                    <a href="https://space.bilibili.com/183373315" target="_blank" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5"/>
                                <path d="M7 7l3 3-3 3"/>
                                <path d="M17 7l-3 3 3 3"/>
                                <line x1="10" y1="13" x2="14" y2="13"/>
                            </svg>
                        </div>
                        <span class="nav-label">Bilibili</span>
                        <span class="nav-tooltip">Bilibili</span>
                    </a>
                    <a href="https://github.com/LazyOIGG" target="_blank" class="nav-item">
                        <div class="nav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                            </svg>
                        </div>
                        <span class="nav-label">GitHub</span>
                        <span class="nav-tooltip">GitHub</span>
                    </a>
                </div>

                <!-- Data Readout -->
                <div class="nav-data-readout">
                    SYS: <span class="data-value">ONLINE</span> | v2.0
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="side-nav-bottom">
                <button class="nav-toggle-btn">
                    <svg viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- 文章列表区域 -->
        <section class="article-list-section">
            <div class="article-list-container">
                <div class="article-list-header">
                    <h1 class="article-list-title">Articles</h1>
                    <p class="article-list-desc">所有文章</p>
                </div>

                <div class="article-list">
                    <?php
                    // 分页参数
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = array(
                        'posts_per_page' => 10,
                        'paged' => $paged,
                        'post_status' => 'publish'
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                    ?>
                    <article class="article-list-item">
                        <a href="<?php the_permalink(); ?>" class="article-list-link">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="article-list-thumb">
                                <?php the_post_thumbnail('medium_large', array('class' => 'article-list-img')); ?>
                            </div>
                            <?php endif; ?>
                            <div class="article-list-content">
                                <div class="article-list-meta">
                                    <span class="article-list-date"><?php echo get_the_date("Y.m.d"); ?></span>
                                    <?php
                                    $tags = get_the_tags();
                                    if ($tags) {
                                        foreach (array_slice($tags, 0, 2) as $tag) {
                                            echo '<span class="article-list-tag">' . esc_html($tag->name) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <h2 class="article-list-name"><?php the_title(); ?></h2>
                                <p class="article-list-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                            </div>
                        </a>
                    </article>
                    <?php
                        endwhile;
                    ?>
                </div>

                <!-- 分页 -->
                <div class="article-list-pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                        'total' => $query->max_num_pages
                    ));
                    ?>
                </div>

                <?php
                    else :
                ?>
                <div class="article-list-empty">
                    <svg viewBox="0 0 24 24" width="48" height="48">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        <polyline points="14 2 14 8 20 8" fill="none" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    <p>暂无文章</p>
                </div>
                <?php
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </section>

        <!-- 底部区域 -->
        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-logo"><?php echo strtoupper(get_bloginfo("name")); ?></div>
                <div class="footer-text">&copy; <?php echo date("Y"); ?> <?php echo get_bloginfo("name"); ?>. All rights reserved.</div>
            </div>
        </footer>
    </div>

    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/side-nav.js"></script>
    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/mobile-nav.js"></script>
</body>
</html>
