<?php
/**
 * Template Name: Industrial Sci-Fi Blog
 * Description: 极简工业文艺风个人博客
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo("name"); ?> - Industrial Blog</title>
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom"); ?>/main-blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body, html { margin: 0 !important; padding: 0 !important; }
    </style>
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom"); ?>/arknights-sidebar.css">
</head>
<body>
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
        <div class="wipe-mask" id="wipeMask"></div>
    </div>

    <!-- 主页面内容 -->
    <div class="main-content" id="mainContent">
        <!-- 左侧固定侧边导航栏 -->
            <!-- Arknights Endfield Inspired Sidebar -->
    <nav class="ak-sidebar" id="sidebarNav">
        <!-- HUD Decorations -->
        <div class="ak-hud-corner top-left"></div>
        <div class="ak-hud-corner top-right"></div>
        <div class="ak-hud-corner bottom-left"></div>
        <div class="ak-hud-corner bottom-right"></div>
        <div class="ak-scan-line"></div>
        <div class="ambient-glow"></div>
        
        <!-- Logo -->
        <div class="ak-sidebar-logo">
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
        <div class="ak-sidebar-menu">
            <!-- Navigation Section -->
            <div class="ak-nav-section">
                <div class="ak-section-label">Navigation</div>
                <a href="#home" class="ak-nav-item active" data-section="home">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Home</span>
                    <span class="ak-tooltip">Home</span>
                </a>
                <a href="#articles" class="ak-nav-item" data-section="articles">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Articles</span>
                    <span class="ak-tooltip">Articles</span>
                </a>
                <a href="#projects" class="ak-nav-item" data-section="projects">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Projects</span>
                    <span class="ak-tooltip">Projects</span>
                </a>
                <a href="#about" class="ak-nav-item" data-section="about">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">About</span>
                    <span class="ak-tooltip">About</span>
                </a>
                <a href="#contact" class="ak-nav-item" data-section="contact">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Contact</span>
                    <span class="ak-tooltip">Contact</span>
                </a>
            </div>
            
            <div class="ak-nav-divider"></div>
            
            <!-- Explore Section -->
            <div class="ak-nav-section">
                <div class="ak-section-label">Explore</div>
                <a href="#search" class="ak-nav-item" data-section="search">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Search</span>
                    <span class="ak-tooltip">Search</span>
                </a>
                <a href="#categories" class="ak-nav-item" data-section="categories">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <line x1="8" y1="6" x2="21" y2="6"/>
                            <line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                            <line x1="3" y1="6" x2="3.01" y2="6"/>
                            <line x1="3" y1="12" x2="3.01" y2="12"/>
                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Categories</span>
                    <span class="ak-tooltip">Categories</span>
                </a>
                <a href="#timeline" class="ak-nav-item" data-section="timeline">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Timeline</span>
                    <span class="ak-tooltip">Timeline</span>
                </a>
                <a href="#featured" class="ak-nav-item" data-section="featured">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Featured</span>
                    <span class="ak-tooltip">Featured</span>
                </a>
            </div>
            
            <div class="ak-nav-divider"></div>
            
            <!-- Developer Center -->
            <div class="ak-nav-section">
                <div class="ak-section-label">Developer</div>
                <a href="#github" class="ak-nav-item" data-section="github">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">GitHub</span>
                    <span class="ak-tooltip">GitHub</span>
                </a>
                <a href="#opensource" class="ak-nav-item" data-section="opensource">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Open Source</span>
                    <span class="ak-tooltip">Open Source</span>
                </a>
                <a href="#techstack" class="ak-nav-item" data-section="techstack">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <polyline points="16 18 22 12 16 6"/>
                            <polyline points="8 6 2 12 8 18"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Tech Stack</span>
                    <span class="ak-tooltip">Tech Stack</span>
                </a>
                <a href="#lab" class="ak-nav-item" data-section="lab">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 3h6v11l4 8H5l4-8V3z"/>
                            <line x1="9" y1="3" x2="15" y2="3"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Lab</span>
                    <span class="ak-tooltip">Lab</span>
                </a>
            </div>
            
            <div class="ak-nav-divider"></div>
            
            <!-- Quick Tools -->
            <div class="ak-nav-section">
                <div class="ak-section-label">Quick Tools</div>
                <a href="#language" class="ak-nav-item" data-section="language">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Language</span>
                    <span class="ak-tooltip">Language</span>
                </a>
                <a href="#stats" class="ak-nav-item" data-section="stats">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <line x1="18" y1="20" x2="18" y2="10"/>
                            <line x1="12" y1="20" x2="12" y2="4"/>
                            <line x1="6" y1="20" x2="6" y2="14"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Site Stats</span>
                    <span class="ak-tooltip">Site Stats</span>
                </a>
                <a href="#settings" class="ak-nav-item" data-section="settings">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Settings</span>
                    <span class="ak-tooltip">Settings</span>
                </a>
                <div class="ak-toggle-switch" data-action="darkMode">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Dark Mode</span>
                    <div class="ak-switch-track active">
                        <div class="ak-switch-thumb"></div>
                    </div>
                </div>
                <div class="ak-toggle-switch" data-action="music">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 18V5l12-2v13"/>
                            <circle cx="6" cy="18" r="3"/>
                            <circle cx="18" cy="16" r="3"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Music</span>
                    <div class="ak-switch-track">
                        <div class="ak-switch-thumb"></div>
                    </div>
                </div>
            </div>
            
            <div class="ak-nav-divider"></div>
            
            <!-- Social -->
            <div class="ak-nav-section">
                <div class="ak-section-label">Social</div>
                <a href="#github" class="ak-nav-item" data-section="github">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">GitHub</span>
                    <span class="ak-tooltip">GitHub</span>
                </a>
                <a href="#twitter" class="ak-nav-item" data-section="twitter">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">X</span>
                    <span class="ak-tooltip">X (Twitter)</span>
                </a>
                <a href="#email" class="ak-nav-item" data-section="email">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Email</span>
                    <span class="ak-tooltip">Email</span>
                </a>
                <a href="#bilibili" class="ak-nav-item" data-section="bilibili">
                    <div class="ak-nav-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <path d="M7 7l3 3-3 3"/>
                            <path d="M17 7l-3 3 3 3"/>
                            <line x1="10" y1="13" x2="14" y2="13"/>
                        </svg>
                    </div>
                    <span class="ak-nav-label">Bilibili</span>
                    <span class="ak-tooltip">Bilibili</span>
                </a>
            </div>
            
            <!-- Data Readout -->
            <div class="ak-data-readout">
                SYS: <span class="data-value">ONLINE</span> | v2.0
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="ak-sidebar-bottom">
            <button class="ak-toggle-btn">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
        </div>
    </nav>

        <!-- 页面主标题区域 -->
        <section class="hero-section" id="home">
            <div class="hero-content">
                <div class="hero-tag" id="heroTag">PERSONAL BLOG</div>
                <h1 class="hero-title">
                    <span class="hero-title-line" id="heroLine1">///</span>
                    <span class="hero-title-line accent" id="heroLine2">NCY</span>
                    <span class="hero-title-line" id="heroLine3">OIGG</span>
                </h1>
                <p class="hero-description" id="heroDesc">
                    探索工业设计与未来科技，记录创意灵感与技术实践
                </p>
            </div>
            <div class="hero-decoration">
                <div class="deco-line"></div>
                <div class="deco-line"></div>
                <div class="deco-line"></div>
            </div>
        </section>

        <!-- 文章详情区域 -->
        <section class="article-section" id="articles">
            <div class="article-container">
                <!-- 左侧文字栏 -->
                <div class="article-sidebar">
                    <div class="article-meta">
                        <div class="article-subtitle">FEATURED ARTICLE</div>
                        <div class="article-date"><?php echo date("Y.m.d"); ?></div>
                        <div class="article-tags">
                            <span class="tag">工业设计</span>
                            <span class="tag">未来科技</span>
                            <span class="tag">UI/UX</span>
                        </div>
                    </div>
                    <p class="article-intro">
                        探索工业美学与未来科技的完美融合，
                        记录从概念到落地的设计思考与实践。
                    </p>
                    <div class="decoration-bars">
                        <div class="deco-bar"></div>
                        <div class="deco-bar"></div>
                        <div class="deco-bar"></div>
                        <div class="deco-bar"></div>
                    </div>
                </div>
                
                <!-- 右侧内容栏 -->
                <div class="article-content">
                    <div class="article-image-wrapper">
                        <div class="article-image"></div>
                        <div class="image-decoration">
                            <span class="deco-text">INDUSTRIAL DESIGN</span>
                        </div>
                    </div>
                    <div class="image-nav">
                        <button class="image-nav-btn">
                            <svg viewBox="0 0 24 24">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="image-nav-btn">
                            <svg viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- 正文区域 -->
                    <div class="article-body">
                        <h2>设计理念</h2>
                        <p>
                            工业设计不仅仅是外观的美化，更是功能与形式的完美统一。
                            在这个数字化时代，我们追求的是将精密机械的严谨与数字艺术的灵动相结合，
                            创造出既实用又美观的作品。
                        </p>
                        <h3>核心原则</h3>
                        <p>
                            每一个设计决策都源于对用户需求的深刻理解。
                            我们相信，好的设计应该是隐形的——它自然地融入用户的生活，
                            让复杂的操作变得简单直观。
                        </p>
                        <blockquote>
                            "设计不是装饰，而是将复杂的事物变得简洁明了。"
                        </blockquote>
                        <h3>技术实践</h3>
                        <p>
                            在技术实现上，我们采用最新的前端技术和设计理念。
                            从响应式布局到微交互设计，每一个细节都经过精心打磨，
                            确保在不同设备和场景下都能提供最佳的用户体验。
                        </p>
                        <p>
                            未来，我们将继续探索工业设计与人工智能、
                            物联网等新兴技术的融合，创造更多令人惊叹的作品。
                        </p>
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

    <script src="<?php echo content_url("/mu-plugins/blog-custom"); ?>/main-blog.js"></script>
    <script src="<?php echo content_url("/mu-plugins/blog-custom"); ?>/arknights-sidebar.js"></script>
</body>
</html>