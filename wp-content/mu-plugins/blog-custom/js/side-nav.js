/**
 * 侧边导航栏
 * 工业科幻风格导航系统
 */

class SideNav {
    constructor() {
        this.sidebar = null;
        this.isExpanded = false;
        this.expandTimeout = null;
        this.collapseTimeout = null;
        this.activeSection = 'home';

        this.init();
    }

    init() {
        this.sidebar = document.querySelector('.side-nav');
        if (!this.sidebar) return;

        this.restoreDarkMode();
        this.bindEvents();
        this.setActiveItem();
        this.initScanLine();

        console.log('[SideNav] Initialized');
    }

    bindEvents() {
        // Hover expand/collapse
        this.sidebar.addEventListener('mouseenter', () => this.handleMouseEnter());
        this.sidebar.addEventListener('mouseleave', () => this.handleMouseLeave());

        // Nav items click
        const navItems = this.sidebar.querySelectorAll('.nav-item[href]');
        navItems.forEach(item => {
            item.addEventListener('click', (e) => this.handleNavClick(e, item));
        });

        // Dark Mode 三态开关
        const darkModeItem = this.sidebar.querySelector('.nav-dark-mode');
        if (darkModeItem) {
            this.initDarkModeSwitch(darkModeItem);
        }

        // Music 开关
        const musicItem = this.sidebar.querySelector('.nav-music');
        if (musicItem) {
            this.initMusicSwitch(musicItem);
        }

        // 社交链接
        this.initSocialLinks();

        // Toggle button
        const toggleBtn = this.sidebar.querySelector('.nav-toggle-btn');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleSidebar());
        }
    }

    handleMouseEnter() {
        clearTimeout(this.collapseTimeout);
        this.expandTimeout = setTimeout(() => {
            this.expand();
        }, 100);
    }

    handleMouseLeave() {
        clearTimeout(this.expandTimeout);
        this.collapseTimeout = setTimeout(() => {
            this.collapse();
        }, 300);
    }

    expand() {
        if (this.isExpanded) return;
        this.isExpanded = true;
        this.sidebar.classList.add('expanded');
        document.body.classList.add('sidebar-expanded');
        
        // Trigger stagger animation
        this.animateLabels();
    }

    collapse() {
        if (!this.isExpanded) return;
        this.isExpanded = false;
        this.sidebar.classList.remove('expanded');
        document.body.classList.remove('sidebar-expanded');
    }

    toggleSidebar() {
        if (this.isExpanded) {
            this.collapse();
        } else {
            this.expand();
        }
    }

    animateLabels() {
        const labels = this.sidebar.querySelectorAll('.nav-label');
        labels.forEach((label, index) => {
            label.style.transitionDelay = `${index * 0.02}s`;
        });
    }

    handleNavClick(e, item) {
        // Remove active from all
        const allItems = this.sidebar.querySelectorAll('.nav-item');
        allItems.forEach(i => i.classList.remove('active'));

        // Add active to clicked
        item.classList.add('active');

        // Get section
        const section = item.dataset.section;
        if (section) {
            this.activeSection = section;
            this.scrollToSection(section);
        }

        // Play click sound (optional)
        this.playClickSound();
    }

    scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }

    setActiveItem() {
        // Set based on current scroll position
        const sections = document.querySelectorAll('section[id]');
        const navItems = this.sidebar.querySelectorAll('.nav-item[data-section]');
        const mainContent = document.querySelector('.main-content');

        if (!mainContent || sections.length === 0) return;

        // 使用滚动事件来检测当前区域
        let ticking = false;

        const updateActiveSection = () => {
            const scrollTop = mainContent.scrollTop || window.scrollY;
            const windowHeight = window.innerHeight;
            const scrollMiddle = scrollTop + windowHeight / 2;

            let currentSection = null;
            let minDistance = Infinity;

            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                const sectionTop = scrollTop + rect.top;
                const sectionMiddle = sectionTop + rect.height / 2;
                const distance = Math.abs(scrollMiddle - sectionMiddle);

                // 检查区域是否在视口内
                if (rect.top < windowHeight && rect.bottom > 0) {
                    if (distance < minDistance) {
                        minDistance = distance;
                        currentSection = section.id;
                    }
                }
            });

            if (currentSection) {
                navItems.forEach(item => {
                    const isActive = item.dataset.section === currentSection;
                    item.classList.toggle('active', isActive);
                });
            }
        };

        // 使用 IntersectionObserver 作为备份
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navItems.forEach(item => {
                        if (item.dataset.section === id) {
                            item.classList.add('active');
                        }
                    });
                }
            });
        }, {
            threshold: 0,
            rootMargin: '-20% 0px -20% 0px'
        });

        sections.forEach(section => observer.observe(section));

        // 滚动事件监听
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateActiveSection();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // 初始设置
        updateActiveSection();
    }

    handleToggle(toggle) {
        const action = toggle.dataset.action;

        if (action === 'darkMode') {
            // 三态开关处理
            this.initDarkModeSwitch(toggle);
        } else if (action === 'music') {
            // Music 开关处理
            this.initMusicSwitch(toggle);
        }

        this.playClickSound();
    }

    initDarkModeSwitch(item) {
        const buttons = item.querySelectorAll('.nav-tri-state-btn');
        const icons = {
            off: item.querySelector('.nav-dark-icon.off'),
            system: item.querySelector('.nav-dark-icon.system'),
            on: item.querySelector('.nav-dark-icon.on')
        };

        // 初始化图标显示
        this.updateDarkModeIcon(buttons, icons);

        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const value = btn.dataset.value;
                console.log('[SideNav] Dark Mode:', value);

                // 更新收缩状态下的图标
                this.updateDarkModeIcon(buttons, icons);

                // 保存到 localStorage
                localStorage.setItem('darkMode', value);

                if (value === 'on') {
                    document.body.classList.add('dark-mode');
                } else if (value === 'off') {
                    document.body.classList.remove('dark-mode');
                } else if (value === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (prefersDark) {
                        document.body.classList.add('dark-mode');
                    } else {
                        document.body.classList.remove('dark-mode');
                    }
                }
            });
        });
    }

    updateDarkModeIcon(buttons, icons) {
        // 隐藏所有图标
        Object.values(icons).forEach(icon => {
            if (icon) icon.style.display = 'none';
        });

        // 找到当前激活的按钮并显示对应图标
        const activeBtn = document.querySelector('.nav-tri-state-btn.active');
        if (activeBtn) {
            const value = activeBtn.dataset.value;
            if (icons[value]) {
                icons[value].style.display = 'block';
            }
        }
    }

    // 从 localStorage 恢复暗色模式状态
    restoreDarkMode() {
        const saved = localStorage.getItem('darkMode');

        // 设置按钮激活状态
        const darkModeItem = this.sidebar.querySelector('.nav-dark-mode');
        if (darkModeItem) {
            const buttons = darkModeItem.querySelectorAll('.nav-tri-state-btn');
            buttons.forEach(b => b.classList.remove('active'));

            // 如果没有保存的设置，默认使用 system
            const mode = saved || 'system';
            const targetBtn = darkModeItem.querySelector(`.nav-tri-state-btn[data-value="${mode}"]`);
            if (targetBtn) targetBtn.classList.add('active');

            // 更新图标
            const icons = {
                off: darkModeItem.querySelector('.nav-dark-icon.off'),
                system: darkModeItem.querySelector('.nav-dark-icon.system'),
                on: darkModeItem.querySelector('.nav-dark-icon.on')
            };
            this.updateDarkModeIcon(buttons, icons);
        }

        // 应用暗色模式（默认跟随系统）
        const mode = saved || 'system';
        if (mode === 'on') {
            document.body.classList.add('dark-mode');
        } else if (mode === 'system') {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDark) document.body.classList.add('dark-mode');
        }

        // 监听系统主题变化
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            const currentMode = localStorage.getItem('darkMode') || 'system';
            if (currentMode === 'system') {
                if (e.matches) {
                    document.body.classList.add('dark-mode');
                } else {
                    document.body.classList.remove('dark-mode');
                }
            }
        });
    }

    initMusicSwitch(item) {
        // 收缩时点击状态图标切换
        const statusIcon = item.querySelector('.nav-music-status');
        if (statusIcon) {
            statusIcon.addEventListener('click', (e) => {
                e.stopPropagation();
                item.classList.toggle('active');
                const isActive = item.classList.contains('active');
                console.log('[SideNav] Music:', isActive ? 'on' : 'off');
            });
        }

        // 展开时点击开关切换
        const switchTrack = item.querySelector('.nav-music-switch-track');
        if (switchTrack) {
            switchTrack.addEventListener('click', (e) => {
                e.stopPropagation();
                item.classList.toggle('active');
                const isActive = item.classList.contains('active');
                console.log('[SideNav] Music:', isActive ? 'on' : 'off');
            });
        }
    }

    initSocialLinks() {
        const socialItems = this.sidebar.querySelectorAll('.nav-social');
        socialItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const email = item.dataset.email;
                if (email) {
                    navigator.clipboard.writeText(email).then(() => {
                        this.showToast('邮箱已复制: ' + email);
                    }).catch(() => {
                        this.showToast('邮箱: ' + email);
                    });
                }
            });
        });
    }

    showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'nav-toast';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => toast.classList.add('show'), 10);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    initScanLine() {
        // Scan line is handled by CSS animation
    }

    playClickSound() {
        // Optional: play mechanical click sound
        try {
            const audio = new Audio('data:audio/wav;base64,UklGRl9vT19teleGFtcGxlAAAA');
            audio.volume = 0.1;
            audio.play().catch(() => {});
        } catch (e) {
            // Ignore audio errors
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.sideNav = new SideNav();
});
