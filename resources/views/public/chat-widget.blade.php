<!-- Bahari AI Chat: fresh layout -->
<div id="chat-widget" class="bahari-chat">
    <button id="chat-toggle" class="chat-toggle" aria-label="Buka Chat Bahari AI">
        <span class="toggle-icon">🤖</span>
        <span class="toggle-label">Bahari AI</span>
    </button>

    <div id="chat-window" class="chat-window">
        <header class="chat-header">
            <div class="brand">
                <div class="brand-mark">BA</div>
                <div class="brand-copy">
                    <div class="title">Bahari AI</div>
                    <div class="subtitle">Banjarbaru Hukum & Regulasi</div>
                </div>
            </div>
            <div class="status-pill">
                <span class="dot"></span>
                <span>Online</span>
            </div>
        </header>

        <section class="chat-body">
            <div class="pane">
                <div id="chat-messages" class="messages">
                    <div class="chat-bubble bot text-justify">
                        <div class="meta">
                            <span class="who">Bahari AI</span>
                            <span class="when">Sekarang</span>
                        </div>
                        <p>Halo, saya Bahari AI. Saya membantu menemukan regulasi (KUHP, Perda, Perwali, dsb.), abstrak, metadata, dan tautan unduhan.</p>
                        <p>Gunakan contoh di samping atau ketik pertanyaan Anda. Panduan lengkap ada di /bahari-ai.</p>
                    </div>
                </div>
                <div id="examples-list" class="mb-2 mt-3">
                    <small><strong>Contoh:</strong></small>
                    <div class="btn-group mb-2 example-group" role="group" aria-label="example questions">
                        <button type="button" class="btn btn-outline-danger btn-sm example-btn rounded-3 text-keterangan" data-message="Apa isi Pasal 476?">Apa isi Pasal 476?</button>
                        <button type="button" class="btn btn-outline-danger btn-sm example-btn rounded-3 text-keterangan" data-message="Apakah korporasi adalah subjek tindak pidana?">Apakah korporasi adalah subjek tindak pidana?</button>
                        <button type="button" class="btn btn-outline-danger btn-sm example-btn rounded-3 text-keterangan" data-message="Jelaskan tentang pidana pembunuhan">Jelaskan tentang pidana pembunuhan</button>
                    </div>
                </div>
            </div>
        </section>

        <footer class="chat-footer">
            <form id="chat-form" class="chat-form">
                <div class="input-wrap">
                    <input id="chat-input" type="text" class="chat-input" placeholder="Ketik pertanyaan Anda di sini..." autocomplete="off" aria-label="Ketik pesan">
                    <button id="send-btn" class="send-btn" type="submit" aria-label="Kirim">
                        <span>→</span>
                    </button>
                </div>
            </form>
            <div class="footer-note">Powered by Bahari AI</div>
        </footer>
    </div>
</div>

<style>
:root {
    --ink: #0f172a;
    --navy: #0b3b60;
    --blue: #1f5f8b;
    --sky: #1f9cf0;
    --sand: #f5f7fb;
    --line: #e2e8f0;
    --muted: #64748b;
    --radius-lg: 18px;
}

.bahari-chat * { box-sizing: border-box; }

.chat-toggle {
    position: fixed;
    bottom: 28px;
    left: 28px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 60%, var(--sky) 100%);
    color: #fff;
    border: none;
    border-radius: 999px;
    box-shadow: 0 14px 36px rgba(15, 23, 42, 0.28);
    cursor: pointer;
    font-weight: 700;
    letter-spacing: 0.2px;
    z-index: 99999;
}

.chat-toggle:focus { outline: 3px solid rgba(31,156,240,0.25); outline-offset: 3px; }

.chat-window {
    position: fixed;
    bottom: 110px;
    left: 28px;
    width: 760px;
    max-width: calc(100vw - 64px);
    max-height: 86vh;
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(15, 23, 42, 0.24);
    border: 1px solid rgba(15,23,42,0.06);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    transform: translateY(24px) scale(0.97);
    transition: all 0.28s ease;
    z-index: 99998;
}

.chat-window.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 22px;
    background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 65%, var(--sky) 100%);
    color: #fff;
    border-bottom: 1px solid rgba(255,255,255,0.12);
}

