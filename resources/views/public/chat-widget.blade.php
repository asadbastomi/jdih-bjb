<!-- AI Chat Widget -->
<div id="chat-widget" class="chat-widget">
    <!-- Chat Toggle Button -->
    <button id="chat-toggle" class="chat-toggle-btn" aria-label="Buka Chat AI">
        <div class="chat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32" height="32">
                <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"/>
                <path d="M12 6C9.79 6 8 7.79 8 10V12H7V15H8V17H10V15H14V17H16V15H17V12H16V10C16 7.79 14.21 6 12 6ZM10 10C10 9.45 10.45 9 11 9H13C13.55 9 14 9.45 14 10V12H10V10Z"/>
            </svg>
        </div>
        <span class="chat-badge" id="chat-badge">1</span>
    </button>

    <!-- Chat Window -->
    <div id="chat-window" class="chat-window">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="chat-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24" height="24">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"/>
                        <path d="M12 6C9.79 6 8 7.79 8 10V12H7V15H8V17H10V15H14V17H16V15H17V12H16V10C16 7.79 14.21 6 12 6ZM10 10C10 9.45 10.45 9 11 9H13C13.55 9 14 9.45 14 10V12H10V10Z"/>
                    </svg>
                </div>
                <div class="chat-header-info">
                    <h4 class="chat-title">Asisten JDIH AI</h4>
                    <p class="chat-subtitle">Jaringan Dokumentasi dan Informasi Hukum</p>
                </div>
            </div>
            <div class="chat-header-right">
                <div class="chat-status">
                    <span class="status-dot"></span>
                    <span>Online</span>
                </div>
                <button id="chat-close" class="chat-close-btn" aria-label="Tutup Chat">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="chat-messages">
            <div class="message bot-message">
                <div class="message-content">
                    <div class="message-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"/>
                            <path d="M12 6C9.79 6 8 7.79 8 10V12H7V15H8V17H10V15H14V17H16V15H17V12H16V10C16 7.79 14.21 6 12 6ZM10 10C10 9.45 10.45 9 11 9H13C13.55 9 14 9.45 14 10V12H10V10Z"/>
                        </svg>
                    </div>
                    <div class="message-text">
                        <div class="message-header">
                            <span class="sender-name">Asisten JDIH</span>
                            <span class="message-time">Sekarang</span>
                        </div>
                        <div class="message-body">
                            <p>👋 Halo! Saya adalah asisten virtual JDIH Kota Banjarbaru.</p>
                            <p>Saya siap membantu Anda menemukan dan memahami produk hukum seperti Peraturan Daerah (Perda), Peraturan Walikota (Perwal), dan dokumen hukum lainnya.</p>
                            <p>Silakan ketik pertanyaan atau pilih contoh di bawah untuk memulai! 📚</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Examples -->
        <div id="chat-examples" class="chat-examples">
            <div class="examples-header">
                <span class="examples-icon">💡</span>
                <span class="examples-title">Mulai dengan contoh pertanyaan</span>
            </div>
            <div class="examples-list" id="examples-list">
                <button class="example-btn" data-message="Peraturan tentang ketenteraman dan ketertiban umum">
                    <span class="example-icon">📜</span>
                    <span class="example-text">Peraturan tentang ketenteraman dan ketertiban umum</span>
                </button>
                <button class="example-btn" data-message="Unduh perda pajak daerah dan retribusi daerah">
                    <span class="example-icon">📥</span>
                    <span class="example-text">Unduh perda pajak daerah dan retribusi daerah</span>
                </button>
                <button class="example-btn" data-message="Ringkasan perda tentang pemberdayaan usaha mikro">
                    <span class="example-icon">📝</span>
                    <span class="example-text">Ringkasan perda tentang pemberdayaan usaha mikro</span>
                </button>
                <button class="example-btn" data-message="Status perwal perencanaan pembangunan daerah">
                    <span class="example-icon">✅</span>
                    <span class="example-text">Status perwal perencanaan pembangunan daerah</span>
                </button>
                <button class="example-btn" data-message="Peraturan mengenai perlindungan lingkungan">
                    <span class="example-icon">🌱</span>
                    <span class="example-text">Peraturan mengenai perlindungan lingkungan</span>
                </button>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="chat-input-container">
            <form id="chat-form" class="chat-form">
                <div class="input-wrapper">
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="chat-input" 
                        class="chat-input" 
                        placeholder="Ketik pertanyaan Anda di sini..."
                        autocomplete="off"
                        aria-label="Ketik pesan"
                    >
                    <button type="submit" class="send-btn" id="send-btn" aria-label="Kirim Pesan">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </div>
            </form>
            <div class="chat-footer">
                <span>⚡ Powered by JDIH Kota Banjarbaru</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Chat Widget Base Styles */
    #chat-widget * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Chat Toggle Button */
    .chat-toggle-btn {
        position: fixed !important;
        bottom: 30px !important;
        left: 30px !important;
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4),
                    0 4px 15px rgba(139, 92, 246, 0.3);
        z-index: 999999999 !important;
        cursor: pointer;
        border: 4px solid white;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
        pointer-events: auto !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .chat-toggle-btn:hover {
        transform: translateY(-4px) scale(1.08);
        box-shadow: 0 12px 40px rgba(99, 102, 241, 0.5),
                    0 6px 20px rgba(139, 92, 246, 0.4);
    }

    .chat-toggle-btn:active {
        transform: translateY(-2px) scale(1.02);
    }

    .chat-toggle-btn:focus {
        outline: 3px solid rgba(99, 102, 241, 0.5);
        outline-offset: 3px;
    }

    .chat-icon {
        color: white;
        transition: all 0.3s ease;
    }

    .chat-icon svg {
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .chat-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: white;
        border: 3px solid white;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        z-index: 100000;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        pointer-events: none !important;
    }

    .chat-badge.show {
        opacity: 1;
        transform: scale(1);
        animation: pulse-badge 2s ease-in-out infinite;
    }

    @keyframes pulse-badge {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    /* Chat Window - ENLARGED */
    .chat-window {
        position: fixed !important;
        bottom: 110px !important;
        left: 30px !important;
        width: 700px;
        max-width: calc(100vw - 80px);
        max-height: 85vh;
        background: white;
        border-radius: 32px;
        box-shadow: 0 30px 100px rgba(0, 0, 0, 0.35),
                    0 15px 40px rgba(0, 0, 0, 0.25);
        z-index: 999999998 !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(30px) scale(0.95) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        pointer-events: none !important;
        border: 1px solid rgba(99, 102, 241, 0.15);
    }

    .chat-window.active {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) scale(1) !important;
        pointer-events: auto !important;
    }

    /* Ensure window is visible when active - higher specificity */
    body .chat-window.active {
        opacity: 1 !important;
        visibility: visible !important;
        display: flex !important;
    }

    /* Ensure window is hidden when not active - higher specificity */
    body .chat-window:not(.active) {
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
    }

    /* Chat Header - ENLARGED PADDING */
    .chat-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        padding: 28px 36px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .chat-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: header-shine 8s linear infinite;
    }

    @keyframes header-shine {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .chat-header-left {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .chat-avatar {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .chat-header-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .chat-title {
        font-size: 22px;
        font-weight: 700;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: -0.3px;
    }

    .chat-subtitle {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .chat-header-right {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .chat-status {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 600;
        color: white;
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 20px;
        border-radius: 28px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .status-dot {
        width: 10px;
        height: 10px;
        background: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
    }

    .chat-close-btn {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        outline: none;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .chat-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .chat-close-btn:focus {
        outline: 2px solid white;
        outline-offset: 2px;
    }

    /* Chat Messages */
    .chat-messages {
        flex: 1 !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        padding: 1.5rem;
        display: flex !important;
        flex-direction: column !important;
        gap: 1rem;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 0 !important;
    }

    .chat-messages::-webkit-scrollbar {
        width: 8px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #aaa;
    }

    .message {
        display: flex;
        align-items: flex-end;
        gap: 16px;
        animation: message-slide-in 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes message-slide-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message.bot-message {
        justify-content: flex-start;
    }

    .message.user-message {
        justify-content: flex-end;
    }

    .message-content {
        display: flex;
        align-items: flex-end;
        gap: 16px;
        max-width: 75%;
    }

    .message-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .bot-message .message-avatar {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: 3px solid white;
    }

    .user-message .message-avatar {
        background: #e2e8f0;
        color: #64748b;
        display: none;
    }

    .message-text {
        padding: 22px 32px;
        border-radius: 24px;
        font-size: 16px;
        line-height: 1.8;
        word-wrap: break-word;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .bot-message .message-text {
        background: #e9ecef;
        color: #333;
        border-bottom-left-radius: 5px;
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .user-message .message-text {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-bottom-right-radius: 6px;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        font-size: 13px;
        font-weight: 600;
    }

    .bot-message .message-header .sender-name {
        color: #6366f1;
    }

    .bot-message .message-header .message-time {
        color: #94a3b8;
    }

    .user-message .message-header {
        display: none;
    }

    .message-body {
        font-size: 16px;
        line-height: 1.8;
    }

    .bot-message .message-body p {
        margin: 0;
        padding: 0.75rem 1rem;
        border-radius: 18px;
        line-height: 1.5;
        word-wrap: break-word;
        position: relative;
    }

    .user-message .message-body p {
        margin: 0 0 16px 0;
    }

    .message-body p:last-child {
        margin: 0;
    }

    .message-body a {
        color: #6366f1;
        text-decoration: underline;
        font-weight: 500;
    }

    .bot-message .message-body a.chat-download-btn {
        display: inline-block;
        background-color: #6366f1;
        color: #fff !important;
        padding: 8px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 500;
        margin-top: 10px;
        transition: background-color 0.2s ease, transform 0.2s ease;
        border: 1px solid transparent;
    }

    .bot-message .message-body a.chat-download-btn:hover {
        background-color: #0056b3;
        color: #fff !important;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .bot-message .message-body a:not(.chat-download-btn) {
        color: #6366f1;
    }

    .user-message .message-body a {
        color: white;
    }

    /* Typing Indicator - ENLARGED */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 22px 32px;
        background: white;
        border-radius: 20px;
        border-bottom-left-radius: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .typing-indicator span {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: #888;
        border-radius: 50%;
        margin: 0 2px;
        animation: typing-blink 1.4s infinite both;
    }

    .typing-indicator span:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing-blink {
        0% { opacity: 0.2; }
        20% { opacity: 1; }
        100% { opacity: 0.2; }
    }

    /* Chat Examples - ENLARGED */
    .chat-examples {
        padding: 28px 36px;
        background: white;
        border-top: 1px solid #e2e8f0;
        flex-shrink: 0;
    }

    .examples-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .examples-icon {
        font-size: 24px;
    }

    .examples-title {
        font-size: 14px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .examples-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .example-btn {
        width: 100%;
        padding: 20px 28px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        color: #475569;
        font-size: 15px;
        font-weight: 500;
        text-align: left;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 18px;
        outline: none;
        font-family: inherit;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .example-btn:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: #6366f1;
        color: white;
        transform: translateX(6px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
    }

    .example-btn:focus {
        outline: 3px solid rgba(99, 102, 241, 0.4);
        outline-offset: 2px;
    }

    .example-icon {
        font-size: 24px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .example-btn:hover .example-icon {
        transform: scale(1.2);
    }

    .example-text {
        flex: 1;
        line-height: 1.6;
    }

    /* Chat Input - ENLARGED */
    .chat-input-container {
        padding: 24px 36px;
        background: white;
        border-top: 1px solid #e2e8f0;
        flex-shrink: 0;
    }

    .chat-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .input-wrapper {
        display: flex;
        gap: 14px;
        align-items: center;
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-input {
        flex: 1;
        padding: 20px 70px 20px 60px;
        border: 2px solid #e2e8f0;
        border-radius: 28px;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        outline: none;
        font-family: inherit;
        background: #f8fafc;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .chat-input:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1),
                    0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .chat-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    .send-btn {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 22px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none;
        flex-shrink: 0;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        position: relative;
        overflow: hidden;
    }

    .send-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.4s ease;
    }

    .send-btn:hover::before {
        width: 100%;
        height: 100%;
    }

    .send-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }

    .send-btn:active {
        transform: scale(0.98);
    }

    .send-btn:focus {
        outline: 3px solid rgba(99, 102, 241, 0.4);
        outline-offset: 2px;
    }

    .send-btn:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .send-btn svg {
        position: relative;
        z-index: 1;
    }

    .chat-footer {
        text-align: center;
        margin-top: 12px;
    }

    .chat-footer span {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chat-window {
            bottom: 90px !important;
            right: 15px;
            left: 15px !important;
            width: calc(100vw - 30px);
            max-height: calc(100vh - 130px);
            border-radius: 24px;
        }

        .chat-toggle-btn {
            bottom: 20px !important;
            left: 20px !important;
            width: 60px;
            height: 60px;
        }

        .chat-icon svg {
            width: 28px;
            height: 28px;
        }

        .chat-header {
            padding: 20px 24px;
        }

        .chat-avatar {
            width: 50px;
            height: 50px;
        }

        .chat-title {
            font-size: 18px;
        }

        .chat-subtitle {
            font-size: 12px;
        }

        .chat-messages {
            padding: 1.5rem;
            gap: 1rem;
        }

        .message-text {
            font-size: 14px;
            padding: 16px 24px;
            line-height: 1.7;
        }

        .message-body {
            font-size: 14px;
            line-height: 1.7;
        }

        .example-btn {
            font-size: 14px;
            padding: 16px 20px;
        }

        .chat-input-container {
            padding: 20px 24px;
        }

        .chat-input {
            padding: 16px 55px 16px 50px;
            font-size: 14px;
        }

        .send-btn {
            width: 52px;
            height: 52px;
        }
    }
</style>

<script>
(function() {
    'use strict';

    console.log('Chat widget script loaded');
    
    // DOM Elements
    const chatToggle = document.getElementById('chat-toggle');
    const chatWindow = document.getElementById('chat-window');
    const chatClose = document.getElementById('chat-close');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');
    const chatBadge = document.getElementById('chat-badge');
    const examplesList = document.getElementById('examples-list');

    // Check if elements exist
    console.log('Checking elements...');
    console.log('chatToggle:', !!chatToggle);
    console.log('chatWindow:', !!chatWindow);
    
    if (!chatToggle || !chatWindow) {
        console.error('Chat widget elements not found');
        return;
    }

    // State
    let isOpen = false;
    let messageCount = 0;

    // Toggle chat window
    function toggleChat() {
        console.log('Toggle chat called, current state:', isOpen);
        console.log('chatWindow before toggle:', chatWindow.className);
        console.log('chatWindow style before:', chatWindow.style.cssText);
        isOpen = !isOpen;
        
        if (isOpen) {
            chatWindow.classList.add('active');
            // Remove any inline display property that might be set
            chatWindow.style.display = '';
            if (chatBadge) chatBadge.classList.remove('show');
            if (chatInput) chatInput.focus();
            
            // Force a reflow to ensure the animation plays
            void chatWindow.offsetWidth;
        } else {
            chatWindow.classList.remove('active');
        }
        
        console.log('Chat toggled to:', isOpen);
        console.log('chatWindow after toggle:', chatWindow.className);
        console.log('chatWindow style after:', chatWindow.style.cssText);
        console.log('computed style opacity:', window.getComputedStyle(chatWindow).opacity);
        console.log('computed style visibility:', window.getComputedStyle(chatWindow).visibility);
    }

    // Close chat
    function closeChat() {
        console.log('Close chat called');
        isOpen = false;
        chatWindow.classList.remove('active');
        console.log('Chat closed');
    }

    // Event listeners - Use mousedown for better compatibility
    chatToggle.addEventListener('mousedown', function(e) {
        console.log('Chat toggle button mousedown!');
        console.log('Event object:', e);
        console.log('Current isOpen:', isOpen);
        e.preventDefault();
        e.stopPropagation();
        toggleChat();
    });

    chatToggle.addEventListener('click', function(e) {
        console.log('Chat toggle button clicked!');
        console.log('Event object:', e);
        console.log('Current isOpen:', isOpen);
        toggleChat();
    });
    
    // Also add click to icon div
    const chatIcon = chatToggle.querySelector('.chat-icon');
    if (chatIcon) {
        chatIcon.addEventListener('mousedown', function(e) {
            console.log('Chat icon mousedown!');
            e.preventDefault();
            e.stopPropagation();
            toggleChat();
        });
        
        chatIcon.addEventListener('click', function(e) {
            console.log('Chat icon clicked!');
            toggleChat();
        });
    }
    
    if (chatClose) {
        chatClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeChat();
        });
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) {
            closeChat();
        }
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (isOpen && !chatWindow.contains(e.target) && e.target !== chatToggle && !chatToggle.contains(e.target)) {
            closeChat();
        }
    });

    // Load example questions
    function loadExamples() {
        fetch('/api/chat/examples')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.examples) {
                    examplesList.innerHTML = '';
                    const icons = ['📜', '📥', '📝'];
                    
                    data.examples.slice(0, 3).forEach((example, index) => {
                        const btn = document.createElement('button');
                        btn.className = 'example-btn';
                        btn.dataset.message = example;
                        btn.innerHTML = `
                            <span class="example-icon">${icons[index]}</span>
                            <span class="example-text">${example}</span>
                        `;
                        examplesList.appendChild(btn);
                    });
                }
            })
            .catch(error => console.error('Error loading examples:', error));
    }

    // Send message
    function sendMessage(message) {
        if (!message || !message.trim()) return;

        // Hide examples after first message
        const examplesSection = document.getElementById('chat-examples');
        if (examplesSection) {
            examplesSection.style.display = 'none';
        }

        // Add user message
        addMessage(message, 'user');

        // Clear input
        chatInput.value = '';
        chatInput.focus();

        // Show typing indicator
        showTypingIndicator();

        // Send to server
        fetch('/api/chat/message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            hideTypingIndicator();
            
            console.log('API Response:', data);
            
            if (data.success && data.response) {
                addMessage(data.response, 'bot');
            } else if (data.success && data.message) {
                // Handle case where API returns 'message' instead of 'response'
                addMessage(data.message, 'bot');
            } else {
                console.error('Unexpected response format:', data);
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi nanti.', 'bot');
            }
        })
        .catch(error => {
            hideTypingIndicator();
            console.error('Error:', error);
            addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
        });
    }

    // Add message to chat
    function addMessage(text, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;
        
        const isBot = type === 'bot';
        const timeText = isBot ? 'Sekarang' : 'Baru saja';
        
        if (isBot) {
            messageDiv.innerHTML = `
                <div class="message-content">
                    <div class="message-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"/>
                            <path d="M12 6C9.79 6 8 7.79 8 10V12H7V15H8V17H10V15H14V17H16V15H17V12H16V10C16 7.79 14.21 6 12 6ZM10 10C10 9.45 10.45 9 11 9H13C13.55 9 14 9.45 14 10V12H10V10Z"/>
                        </svg>
                    </div>
                    <div class="message-text">
                        <div class="message-header">
                            <span class="sender-name">Asisten JDIH</span>
                            <span class="message-time">${timeText}</span>
                        </div>
                        <div class="message-body"></div>
                    </div>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="message-content">
                    <div class="message-text">
                        <div class="message-body">
                            ${escapeHtml(text)}
                        </div>
                    </div>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        
        // Insert HTML content safely for bot messages
        if (isBot) {
            const messageBody = messageDiv.querySelector('.message-body');
            if (messageBody) {
                messageBody.innerHTML = text.replace(/\n/g, '<br>');
            }
        }
        
        scrollToBottom();
    }

    // Show typing indicator
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot-message';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="message-content">
                <div class="message-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"/>
                        <path d="M12 6C9.79 6 8 7.79 8 10V12H7V15H8V17H10V15H14V17H16V15H17V12H16V10C16 7.79 14.21 6 12 6ZM10 10C10 9.45 10.45 9 11 9H13C13.55 9 14 9.45 14 10V12H10V10Z"/>
                    </svg>
                </div>
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
    }

    // Hide typing indicator
    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    // Scroll to bottom with delay to ensure content is rendered
    function scrollToBottom() {
        setTimeout(() => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 100);
    }

    // Format message - render safe HTML from server response
    function formatMessage(text) {
        // Convert newlines to <br> first
        let html = text.replace(/\n/g, '<br>');
        
        // The server provides safe HTML, so we return it directly
        // When inserted via innerHTML, it will be rendered properly
        return html;
    }

    // Escape HTML for user messages (to prevent XSS)
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML.replace(/\n/g, '<br>');
    }

    // Form submit
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (message) {
            sendMessage(message);
        }
    });

    // Example button clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('example-btn') || e.target.closest('.example-btn')) {
            const btn = e.target.classList.contains('example-btn') ? e.target : e.target.closest('.example-btn');
            const message = btn.dataset.message;
            if (message && !isOpen) {
                toggleChat();
            }
            setTimeout(() => sendMessage(message), 300);
        }
    });

    // Initialize
    loadExamples();

    // Show badge on page load
    setTimeout(() => {
        messageCount = 1;
        if (chatBadge) chatBadge.textContent = messageCount;
        if (chatBadge) chatBadge.classList.add('show');
    }, 2000);

    console.log('Chat widget initialized successfully!');

})();
</script>