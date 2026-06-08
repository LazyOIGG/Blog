// ==================== 竖屏模式导航栏交互 ====================

class MobileNav {
    constructor() {
        this.toggle = document.getElementById('mobileNavToggle');
        this.menu = document.getElementById('mobileNavMenu');
        this.menuClose = document.getElementById('mobileNavMenuClose');
        this.navItems = document.querySelectorAll('.mobile-nav-item[href]');

        this.init();
    }

    init() {
        // 汉堡按钮点击事件
        if (this.toggle) {
            this.toggle.addEventListener('click', () => this.openMenu());
        }

        // 关闭按钮点击事件
        if (this.menuClose) {
            this.menuClose.addEventListener('click', () => this.closeMenu());
        }

        // 点击遮罩关闭菜单
        if (this.menu) {
            this.menu.addEventListener('click', (e) => {
                if (e.target === this.menu) {
                    this.closeMenu();
                }
            });
        }

        // 导航项点击事件（仅对有 href 的项）
        this.navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = item.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    this.closeMenu();
                    // 延迟滚动，等待菜单关闭动画
                    setTimeout(() => {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }, 300);
                }
            });
        });

        // 三态开关（Dark Mode）
        this.initTriStateSwitches();

        // 开关（Music）
        this.initToggleSwitches();

        // 监听屏幕方向变化
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && window.orientation === 90) {
                this.closeMenu();
            }
        });

        // 初始化导航项高亮
        this.initActiveState();
    }

    initTriStateSwitches() {
        const triStateItems = document.querySelectorAll('.mobile-nav-dark-mode');
        triStateItems.forEach(item => {
            const buttons = item.querySelectorAll('.mobile-nav-tri-state-btn');
            buttons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const value = btn.dataset.value;
                    console.log('[MobileNav] Dark Mode:', value);

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
        });
    }

    initToggleSwitches() {
        const toggleItems = document.querySelectorAll('.mobile-nav-music');
        toggleItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();
                item.classList.toggle('active');
                const isActive = item.classList.contains('active');
                console.log('[MobileNav] Music:', isActive ? 'on' : 'off');
            });
        });
    }

    openMenu() {
        this.toggle.classList.add('active');
        this.menu.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    closeMenu() {
        this.toggle.classList.remove('active');
        this.menu.classList.remove('active');
        document.body.style.overflow = '';
    }

    initActiveState() {
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            this.navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });
    }
}

// 初始化
document.addEventListener('DOMContentLoaded', () => {
    new MobileNav();
});