.brand { display: flex; align-items: center; gap: 12px; }
.brand-mark {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(255,255,255,0.18);
    display: grid;
    place-items: center;
    font-weight: 800;
    letter-spacing: 0.6px;
}
.brand-copy .title { font-weight: 800; letter-spacing: -0.2px; }
.brand-copy .subtitle { font-size: 13px; opacity: 0.85; }

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    background: rgba(255,255,255,0.16);
    font-weight: 600;
    font-size: 13px;
}
.status-pill .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #10b981;
    box-shadow: 0 0 0 5px rgba(16,185,129,0.2);
}

.chat-body {
    display: flex;
    flex-direction: column;
    gap: 0;
    background: var(--sand);
}

.pane { padding: 18px; min-width: 0; }
.messages {
    height: 100%;
    max-height: 420px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.bubble {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 14px 16px;
    box-shadow: 0 12px 30px rgba(15,23,42,0.08);
    color: var(--ink);
    line-height: 1.6;
}

.chat-bubble {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--radius-lg);
    padding: 14px 16px;
    box-shadow: 0 12px 30px rgba(15,23,42,0.08);
    color: var(--ink);
    line-height: 1.6;
}

.chat-bubble.bot { border-color: rgba(31,95,139,0.12); }
.chat-bubble.user {
    margin-left: auto;
    background: linear-gradient(135deg, var(--sky) 0%, var(--blue) 100%);
    color: #fff;
    border: none;
}

.chat-bubble .meta {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 700;
    color: var(--muted);
    margin-bottom: 6px;
}

.chat-bubble.user .meta {
    color: rgba(255,255,255,0.85);
}

.hidden {
    display: none !important;
}

.tab-merah .btn {
    border-radius: 8px;
}

.toggle-penjelasan,
.toggle-anotasi {
    border: 1px solid #ef4444;
    color: #b91c1c;
    background: #fff;
}

.toggle-penjelasan:hover,
.toggle-anotasi:hover {
    color: #fff;
    background: #ef4444;
}

.bubble.bot { border-color: rgba(31,95,139,0.12); }
.bubble.user {
    margin-left: auto;
    background: linear-gradient(135deg, var(--sky) 0%, var(--blue) 100%);
    color: #fff;
    border: none;
}

.bubble .meta {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    font-weight: 700;
    color: var(--muted);
    margin-bottom: 6px;
}
.bubble.user .meta { color: rgba(255,255,255,0.8); }

.bubble p { margin: 0 0 6px 0; }
.bubble p:last-child { margin-bottom: 0; }

.example-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.example-group .example-btn {
    border-radius: 10px !important;
    font-weight: 600;
    border-color: #ef4444;
    color: #b91c1c;
    background: #fff;
}

.example-group .example-btn:hover {
    background: #ef4444;
    color: #fff;
}

.chat-footer {
    padding: 14px 18px 16px;
    border-top: 1px solid var(--line);
    background: #fff;
}

.chat-form { display: flex; flex-direction: column; gap: 10px; }

.input-wrap {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 10px;
}

.chat-input {
    width: 100%;
    padding: 14px 16px;
    border-radius: 14px;
    border: 1px solid #d8e2ee;
    background: #f9fbff;
    font-size: 15px;
    transition: all 0.2s ease;
}

.chat-input:focus {
    outline: none;
    border-color: var(--sky);
    background: #fff;
    box-shadow: 0 10px 26px rgba(31,156,240,0.14);
}

.send-btn {
    width: 52px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--sky) 0%, var(--blue) 100%);
    color: #fff;
    font-size: 18px;
    font-weight: 800;
    cursor: pointer;
    box-shadow: 0 12px 30px rgba(31,95,139,0.25);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.send-btn:hover { transform: translateY(-1px); box-shadow: 0 14px 34px rgba(31,95,139,0.3); }
.send-btn:active { transform: translateY(1px); }

.footer-note { text-align: center; color: var(--muted); font-size: 12px; }

@media (max-width: 992px) {
    .chat-window { left: 18px; width: calc(100vw - 36px); }
    .chat-body { display: flex; flex-direction: column; }
}

@media (max-width: 640px) {
    .chat-toggle { left: 18px; bottom: 18px; }
    .chat-window { bottom: 88px; }
    .chat-header { padding: 14px 16px; }
    .pane { padding: 14px; }
    .bubble { padding: 12px 14px; }
}
</style>

