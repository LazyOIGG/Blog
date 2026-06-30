<?php
/**
 * Template Name: Blog
 * Description: 个人博客主页
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo("name"); ?> - Blog</title>
    <!-- CSS 模块 -->
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/variables.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/loading.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/main-banner.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/article.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/section.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/footer.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/animations.css">
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
    </style>
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/side-nav.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/mobile-nav.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/dark-mode.css">
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/secret-link.css">
</head>
<body>
    <!-- 立即检查：非首次访问时隐藏加载界面，避免闪烁 -->
    <script>
        (function() {
            var hasVisited = sessionStorage.getItem('blog_loading_shown');
            if (hasVisited) {
                // 在页面渲染前添加样式，隐藏加载界面
                var style = document.createElement('style');
                style.textContent = '.loading-screen, .progress-container, .progress-text, .progress-dot, .progress-label { display: none !important; } .main-content { opacity: 1 !important; visibility: visible !important; }';
                document.head.appendChild(style);
            }
        })();
    </script>

    <!-- 左侧进度条 - 紧贴浏览器左边缘 -->
    <div class="progress-container" id="progressContainer">
        <div class="progress-bar-track">
            <div class="progress-bar" id="progressBar"></div>
            <div class="progress-dot" id="progressDot"></div>
        </div>
    </div>
    <div class="progress-text" id="progressText">0%</div>
    <!-- 加载界面 -->
    <div class="loading-screen" id="loadingScreen">
        <div class="hud-elements">
        </div>
        <div class="loading-slogan">OVER THE FRONTIER/INTO THE FRONT</div>
    </div>

    <!-- 黄色遮罩（独立于加载界面，用于转场动画） -->
    <div class="wipe-mask" id="wipeMask"></div>

    <!-- 主页面内容 -->
    <div class="main-content" id="mainContent">
        <!-- 竖屏模式顶部导航栏（汉堡菜单） -->
        <nav class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-logo">
                <span class="mobile-nav-logo-text">NCYOIGG</span>
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
                    <a href="#home" class="mobile-nav-item" data-section="home">
                        <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Home</span>
                    </a>
                    <a href="#articles" class="mobile-nav-item" data-section="articles">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <span>Articles</span>
                    </a>
                    <a href="#projects" class="mobile-nav-item" data-section="projects">
                        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        <span>Projects</span>
                    </a>
                    <a href="#about" class="mobile-nav-item" data-section="about">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>About</span>
                    </a>
                    <a href="#contact" class="mobile-nav-item" data-section="contact">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>Contact</span>
                    </a>
                </div>

                <div class="mobile-nav-divider"></div>

                <!-- Quick Tools -->
                <div class="mobile-nav-section">
                    <div class="mobile-nav-section-label">Quick Tools</div>
                    <a href="#language" class="mobile-nav-item" data-section="language">
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
                <a href="#home" class="nav-item active" data-section="home">
                    <div class="nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <span class="nav-label">Home</span>
                    <span class="nav-tooltip">Home</span>
                </a>
                <a href="#articles" class="nav-item" data-section="articles">
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
                <a href="#projects" class="nav-item" data-section="projects">
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
                <a href="#about" class="nav-item" data-section="about">
                    <div class="nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <span class="nav-label">About</span>
                    <span class="nav-tooltip">About</span>
                </a>
                <a href="#contact" class="nav-item" data-section="contact">
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
                <a href="#language" class="nav-item" data-section="language">
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

        <!-- 页面主标题区域 -->
        <section class="main-banner" id="home">
            <div class="main-banner-content">
                <div class="main-banner-tag" id="bannerTag">PERSONAL BLOG</div>
                <h1 class="main-banner-title">
                    <span class="main-banner-title-line" id="bannerLine1">///</span>
                    <span class="main-banner-title-line accent" id="bannerLine2">NCY</span>
                    <span class="main-banner-title-line" id="bannerLine3">OIGG</span>
                </h1>
                <p class="main-banner-description" id="bannerDesc">
                    探索工业设计与未来科技，记录创意灵感与技术实践
                </p>
            </div>
            <div class="main-banner-decoration">
                <div class="deco-line"></div>
                <div class="deco-line"></div>
                <div class="deco-line"></div>
            </div>
        </section>

        <!-- 文章详情区域 -->
        <section class="article-section" id="articles">
            <div class="article-section-header fade-in">
                <div class="section-header-content">
                    <h2 class="section-title">ARTICLES</h2>
                    <p class="section-subtitle">最新文章</p>
                </div>
                <a href="<?php echo home_url('/?section=articles'); ?>" class="view-more-btn">
                    <span>VIEW ALL</span>
                    <svg viewBox="0 0 24 24" width="16" height="16">
                        <path d="M5 12h14M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
            <?php
            // 获取最新文章
            $args = array(
                'posts_per_page' => 1,
                'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="article-container">
                <!-- 左侧信息栏 -->
                <div class="article-sidebar">
                    <div class="article-meta">
                        <div class="article-date"><?php echo get_the_date("Y.m.d"); ?></div>
                        <div class="article-tags">
                            <?php
                            $tags = get_the_tags();
                            if ($tags) {
                                foreach ($tags as $tag) {
                                    echo '<span class="tag">' . esc_html($tag->name) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="article-author">
                        <div class="author-avatar">
                            <img src="<?php echo content_url('/mu-plugins/blog-custom/static/images/avator.png'); ?>" alt="博主头像">
                        </div>
                        <div class="author-info">
                            <div class="author-name"><?php the_author(); ?></div>
                            <div class="author-role">博主</div>
                        </div>
                    </div>
                </div>

                <!-- 右侧内容栏 -->
                <div class="article-content">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="article-image-wrapper">
                        <?php the_post_thumbnail('full', array('class' => 'article-image')); ?>
                    </div>
                    <?php endif; ?>

                    <!-- 正文区域 -->
                    <div class="article-body">
                        <h1 class="article-title"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            // 没有文章时显示预设内容
            ?>
            <div class="article-container">
                <div class="article-sidebar">
                    <div class="article-meta">
                        <div class="article-date"><?php echo date("Y.m.d"); ?></div>
                    </div>
                </div>
                <div class="article-content">
                    <div class="article-body article-empty">
                        <div class="article-empty-icon">
                            <svg viewBox="0 0 24 24" width="64" height="64">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                <polyline points="14 2 14 8 20 8" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="1.5"/>
                                <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="1.5"/>
                                <polyline points="10 9 9 9 8 9" fill="none" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                        </div>
                        <h1 class="article-title">暂无文章</h1>
                        <p class="article-empty-text">这里还没有发布任何文章，请稍后再来看看吧。</p>
                        <div class="article-empty-divider"></div>
                        <p class="article-empty-hint">期待精彩内容即将呈现...</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- View More 按钮 -->
            <div class="section-view-more">
                <a href="<?php echo home_url('/?section=articles'); ?>" class="view-more-btn">
                    <span>VIEW ALL ARTICLES</span>
                    <svg viewBox="0 0 24 24" width="16" height="16">
                        <path d="M5 12h14M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
        </section>

        <!-- Projects 区域 -->
        <section class="projects-section" id="projects">
            <div class="projects-container">
                <div class="projects-header fade-in">
                    <div class="section-header-content">
                        <h2 class="section-title">PROJECTS</h2>
                        <p class="section-subtitle">个人项目与开源贡献</p>
                    </div>
                    <a href="<?php echo home_url('/?section=projects'); ?>" class="view-more-btn">
                        <span>VIEW ALL</span>
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path d="M5 12h14M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                </div>

                <div class="projects-grid">
                    <!-- 预设项目卡片 1 -->
                    <div class="project-card fade-in">
                        <div class="project-card-image">
                            <div class="project-card-placeholder">
                                <svg viewBox="0 0 24 24" width="48" height="48">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="1.5"/>
                                    <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="project-card-content">
                            <div class="project-card-tag">COMMING SOON</div>
                            <h3 class="project-card-title">Blog Theme</h3>
                            <p class="project-card-desc">工业科幻风格的个人博客主题，基于 WordPress 自定义开发。</p>
                            <div class="project-card-footer">
                                <span class="project-card-lang">
                                    <span class="lang-dot php"></span>PHP
                                </span>
                                <span class="project-card-lang">
                                    <span class="lang-dot css"></span>CSS
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 预设项目卡片 2 -->
                    <div class="project-card fade-in">
                        <div class="project-card-image">
                            <div class="project-card-placeholder">
                                <svg viewBox="0 0 24 24" width="48" height="48">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M2 17l10 5 10-5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M2 12l10 5 10-5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="project-card-content">
                            <div class="project-card-tag">COMMING SOON</div>
                            <h3 class="project-card-title">UI Component Library</h3>
                            <p class="project-card-desc">面向未来的工业设计组件库，支持深色模式与动态主题。</p>
                            <div class="project-card-footer">
                                <span class="project-card-lang">
                                    <span class="lang-dot js"></span>JavaScript
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 预设项目卡片 3 -->
                    <div class="project-card fade-in">
                        <div class="project-card-image">
                            <div class="project-card-placeholder">
                                <svg viewBox="0 0 24 24" width="48" height="48">
                                    <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M12 6v6l4 2" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="project-card-content">
                            <div class="project-card-tag">PLANNING</div>
                            <h3 class="project-card-title">Open Source Tools</h3>
                            <p class="project-card-desc">为开发者打造的效率工具集，提升开发体验与工作流程。</p>
                            <div class="project-card-footer">
                                <span class="project-card-lang">
                                    <span class="lang-dot py"></span>Python
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="projects-empty-hint fade-in">
                    <span class="hint-line"></span>
                    <span class="hint-text">更多项目开发中，敬请期待...</span>
                    <span class="hint-line"></span>
                </div>
            </div>
        </section>

        <!-- About 区域 -->
        <section class="about-section" id="about">
            <div class="about-container">
                <div class="about-header fade-in">
                    <div class="section-header-content">
                        <h2 class="section-title">ABOUT</h2>
                        <p class="section-subtitle">关于我</p>
                    </div>
                    <div class="about-actions">
                        <a href="<?php echo home_url('/?section=about'); ?>" class="view-more-btn" id="aboutViewMoreLink">
                            <span>VIEW MORE</span>
                            <svg viewBox="0 0 24 24" width="16" height="16">
                                <path d="M5 12h14M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </a>
                        <button class="secret-heart-trigger" id="secretHeartTrigger" type="button" aria-label="hidden signal" data-about-url="<?php echo home_url('/?section=about'); ?>" data-secret-url="<?php echo home_url('/?section=secret'); ?>">
                            <svg viewBox="0 0 24 24" width="15" height="15" aria-hidden="true">
                                <path d="M12 20s-6.5-3.9-9-8.3C.8 7.8 3.1 4 6.7 4c2 0 3.4 1.1 4.2 2.3C11.7 5.1 13.1 4 15.1 4c3.6 0 5.9 3.8 3.7 7.7C16.5 16.1 12 20 12 20z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="about-content">
                    <!-- 左侧头像区域 -->
                    <div class="about-avatar-section fade-in">
                        <div class="about-avatar">
                            <img src="<?php echo content_url('/mu-plugins/blog-custom/static/images/avator.png'); ?>" alt="博主头像">
                        </div>
                        <div class="about-stats">
                            <div class="stat-item">
                                <div class="stat-value">LazyOIGG</div>
                                <div class="stat-label">GitHub Username</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">ncyoigg</div>
                                <div class="stat-label">Blog Author</div>
                            </div>
                        </div>
                    </div>

                    <!-- 右侧介绍区域 -->
                    <div class="about-text-section fade-in">
                        <div class="about-bio">
                            <h3 class="about-bio-title">Hi, I'm NCYOIGG 👋</h3>
                            <p class="about-bio-text">
                                欢迎来到我的个人博客！我是一名热爱技术、追求创新的全栈开发者。
                            </p>
                            <p class="about-bio-text">
                                我热衷于探索前后端技术的融合，喜欢用代码构建优雅的解决方案。
                                从工业科幻风格的界面设计到高效的后端架构，我始终保持着对技术的热爱与好奇。
                            </p>
                            <p class="about-bio-text">
                                在这里，我会分享我的开发笔记、项目实践以及对技术趋势的思考，
                                希望能与更多开发者交流学习，共同成长。
                            </p>
                        </div>

                        <div class="about-skills">
                            <h4 class="about-skills-title">技术栈</h4>
                            <div class="skills-grid">
                                <div class="skill-item">
                                    <span class="skill-name">SpringBoot</span>
                                    <div class="skill-bar"><div class="skill-fill" style="width: 80%"></div></div>
                                </div>
                                <div class="skill-item">
                                    <span class="skill-name">Python</span>
                                    <div class="skill-bar"><div class="skill-fill" style="width: 75%"></div></div>
                                </div>
                                <div class="skill-item">
                                    <span class="skill-name">Vue3</span>
                                    <div class="skill-bar"><div class="skill-fill" style="width: 85%"></div></div>
                                </div>
                                <div class="skill-item">
                                    <span class="skill-name">H5</span>
                                    <div class="skill-bar"><div class="skill-fill" style="width: 90%"></div></div>
                                </div>
                                <div class="skill-item">
                                    <span class="skill-name">PHP</span>
                                    <div class="skill-bar"><div class="skill-fill" style="width: 70%"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact 区域 -->
        <section class="contact-section" id="contact">
            <div class="contact-container">
                <div class="contact-header fade-in">
                    <div class="section-header-content">
                        <h2 class="section-title">CONTACT</h2>
                        <p class="section-subtitle">联系方式</p>
                    </div>
                </div>
                <div class="contact-view-more">
                    <a href="<?php echo home_url('/?section=contact'); ?>" class="view-more-btn">
                        <span>VIEW MORE</span>
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path d="M5 12h14M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                </div>

                <div class="contact-content fade-in">
                    <div class="contact-cards">
                        <!-- 邮箱卡片 -->
                        <div class="contact-card">
                            <div class="contact-card-icon">
                                <svg viewBox="0 0 24 24" width="32" height="32">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <polyline points="22,6 12,13 2,6" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <div class="contact-card-content">
                                <div class="contact-card-label">Email</div>
                                <div class="contact-card-value" data-email="ncyoigg@qq.com">ncyoigg@qq.com</div>
                                <div class="contact-card-hint">点击复制邮箱地址</div>
                            </div>
                        </div>

                        <!-- GitHub 卡片 -->
                        <div class="contact-card">
                            <div class="contact-card-icon">
                                <svg viewBox="0 0 24 24" width="32" height="32">
                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <div class="contact-card-content">
                                <div class="contact-card-label">GitHub</div>
                                <a href="https://github.com/LazyOIGG" target="_blank" class="contact-card-value contact-card-link">LazyOIGG</a>
                                <div class="contact-card-hint">查看我的开源项目</div>
                            </div>
                        </div>

                        <!-- Bilibili 卡片 -->
                        <div class="contact-card">
                            <div class="contact-card-icon">
                                <svg viewBox="0 0 24 24" width="32" height="32">
                                    <rect x="2" y="2" width="20" height="20" rx="5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M7 7l3 3-3 3" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M17 7l-3 3 3 3" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <line x1="10" y1="13" x2="14" y2="13" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <div class="contact-card-content">
                                <div class="contact-card-label">Bilibili</div>
                                <a href="https://space.bilibili.com/183373315" target="_blank" class="contact-card-value contact-card-link">NCYOIGG</a>
                                <div class="contact-card-hint">关注我的动态</div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-message">
                        <p>欢迎通过以上方式与我取得联系，期待与你的交流！</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 底部区域 -->
        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-logo"><?php echo strtoupper(get_bloginfo("name")); ?></div>
                <div class="footer-text">&copy; <?php echo date("Y"); ?> Industrial Blog. All rights reserved.</div>
            </div>
        </footer>
    </div>

    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/main.js"></script>
    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/side-nav.js"></script>
    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/mobile-nav.js"></script>
    <script src="<?php echo content_url("/mu-plugins/blog-custom/js"); ?>/secret-link.js"></script>
</body>
</html>
