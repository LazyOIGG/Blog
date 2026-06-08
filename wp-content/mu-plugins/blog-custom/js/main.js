// ==================== 工业科幻博客 - 主脚本 ====================

// DOM 元素
const loadingScreen = document.getElementById('loadingScreen');
const progressBar = document.getElementById('progressBar');
const progressText = document.getElementById('progressText');
const progressDot = document.getElementById('progressDot');
const progressContainer = document.getElementById('progressContainer');
const progressLabel = document.getElementById('progressLabel');
const wipeMask = document.getElementById('wipeMask');
const mainContent = document.getElementById('mainContent');

// 侧边导航
const sidebarNav = document.getElementById('sidebarNav');

// 英雄区域元素
const heroTag = document.getElementById('heroTag');
const heroLine1 = document.getElementById('heroLine1');
const heroLine2 = document.getElementById('heroLine2');
const heroLine3 = document.getElementById('heroLine3');
const heroDesc = document.getElementById('heroDesc');

// ==================== 加载进度模拟 ====================
class LoadingSequence {
    constructor() {
        this.progress = 0;
        this.targetProgress = 0;
        this.isLoading = true;
        this.loadingDuration = 3000; // 3秒加载时间
        this.startTime = null;

        this.init();
    }

    init() {
        this.startTime = performance.now();
        this.animate();
    }

    animate() {
        const currentTime = performance.now();
        const elapsed = currentTime - this.startTime;
        const progress = Math.min((elapsed / this.loadingDuration) * 100, 100);

        this.updateProgress(progress);

        if (progress < 100) {
            requestAnimationFrame(() => this.animate());
        } else {
            this.onLoadingComplete();
        }
    }

    updateProgress(progress) {
        this.progress = progress;
        // 从上到下填充
        progressBar.style.height = `${progress}%`;

        // 更新百分比文字
        progressText.textContent = `${Math.round(progress)}%`;

        // 让百分比跟随进度条底部移动（从上到下）
        progressText.style.top = `${progress}%`;
    }

    onLoadingComplete() {
        // 停顿 500ms 给予用户完成确认感
        setTimeout(() => {
            this.startWipeTransition();
        }, 500);
    }

    startWipeTransition() {
        // 先隐藏进度条
        if (progressContainer) progressContainer.style.display = 'none';
        if (progressText) progressText.style.display = 'none';
        if (progressDot) progressDot.style.display = 'none';
        if (progressLabel) progressLabel.style.display = 'none';
        
        // 显示擦除遮罩
        wipeMask.style.display = 'block';

        // 雨刮动画：从左边缘开始，宽度从 0% 扩展到 100%
        const duration = 1200; // 1.2秒转场
        const startTime = performance.now();

        const animateWipe = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // 使用缓动函数让动画更自然
            const eased = this.easeInOutCubic(progress);
            wipeMask.style.width = `${eased * 100}%`;

            if (progress < 1) {
                requestAnimationFrame(animateWipe);
            } else {
                this.onWipeComplete();
            }
        };

        requestAnimationFrame(animateWipe);
    }

    easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    onWipeComplete() {
        // 隐藏加载界面
        loadingScreen.style.display = 'none';

        // 显示主内容
        mainContent.classList.add('visible');

        // 开始页面元素浮现动画
        this.startRevealAnimations();
    }

    startRevealAnimations() {
        // 使用 Stagger 效果依次显示元素
        const revealElements = [
            { element: sidebarNav, delay: 200 },
            { element: heroTag, delay: 400 },
            { element: heroLine1, delay: 600 },
            { element: heroLine2, delay: 800 },
            { element: heroLine3, delay: 1000 },
            { element: heroDesc, delay: 1200 }
        ];

        revealElements.forEach(({ element, delay }) => {
            if (element) {
                setTimeout(() => {
                    element.classList.add('revealed');
                }, delay);
            }
        });

        // 初始化滚动动画
        setTimeout(() => {
            this.initScrollAnimations();
        }, 1500);
    }

    initScrollAnimations() {
        // 创建 Intersection Observer
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            }
        );

        // 观察需要动画的元素
        document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
            observer.observe(el);
        });
    }
}

// ==================== 导航栏交互 ====================
class Navigation {
    constructor() {
        this.init();
    }

    init() {
        // 平滑滚动到锚点
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => this.smoothScroll(e));
        });

        // 侧边栏高亮当前区域
        this.initActiveState();
    }

    smoothScroll(e) {
        e.preventDefault();
        const targetId = e.currentTarget.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            const offsetTop = targetElement.offsetTop;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    }

    initActiveState() {
        const sections = document.querySelectorAll('section[id]');
        const navItems = document.querySelectorAll('.sidebar-item');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });
    }
}

// ==================== 图片画廊 ====================
class ImageGallery {
    constructor() {
        this.currentIndex = 0;
        this.images = [];
        this.init();
    }

    init() {
        // 模拟图片数组
        this.images = [
            { color: '#f0f0f0', text: 'Image 1' },
            { color: '#e0e0e0', text: 'Image 2' },
            { color: '#d0d0d0', text: 'Image 3' }
        ];

        // 绑定翻页按钮
        const prevBtn = document.querySelector('.image-nav-btn:first-child');
        const nextBtn = document.querySelector('.image-nav-btn:last-child');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.prev());
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.next());
        }
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.updateImage();
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.updateImage();
    }

    updateImage() {
        const imageWrapper = document.querySelector('.article-image');
        if (imageWrapper) {
            imageWrapper.style.background = this.images[this.currentIndex].color;
        }
    }
}

// ==================== 性能监控 ====================
class PerformanceMonitor {
    constructor() {
        this.metrics = {
            loadStart: performance.now(),
            domReady: null,
            loadComplete: null
        };

        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.metrics.domReady = performance.now();
            console.log(`DOM 就绪: ${Math.round(this.metrics.domReady - this.metrics.loadStart)}ms`);
        });

        window.addEventListener('load', () => {
            this.metrics.loadComplete = performance.now();
            console.log(`页面加载完成: ${Math.round(this.metrics.loadComplete - this.metrics.loadStart)}ms`);
        });
    }
}

// ==================== 初始化应用 ====================
class App {
    constructor() {
        this.loadingSequence = null;
        this.navigation = null;
        this.imageGallery = null;
        this.performanceMonitor = null;

        this.init();
    }

    init() {
        // 等待 DOM 就绪
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.start());
        } else {
            this.start();
        }
    }

    start() {
        console.log('工业科幻博客系统启动');

        // 初始化性能监控
        this.performanceMonitor = new PerformanceMonitor();

        // 启动加载序列
        this.loadingSequence = new LoadingSequence();

        // 初始化导航
        this.navigation = new Navigation();

        // 初始化图片画廊
        this.imageGallery = new ImageGallery();
    }
}

// ==================== 启动应用 ====================
const app = new App();

// ==================== 导出（如果需要模块化）====================
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        LoadingSequence,
        Navigation,
        ImageGallery,
        PerformanceMonitor,
        App
    };
}