<script>
(function() {
    const chatToggle = document.getElementById('chat-toggle');
    const chatWindow = document.getElementById('chat-window');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const examples = document.getElementById('examples-list');

    let isOpen = false;

    function openChat() {
        if (!chatWindow) return;
        chatWindow.classList.add('active');
        isOpen = true;
        if (chatInput) chatInput.focus();
    }

    function closeChat() {
        if (!chatWindow) return;
        chatWindow.classList.remove('active');
        isOpen = false;
    }

    if (chatToggle) {
        chatToggle.addEventListener('click', (e) => {
            e.preventDefault();
            isOpen ? closeChat() : openChat();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) closeChat();
    });

    function addMessage(text, who = 'bot') {
        const bubble = document.createElement('div');
        bubble.className = `chat-bubble ${who} text-justify`;
        const meta = document.createElement('div');
        meta.className = 'meta';
        meta.innerHTML = `<span class="who">${who === 'bot' ? 'Bahari AI' : 'Anda'}</span><span class="when">Baru saja</span>`;
        const body = document.createElement('div');
        body.className = 'body';
        if (who === 'user') {
            body.innerHTML = escapeHtml(text).replace(/\n/g, '<br>');
        } else {
            body.innerHTML = String(text).replace(/\n/g, '<br>');
        }
        bubble.appendChild(meta);
        bubble.appendChild(body);
        chatMessages.appendChild(bubble);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function showTyping() {
        const t = document.createElement('div');
        t.id = 'typing';
        t.className = 'chat-bubble bot';
        t.innerHTML = '<div class="meta"><span class="who">Bahari AI</span><span class="when">Mengetik...</span></div><div class="body">•••</div>';
        chatMessages.appendChild(t);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function hideTyping() {
        const t = document.getElementById('typing');
        if (t) t.remove();
    }

    function sendMessage(message) {
        if (!message) return;
        addMessage(message, 'user');
        showTyping();

        fetch('/api/chat/message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ message })
        })
        .then(r => r.json())
        .then(data => {
            hideTyping();
            if (data.success && data.response) {
                addMessage(typeof data.response === 'string' ? data.response : JSON.stringify(data.response, null, 2), 'bot');
            } else if (data.message) {
                addMessage(data.message, 'bot');
            } else {
                addMessage('Maaf, terjadi kesalahan. Coba lagi nanti.', 'bot');
            }
        })
        .catch(() => {
            hideTyping();
            addMessage('Maaf, jaringan bermasalah. Silakan ulangi.', 'bot');
        });
    }

    if (chatForm) {
        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            chatInput.value = '';
            chatInput.focus();
            sendMessage(message);
        });
    }

    if (examples) {
        examples.addEventListener('click', (e) => {
            const btn = e.target.closest('.example-btn');
            if (!btn) return;
            const msg = btn.getAttribute('data-message') || btn.textContent.trim();
            chatInput.value = msg;
            chatInput.focus();
            sendMessage(msg);
        });
    }

    // Handle interactive pasal tabs + collapsible sections in bot responses
    chatMessages.addEventListener('click', (e) => {
        const pasalBtn = e.target.closest('[res-pasal]');
        if (pasalBtn) {
            const pasal = pasalBtn.getAttribute('res-pasal');
            const prefix = pasalBtn.getAttribute('data-prefix');
            const root = document.getElementById(prefix);
            if (!root) return;

            root.querySelectorAll('[res-pasal]').forEach((btn) => btn.classList.remove('active'));
            pasalBtn.classList.add('active');

            root.querySelectorAll('.kuhp-pasal-panel').forEach((panel) => {
                const panelPasal = panel.getAttribute('data-pasal-panel');
                if (panelPasal === pasal) {
                    panel.classList.remove('hidden');
                } else {
                    panel.classList.add('hidden');
                }
            });
            return;
        }

        const toggleBtn = e.target.closest('.toggle-penjelasan, .toggle-anotasi');
        if (toggleBtn) {
            const target = toggleBtn.getAttribute('data-target');
            if (!target) return;
            const panel = document.querySelector(target);
            if (!panel) return;
            panel.classList.toggle('hidden');
        }
    });

    // Auto-open when embedded (bahari-ai page toggles visibility separately)
    if (document.querySelector('.chat-embed')) {
        openChat();
    }

})();
</script>
