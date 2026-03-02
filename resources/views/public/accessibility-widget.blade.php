<style>
    @import url('https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&display=swap');

    :root {
        --access-scale: 1;
    }

    body.accessibility-readable-font {
        font-family: 'Atkinson Hyperlegible', 'Nunito', Arial, sans-serif;
        letter-spacing: 0.01em;
    }

    body.accessibility-contrast {
        background: #000 !important;
        color: #ffd600 !important;
    }

    body.accessibility-contrast a,
    body.accessibility-contrast button,
    body.accessibility-contrast .btn {
        color: #00e5ff !important;
    }

    body.accessibility-dark {
        background: #0f172a !important;
        color: #e2e8f0 !important;
    }

    body.accessibility-dark a,
    body.accessibility-dark button,
    body.accessibility-dark .btn {
        color: #93c5fd !important;
    }

    body.accessibility-highlight-links a {
        outline: 2px solid #2563eb !important;
        outline-offset: 2px;
        background: #eef2ff !important;
        color: #111827 !important;
    }

    body.accessibility-pause-animations *,
    body.accessibility-pause-animations *::before,
    body.accessibility-pause-animations *::after {
        animation: none !important;
        transition: none !important;
    }

    body {
        font-size: calc(16px * var(--access-scale, 1));
    }

    .accessibility-widget {
        position: fixed;
        right: 16px;
        bottom: 16px;
        z-index: 2147483000;
        font-family: 'Atkinson Hyperlegible', 'Nunito', Arial, sans-serif;
    }

    .accessibility-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        border-radius: 50%;
        border: none;
        background: #111827;
        color: #f8fafc;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        cursor: pointer;
    }

    .accessibility-panel {
        margin-top: 10px;
        width: 320px;
        background: #ffffff;
        color: #0f172a;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.35);
        border: 1px solid #e5e7eb;
        padding: 16px;
        display: none;
    }

    .accessibility-panel.is-open {
        display: block;
    }

    .accessibility-group {
        margin-bottom: 12px;
    }

    .accessibility-title {
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 6px;
    }

    .accessibility-buttons {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .accessibility-buttons .wide {
        grid-column: span 2;
    }

    .accessibility-btn {
        border: 1px solid #e5e7eb;
        background: #f8fafc;
        color: #0f172a;
        padding: 10px 12px;
        border-radius: 10px;
        text-align: left;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .accessibility-btn:focus-visible,
    .accessibility-toggle:focus-visible {
        outline: 3px solid #2563eb;
        outline-offset: 2px;
    }

    .accessibility-meta {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }
</style>

<div class="accessibility-widget" aria-label="Widget Aksesibilitas Otomatis" role="region">
    <button class="accessibility-toggle" id="accessibilityToggle" aria-expanded="false" aria-controls="accessibilityPanel" title="Buka pengaturan aksesibilitas">
        <span aria-hidden="true">♿</span>
    </button>
    <div class="accessibility-panel" id="accessibilityPanel">
        <div class="accessibility-group">
            <div class="accessibility-title">Ukuran Teks</div>
            <div class="accessibility-buttons">
                <button class="accessibility-btn" data-action="decrease-text" aria-label="Perkecil teks">A-</button>
                <button class="accessibility-btn" data-action="increase-text" aria-label="Perbesar teks">A+</button>
                <div class="accessibility-meta" id="textScaleLabel">Standar</div>
            </div>
        </div>
        <div class="accessibility-group">
            <div class="accessibility-title">Tampilan</div>
            <div class="accessibility-buttons">
                <button class="accessibility-btn" data-action="toggle-contrast" aria-label="Aktifkan mode kontras tinggi">Kontras Tinggi</button>
                <button class="accessibility-btn" data-action="toggle-dark" aria-label="Aktifkan mode gelap">Dark Mode</button>
                <button class="accessibility-btn wide" data-action="toggle-highlight" aria-label="Sorot semua tautan">Highlight Tautan</button>
            </div>
        </div>
        <div class="accessibility-group">
            <div class="accessibility-title">Keterbacaan & Gerak</div>
            <div class="accessibility-buttons">
                <button class="accessibility-btn" data-action="toggle-font" aria-label="Gunakan font mudah dibaca">Font Mudah Dibaca</button>
                <button class="accessibility-btn" data-action="toggle-motion" aria-label="Jeda animasi">Jeda Animasi</button>
            </div>
        </div>
        <div class="accessibility-group">
            <div class="accessibility-title">Kepatuhan</div>
            <div class="accessibility-meta">Mendukung praktik WCAG 2.1/2.2: kontras, teks fleksibel, navigasi keyboard, pengurangan gerak.</div>
        </div>
    </div>
</div>

<script>
(() => {
    const body = document.body;
    const toggleBtn = document.getElementById('accessibilityToggle');
    const panel = document.getElementById('accessibilityPanel');
    const scaleLabel = document.getElementById('textScaleLabel');
    const buttons = panel.querySelectorAll('[data-action]');
    const storeKey = 'jdih-accessibility';

    const state = {
        scale: 1,
        contrast: false,
        dark: false,
        highlight: false,
        readableFont: false,
        pauseAnimations: false
    };

    const load = () => {
        try {
            const saved = JSON.parse(localStorage.getItem(storeKey));
            if (saved && typeof saved === 'object') {
                Object.assign(state, saved);
            }
        } catch (e) {}
    };

    const save = () => localStorage.setItem(storeKey, JSON.stringify(state));

    const applyState = () => {
        document.documentElement.style.setProperty('--access-scale', state.scale);
        scaleLabel.textContent = state.scale === 1 ? 'Standar' : Math.round(state.scale * 100) + '%';

        body.classList.toggle('accessibility-contrast', !!state.contrast);
        body.classList.toggle('accessibility-dark', !!state.dark);
        body.classList.toggle('accessibility-highlight-links', !!state.highlight);
        body.classList.toggle('accessibility-readable-font', !!state.readableFont);
        body.classList.toggle('accessibility-pause-animations', !!state.pauseAnimations);
    };

    const clampScale = (value) => Math.min(1.5, Math.max(0.85, Number(value) || 1));

    const handlers = {
        'increase-text': () => { state.scale = clampScale(state.scale + 0.1); },
        'decrease-text': () => { state.scale = clampScale(state.scale - 0.1); },
        'toggle-contrast': () => { state.contrast = !state.contrast; if (state.contrast) state.dark = false; },
        'toggle-dark': () => { state.dark = !state.dark; if (state.dark) state.contrast = false; },
        'toggle-highlight': () => { state.highlight = !state.highlight; },
        'toggle-font': () => { state.readableFont = !state.readableFont; },
        'toggle-motion': () => { state.pauseAnimations = !state.pauseAnimations; }
    };

    toggleBtn.addEventListener('click', () => {
        const isOpen = panel.classList.toggle('is-open');
        toggleBtn.setAttribute('aria-expanded', String(isOpen));
    });

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const action = btn.getAttribute('data-action');
            if (handlers[action]) {
                handlers[action]();
                applyState();
                save();
            }
        });
    });

    // Close panel on Escape for keyboard users
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && panel.classList.contains('is-open')) {
            panel.classList.remove('is-open');
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.focus();
        }
    });

    load();
    applyState();
})();
</script>
