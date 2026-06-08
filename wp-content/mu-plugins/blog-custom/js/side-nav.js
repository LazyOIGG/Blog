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
        const navItems = this.sidebar.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', (e) => this.handleNavClick(e, item));
        });

        // Toggle switches
        const toggles = this.sidebar.querySelectorAll('.nav-toggle-switch');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => this.handleToggle(toggle));
        });

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
        const navItems = this.sidebar.querySelectorAll('.nav-item');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navItems.forEach(item => {
                        item.classList.toggle('active', item.dataset.section === id);
                    });
                }
            });
        }, { threshold: 0.3 });

        sections.forEach(section => observer.observe(section));
    }

    handleToggle(toggle) {
        const track = toggle.querySelector('.nav-switch-track');
        if (track) {
            track.classList.toggle('active');

            // Handle specific toggles
            const action = toggle.dataset.action;
            if (action === 'darkMode') {
                document.body.classList.toggle('light-mode');
            } else if (action === 'music') {
                this.toggleMusic();
            }
        }

        this.playClickSound();
    }

    toggleMusic() {
        // Placeholder for music toggle
        console.log('[SideNav] Music toggle');
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
