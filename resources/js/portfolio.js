/**
 * Portfolio - Retro Game Console Theme
 * JavaScript for about/portfolio page
 */

// ── Panel Configuration ──
const panels = ['about', 'skills', 'experience', 'education', 'contact'];
let currentIdx = 0;

/**
 * Switch to a specific panel
 * @param {string} name - Panel name (about, skills, experience, education, contact)
 * @param {HTMLElement|null} btnEl - Button element that triggered the switch
 */
function switchPanel(name, btnEl = null) {
    // Hide all panels
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    
    // Deactivate all menu buttons
    document.querySelectorAll('.menu-btn').forEach(b => b.classList.remove('active'));
    
    // Show target panel
    const targetPanel = document.getElementById('panel-' + name);
    if (targetPanel) {
        targetPanel.classList.add('active');
    }
    
    // Activate clicked button
    if (btnEl) {
        btnEl.classList.add('active');
    } else {
        // Find and activate the corresponding button
        const buttons = document.querySelectorAll('.menu-btn');
        const idx = panels.indexOf(name);
        if (idx >= 0 && buttons[idx]) {
            buttons[idx].classList.add('active');
        }
    }
    
    // Update current index
    currentIdx = panels.indexOf(name);
    
    // Animate skill bars when skills panel is shown
    if (name === 'skills') {
        animateSkillBars();
    }
}

/**
 * Navigate to the next panel
 */
function nextPanel() {
    currentIdx = (currentIdx + 1) % panels.length;
    const btn = document.querySelectorAll('.menu-btn')[currentIdx];
    switchPanel(panels[currentIdx], btn);
}

/**
 * Navigate to the previous panel
 */
function prevPanel() {
    currentIdx = (currentIdx - 1 + panels.length) % panels.length;
    const btn = document.querySelectorAll('.menu-btn')[currentIdx];
    switchPanel(panels[currentIdx], btn);
}

/**
 * Animate skill bars with a staggered fill effect
 */
function animateSkillBars() {
    document.querySelectorAll('.skill-bar-fill').forEach(bar => {
        const val = bar.dataset.value;
        // Reset width first for re-animation
        bar.style.width = '0%';
        // Trigger animation after a short delay
        setTimeout(() => {
            bar.style.width = val + '%';
        }, 100);
    });
}

/**
 * Update the clock display
 */
function updateClock() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    
    const clockEl = document.getElementById('clock');
    if (clockEl) {
        clockEl.textContent = h + ':' + m + ':' + s;
    }
}

/**
 * Initialize keyboard navigation
 */
function initKeyboardNav() {
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
            nextPanel();
        }
        if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
            prevPanel();
        }
    });
}

/**
 * Initialize all portfolio functionality
 */
function initPortfolio() {
    // Start clock
    updateClock();
    setInterval(updateClock, 1000);
    
    // Initialize keyboard navigation
    initKeyboardNav();
    
    // Bind menu buttons
    document.querySelectorAll('.menu-btn').forEach((btn, idx) => {
        btn.addEventListener('click', function() {
            switchPanel(panels[idx], this);
        });
    });
    
    // Bind D-pad buttons
    document.querySelectorAll('.dpad-btn').forEach(btn => {
        const text = btn.textContent.trim();
        if (text === '▲' || text === '◀') {
            btn.addEventListener('click', prevPanel);
        } else if (text === '▼' || text === '▶') {
            btn.addEventListener('click', nextPanel);
        }
    });
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolio);
} else {
    initPortfolio();
}

// Export functions for external use
window.switchPanel = switchPanel;
window.nextPanel = nextPanel;
window.prevPanel = prevPanel;
window.animateSkillBars = animateSkillBars;
